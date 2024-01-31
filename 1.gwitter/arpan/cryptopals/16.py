from Crypto.Cipher import AES
from Crypto.Random import get_random_bytes
from Crypto.Util.Padding import pad, unpad

def generate_random_key():
    return get_random_bytes(16)

def quote_string(input_string):
    return input_string.replace(";", "%3B").replace("=", "%3D")

def encrypt_input(input_string, key):
    prefix = b"comment1=cooking%20MCs;userdata="
    suffix = b";comment2=%20like%20a%20pound%20of%20bacon"
    sanitized_input = quote_string(input_string).encode()
    plaintext = pad(prefix + sanitized_input + suffix, AES.block_size)
    cipher = AES.new(key, AES.MODE_CBC, b'\x00' * AES.block_size)
    ciphertext = cipher.encrypt(plaintext)
    return ciphertext

def is_admin(ciphertext, key):
    cipher = AES.new(key, AES.MODE_CBC, b'\x00' * AES.block_size)
    plaintext = cipher.decrypt(ciphertext)
    try:
        unpadded_plaintext = unpad(plaintext, AES.block_size)
        return b";admin=true;" in unpadded_plaintext
    except ValueError:
        return False

key = generate_random_key()

input_string = "username=admin;password=123456"

ciphertext = encrypt_input(input_string, key)

ciphertext = bytearray(ciphertext)
ciphertext[16+5] ^= ord(';') ^ ord('a')
ciphertext[16+11] ^= ord('=') ^ ord('t')
ciphertext[16+17] ^= ord(';') ^ ord('r')
ciphertext = bytes(ciphertext)

print("Is admin:", is_admin(ciphertext, key))
