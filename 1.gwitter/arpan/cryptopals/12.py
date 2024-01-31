from Crypto.Cipher import AES
from base64 import b64decode
import os

UNKNOWN_STRING = b"""
Um9sbGluJyBpbiBteSA1LjAKV2l0aCBteSByYWctdG9wIGRvd24gc28gbXkg
aGFpciBjYW4gYmxvdwpUaGUgZ2lybGllcyBvbiBzdGFuZGJ5IHdhdmluZyBq
dXN0IHRvIHNheSBoaQpEaWQgeW91IHN0b3A/IE5vLCBJIGp1c3QgZHJvdmUg
YnkK"""
KEY = os.urandom(16)

def pkcs7_pad(plaintext):
    padding_length = 16 - len(plaintext) % 16
    return plaintext + bytes([padding_length] * padding_length)

def encryption_oracle(your_string):
    unknown_string = b64decode(UNKNOWN_STRING)
    plaintext = pkcs7_pad(your_string + unknown_string)
    cipher = AES.new(KEY, AES.MODE_ECB)
    return cipher.encrypt(plaintext)

def detect_block_cipher_mode(ciphertext):
    blocks = [ciphertext[i:i+16] for i in range(0, len(ciphertext), 16)]
    unique_blocks = set(blocks)
    if len(unique_blocks) < len(blocks):
        return "ECB"
    else:
        return "CBC"

def discover_block_size(oracle):
    initial_length = len(oracle(b""))
    for i in range(1, 1024):
        new_length = len(oracle(b"A" * i))
        if new_length > initial_length:
            return new_length - initial_length

def byte_at_a_time_ecb_decryption(oracle):
    block_size = discover_block_size(oracle)
    assert detect_block_cipher_mode(oracle(b"A" * 128)) == "ECB", "Not using ECB mode"

    known_plaintext = b""
    ciphertext_length = len(oracle(b""))
    for i in range(ciphertext_length):
        target_block = (i // block_size) * block_size
        target_plaintext = b"A" * (block_size - 1 - (i % block_size))

        dictionary = {}
        for byte in range(256):
            test_ciphertext = oracle(target_plaintext + known_plaintext + bytes([byte]))
            dictionary[test_ciphertext[:target_block + block_size]] = bytes([byte])

        crafted_block = oracle(target_plaintext)[target_block:target_block + block_size]
        known_plaintext += dictionary.get(crafted_block, b'')

    return known_plaintext

def main():
    oracle = encryption_oracle
    known_plaintext = byte_at_a_time_ecb_decryption(oracle)
    print("Decrypted unknown string:", known_plaintext.decode("utf-8"))

if __name__ == "__main__":
    main()
