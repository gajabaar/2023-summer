def repeating_key_xor(text, key):
    encrypted_bytes = bytearray()
    key_length = len(key)

    for i, char in enumerate(text):
        encrypted_byte = char ^ ord(key[i % key_length])
        encrypted_bytes.append(encrypted_byte)

    return encrypted_bytes.hex()

plaintext = """Burning 'em, if you ain't quick and nimble
I go crazy when I hear a cymbal"""

key = "ICE"
encrypted_hex = repeating_key_xor(plaintext.encode(), key)

print(encrypted_hex)
