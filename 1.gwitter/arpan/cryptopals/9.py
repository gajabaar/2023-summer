def pkcs7_pad(plaintext, block_size):
    padding_length = block_size - len(plaintext) % block_size
    padding = bytes([padding_length] * padding_length)
    return plaintext + padding

plaintext = b"YELLOW SUBMARINE"
block_size = 20
padded_plaintext = pkcs7_pad(plaintext, block_size)
print(padded_plaintext)
