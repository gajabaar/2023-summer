import base64
import itertools
import operator
import string

def hamming_distance(bytes1, bytes2):
    return sum(bin(byte1 ^ byte2).count('1') for byte1, byte2 in zip(bytes1, bytes2))

def find_key_size(ciphertext, max_keysize=40):
    distances = {}
    for keysize in range(2, max_keysize + 1):
        chunks = [ciphertext[i:i + keysize] for i in range(0, len(ciphertext), keysize)][:4]
        pairs = itertools.combinations(chunks, 2)
        total_distance = sum(hamming_distance(pair[0], pair[1]) for pair in pairs) / len(chunks)
        distances[keysize] = total_distance / keysize

    return min(distances.items(), key=operator.itemgetter(1))[0]

def transpose_blocks(ciphertext, key_size):
    transposed_blocks = [bytearray() for _ in range(key_size)]
    for i, byte in enumerate(ciphertext):
        transposed_blocks[i % key_size].append(byte)
    return transposed_blocks


def single_byte_xor_decrypt(ciphertext):
    candidates = []
    for key in range(256):
        plaintext = bytearray(len(ciphertext))
        for i in range(len(ciphertext)):
            plaintext[i] = ciphertext[i] ^ key
        candidates.append(plaintext)
    return max(candidates, key=lambda s: s.count(b' '))  



def decrypt_repeating_xor(ciphertext):
    missing_padding = len(ciphertext) % 4
    if missing_padding:
        ciphertext += b'=' * (4 - missing_padding)

    ciphertext = base64.b64decode(ciphertext) 
    key_size = find_key_size(ciphertext)
    transposed_blocks = transpose_blocks(ciphertext, key_size)
    key = bytearray()
    for block in transposed_blocks:
        key.append(single_byte_xor_decrypt(block)[0])
    plaintext = bytearray()
    for i, byte in enumerate(ciphertext):
        plaintext.append(byte ^ key[i % len(key)])
    return bytes(plaintext)  


import base64

def read_ciphertext_from_file(file_path):
    with open(file_path, "rb") as file:
        ciphertext = file.read()
    return ciphertext


file_path = "6.txt"

ciphertext = read_ciphertext_from_file(file_path)
plaintext = decrypt_repeating_xor(ciphertext)
print(plaintext)

