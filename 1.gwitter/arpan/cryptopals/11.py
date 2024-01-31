import os
from Crypto.Cipher import AES
import random

def generate_random_aes_key():
    return os.urandom(16)

def pkcs7_pad(plaintext):
    padding_length = 16 - len(plaintext) % 16
    return plaintext + bytes([padding_length] * padding_length)

def encryption_oracle(plaintext):
    key = generate_random_aes_key()

    prefix_length = random.randint(5, 10)
    suffix_length = random.randint(5, 10)

    prefix = os.urandom(prefix_length)
    suffix = os.urandom(suffix_length)

    plaintext = prefix + plaintext + suffix

    plaintext = pkcs7_pad(plaintext)

    mode = random.randint(0, 1) 

    if mode == 0:
        cipher = AES.new(key, AES.MODE_ECB)
        ciphertext = cipher.encrypt(plaintext)
        return "ECB", ciphertext
    else:
        iv = os.urandom(16)  
        cipher = AES.new(key, AES.MODE_CBC, iv)
        ciphertext = cipher.encrypt(plaintext)
        return "CBC", ciphertext

def detect_block_cipher_mode(ciphertext):
    blocks = [ciphertext[i:i+16] for i in range(0, len(ciphertext), 16)]
    unique_blocks = set(blocks)
    if len(unique_blocks) < len(blocks):
        return "ECB"
    else:
        return "CBC"

plaintext = b"Hello, this is a test plaintext!"
mode, ciphertext = encryption_oracle(plaintext)
print("Encrypted with:", mode)

detected_mode = detect_block_cipher_mode(ciphertext)
print("Detected mode:", detected_mode)
