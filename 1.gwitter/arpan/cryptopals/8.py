from collections import Counter

def detect_ecb(ciphertext, block_size=16):
    blocks = [ciphertext[i:i + block_size] for i in range(0, len(ciphertext), block_size)]
    block_counts = Counter(blocks)
    for count in block_counts.values():
        if count > 1:
            return True
    return False

def detect_ecb_in_file(file_path):
    with open(file_path, "r") as file:
        for line_num, line in enumerate(file, 1):
            ciphertext = bytes.fromhex(line.strip()) 
            if detect_ecb(ciphertext):
                print(f"ECB mode detected in line {line_num}")
                return ciphertext

file_path = "8.txt"

ciphertext_with_ecb = detect_ecb_in_file(file_path)
