import string

def single_byte_xor_decrypt(ciphertext, key):
    plaintext = bytearray.fromhex(ciphertext)
    decrypted = bytearray(len(plaintext))
    for i in range(len(plaintext)):
        decrypted[i] = plaintext[i] ^ key
    return decrypted

def score_plaintext(plaintext):
    # Define a score function based on the frequency of English characters
    freq = {
        'a': 8.167, 'b': 1.492, 'c': 2.782, 'd': 4.253, 'e': 12.702, 'f': 2.228, 'g': 2.015, 'h': 6.094,
        'i': 6.966, 'j': 0.153, 'k': 0.772, 'l': 4.025, 'm': 2.406, 'n': 6.749, 'o': 7.507, 'p': 1.929,
        'q': 0.095, 'r': 5.987, 's': 6.327, 't': 9.056, 'u': 2.758, 'v': 0.978, 'w': 2.360, 'x': 0.150,
        'y': 1.974, 'z': 0.074, ' ': 13.000
    }
    
    score = 0
    for char in plaintext.lower():
        if char in freq:
            score += freq[char]
    return score

def find_best_decryption(hex_strings):
    best_score = 0
    best_plaintext = ""
    best_key = 0
    best_ciphertext = ""

    for hex_str in hex_strings:
        for key in range(256):
            decrypted = single_byte_xor_decrypt(hex_str, key)
            plaintext = decrypted.decode('utf-8', 'ignore')
            current_score = score_plaintext(plaintext)

            if current_score > best_score:
                best_score = current_score
                best_plaintext = plaintext
                best_key = key
                best_ciphertext = hex_str

    return best_plaintext, best_key, best_score, best_ciphertext

# Load the hex-encoded strings from the provided file
with open("crp_4.txt", "r") as file:
    hex_strings = [line.strip() for line in file]

best_plaintext, best_key, best_score, best_ciphertext = find_best_decryption(hex_strings)
print("Ciphertext Line:", best_ciphertext)
print("Plaintext:", best_plaintext)
print("Key:",best_key)
print("Score:", best_score)
