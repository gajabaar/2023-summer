from base64 import b64decode
from Crypto.Cipher import AES
import os

UNKNOWN_STRING = b"""
Um9sbGluJyBpbiBteSA1LjAKV2l0aCBteSByYWctdG9wIGRvd24gc28gbXkg
aGFpciBjYW4gYmxvdwpUaGUgZ2lybGllcyBvbiBzdGFuZGJ5IHdhdmluZyBq
dXN0IHRvIHNheSBoaQpEaWQgeW91IHN0b3A/IE5vLCBJIGp1c3QgZHJvdmUg
YnkK"""

KEY = os.urandom(16)
PREFIX = os.urandom(16)

def pad(msg):
    """Applies PKCS#7 padding to the message."""
    padding = 16 - (len(msg) % 16)
    return msg + bytes([padding] * padding)

def encryption_oracle(your_string):
    """Encrypts `your_string` + `UNKNOWN_STRING` using AES-ECB."""
    msg = b'The unknown string given to you was:\n'
    plaintext = PREFIX + your_string + msg + b64decode(UNKNOWN_STRING)
    padded_plaintext = pad(plaintext)
    cipher = AES.new(KEY, AES.MODE_ECB)
    ciphertext = cipher.encrypt(padded_plaintext)
    return ciphertext

def detect_block_size(oracle):
    """Detects the block size used by the encryption oracle."""
    initial_length = len(oracle(b""))
    for i in range(1, 1024):
        new_length = len(oracle(b"A" * i))
        if new_length > initial_length:
            return new_length - initial_length

def detect_mode(oracle, block_size):
    """Detects if the encryption mode is ECB."""
    plaintext = b"A" * block_size * 3
    ciphertext = oracle(plaintext)
    blocks = [ciphertext[i:i+block_size] for i in range(0, len(ciphertext), block_size)]
    unique_blocks = set(blocks)
    if len(unique_blocks) < len(blocks):
        return True  
    return False

def detect_prefix_length(oracle, block_size):
    """Detects the length of the prefix."""
    previous_length = len(oracle(b""))
    for i in range(1, block_size + 1):
        current_length = len(oracle(b"A" * i))
        if current_length != previous_length:
            return (i - 1) - (previous_length % block_size)
    return 0

def ecb_decryption(oracle, block_size, prefix_length):
    """Performs byte-at-a-time ECB decryption."""
    plaintext = b""
    for i in range(len(oracle(b"")) - prefix_length):
        padding_length = block_size - (prefix_length + len(plaintext) + 1) % block_size
        crafted_input = b"A" * padding_length
        target_block_index = prefix_length + len(plaintext) + padding_length

        dictionary = {}
        for byte in range(256):
            test_input = crafted_input + plaintext + bytes([byte])
            ciphertext = oracle(test_input)[:target_block_index + block_size]
            dictionary[ciphertext] = bytes([byte])

        target_block = oracle(b"A" * padding_length)[:target_block_index + block_size]
        byte = dictionary.get(target_block)
        if byte is not None:
            plaintext += byte
        else:
            break
    return plaintext

def main():
    block_size = detect_block_size(encryption_oracle)
    print("Block Size:", block_size)

    if detect_mode(encryption_oracle, block_size):
        print("ECB Mode Detected")
    else:
        print("ECB Mode Not Detected")
        return

    prefix_length = detect_prefix_length(encryption_oracle, block_size)
    print("Prefix Length:", prefix_length)

    plaintext = ecb_decryption(encryption_oracle, block_size, prefix_length)
    print("Decrypted Plaintext:", plaintext.decode())

if __name__ == "__main__":
    main()
