def single_byte_xor(input_bytes, key):
    output = bytearray()
    for byte in input_bytes:
        output.append(byte ^ key)
    return output

def score_text(text):
    freq = {
        'a': 8.167, 'b': 1.492, 'c': 2.782, 'd': 4.253, 'e': 12.702, 'f': 2.228,
        'g': 2.015, 'h': 6.094, 'i': 6.966, 'j': 0.153, 'k': 0.772, 'l': 4.025,
        'm': 2.406, 'n': 6.749, 'o': 7.507, 'p': 1.929, 'q': 0.095, 'r': 5.987,
        's': 6.327, 't': 9.056, 'u': 2.758, 'v': 0.978, 'w': 2.360, 'x': 0.150,
        'y': 1.974, 'z': 0.074, ' ': 13.0  
    }
    score = sum(freq.get(chr(byte), 0) for byte in text.lower())
    return score

def decrypt_single_byte_xor(hex_string):
    ciphertext = bytes.fromhex(hex_string)
    best_score = 0
    best_plaintext = b''
    best_key = 0

    for key in range(256):
        plaintext = single_byte_xor(ciphertext, key)
        score = score_text(plaintext)
        
        if score > best_score:
            best_score = score
            best_plaintext = plaintext
            best_key = key

    return best_key, best_plaintext

hex_string = "1b37373331363f78151b7f2b783431333d78397828372d363c78373e783a393b3736"
key, plaintext = decrypt_single_byte_xor(hex_string)

print("Key:", key)
print("Plaintext:", plaintext.decode())
