import codecs

def decrypt_single_byte_xor(ciphertext):
    def score_text(text):
        score = 0
        for char in text:
            if 65 <= char <= 90 or 97 <= char <= 122:
                score += 1
        return score

    best_score = 0
    best_key = 0
    best_message = ""

    ciphertext_bytes = bytes.fromhex(ciphertext)

    for key in range(256):
        decrypted = bytes(x ^ key for x in ciphertext_bytes)
        score = score_text(decrypted)

        if score > best_score:
            best_score = score
            best_key = key
            best_message = decrypted.decode('utf-8')

    return best_key, best_message

hex_string = '1b37373331363f78151b7f2b783431333d78397828372d363c78373e783a393b3736'
best_key, decrypted_message = decrypt_single_byte_xor(hex_string)

print("Best key:", best_key)
print("Decrypted message:", decrypted_message)
