from Crypto.Cipher import AES
import base64

def encrypt_ecb(plaintext, key):
    cipher = AES.new(key, AES.MODE_ECB)
    return cipher.encrypt(plaintext)

def decrypt_ecb(ciphertext, key):
    cipher = AES.new(key, AES.MODE_ECB)
    return cipher.decrypt(ciphertext)

def xor_bytes(bytes1, bytes2):
    return bytes([b1 ^ b2 for b1, b2 in zip(bytes1, bytes2)])

def decrypt_cbc(ciphertext, key, iv):
    plaintext = b""
    previous_block = iv
    block_size = AES.block_size

    for i in range(0, len(ciphertext), block_size):
        block = ciphertext[i:i+block_size]
        decrypted_block = decrypt_ecb(block, key)
        plaintext += xor_bytes(decrypted_block, previous_block)
        previous_block = block

    return plaintext

with open("10.txt", "r") as file:
    ciphertext = base64.b64decode(file.read())

key = b"YELLOW SUBMARINE"
iv = b'\x00' * AES.block_size

plaintext = decrypt_cbc(ciphertext, key, iv)
print(plaintext.decode("utf-8"))
