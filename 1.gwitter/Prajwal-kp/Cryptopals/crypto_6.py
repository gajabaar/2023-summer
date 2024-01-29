import requests
import base64
import string


URL = 'https://cryptopals.com/static/challenge-data/6.txt'
text = requests.get(URL).text
data = base64.b64decode(text)

print(len(data))
def repeating_xor(data, key):
    res = []
    for i, c in enumerate(data):
        k = key[i % len(key)]
        res.append(c ^ k)
    return bytes(res)



def english_score(data):    
    s = 0
    data = data.lower()
    common = b"etaoin shrdlu"[::-1]
    
    for c in data:
        if chr(c) not in string.printable:
            return 0
        
        i = common.find(c)
        if i != -1:
            s += i
    
    return s

def single_xor(ciphertext, key):
    plain = [x ^ key for x in ciphertext]
    return bytes(plain)

# def hamming_distance(str1, str2):
#     if len(str1) != len(str2):
#         raise ValueError("Input strings must have the same length")

#     # Convert each character to its ASCII value and then to binary representation
#     bin_str1 = ''.join(format(ord(c), '08b') for c in str1)
#     bin_str2 = ''.join(format(ord(c), '08b') for c in str2)

#     return sum(c1 != c2 for c1, c2 in zip(bin_str1, bin_str2))

# string1 = "this is a test"
# string2 = "wokka wokka!!!"

# distance = hamming_distance(string1, string2)
# print(distance)

def edit_distance(s1, s2):
    # Function to calculate the edit distance between two strings
    return sum(c1 != c2 for c1, c2 in zip(s1, s2))

def keysize_edit_distance(ciphertext, keysize):
    prev = None
    diff = 0
    n = 0
    
    for i in range(0, len(ciphertext), keysize):
        chunk = ciphertext[i:i+keysize]
        if prev:
            diff += edit_distance(chunk, prev) / keysize
            n += 1
        prev = chunk
    diff /= n
    return diff

# Assuming data is your ciphertext
keysize = min(range(2, 40), key=lambda x: keysize_edit_distance(data, x))
print("Probable key size:", keysize)


key = []

blocks = [data[i:i+keysize] for i in range(0, len(data), keysize)]

for key_i in range(keysize):
    chunk = b""
    for bl in blocks:
        if key_i < len(bl):
            chunk += bytes([bl[key_i]])

    k = max(range(255), key=lambda x: english_score(single_xor(chunk, x)))
    key.append(k)

print(bytes(key).decode('ascii'))

plaintext = repeating_xor(data, bytes(key)).decode('ascii')

print(plaintext[:-1])