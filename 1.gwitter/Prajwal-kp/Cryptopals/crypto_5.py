def repeating_key_xor(text,key):
    encrypted= bytearray()
    key_length=len(key)
    for i in range(len(text)):
        encrypted.append(text[i]^key[i%key_length])
    return encrypted.hex()

plaintext="Burning 'em, if you ain't quick and nimble I go crazy when I hear a cymbal"
key="ICE"

plaintext_bytes=plaintext.encode()
key_bytes=key.encode()

encrypted_text=repeating_key_xor(plaintext_bytes,key_bytes)

print(encrypted_text)

decrypted_text_bytes = bytearray.fromhex(encrypted_text)
decrypted_text = repeating_key_xor(decrypted_text_bytes, key_bytes)
print("Decrypted text:", bytes.fromhex(decrypted_text).decode())