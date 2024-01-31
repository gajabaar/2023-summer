from Crypto.Cipher import AES
from Crypto.Random import get_random_bytes
import urllib.parse

def parse_query_string(query_string):
    return dict(urllib.parse.parse_qsl(query_string))

def encode_user_profile(email):
    if '&' in email or '=' in email:
        raise ValueError("Invalid characters in email")
    
    user_profile = {
        "email": email,
        "uid": 10,
        "role": "user"
    }
    encoded_profile = urllib.parse.urlencode(user_profile)
    return encoded_profile

def encrypt_profile(profile, key):
    cipher = AES.new(key, AES.MODE_ECB)
    padded_profile = pad_pkcs7(profile.encode())
    return cipher.encrypt(padded_profile)

def decrypt_profile(ciphertext, key):
    cipher = AES.new(key, AES.MODE_ECB)
    decrypted_profile = cipher.decrypt(ciphertext)
    return remove_pkcs7_padding(decrypted_profile).decode()

def pad_pkcs7(data):
    pad_length = AES.block_size - (len(data) % AES.block_size)
    return data + bytes([pad_length] * pad_length)

def remove_pkcs7_padding(data):
    pad_length = data[-1]
    if pad_length > AES.block_size or not all(byte == pad_length for byte in data[-pad_length:]):
        raise ValueError("Invalid PKCS#7 padding")
    return data[:-pad_length]

def main():
    key = get_random_bytes(AES.block_size)

    email = "foo@bar.com"
    profile = encode_user_profile(email)
    
    ciphertext = encrypt_profile(profile, key)

    decrypted_profile = decrypt_profile(ciphertext, key)
    parsed_profile = parse_query_string(decrypted_profile)
    
    malicious_email = "malicious@example.com"
    malicious_profile = encode_user_profile(malicious_email + (" " * (AES.block_size - len("email="))))
    ciphertext_admin = encrypt_profile(malicious_profile, key)
    
    decrypted_admin_profile = decrypt_profile(ciphertext_admin, key)
    parsed_admin_profile = parse_query_string(decrypted_admin_profile)
    
    print("Original User Profile:")
    print(parsed_profile)
    
    print("\nMalicious Admin Profile:")
    print(parsed_admin_profile)

if __name__ == "__main__":
    main()
