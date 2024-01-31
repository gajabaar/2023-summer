def validate_and_strip_padding(plaintext):
    padding_length = plaintext[-1]
    if padding_length > len(plaintext) or plaintext[-padding_length:] != bytes([padding_length]) * padding_length:
        raise ValueError("Invalid PKCS#7 padding")
    return plaintext[:-padding_length]

plaintext1 = b"ICE ICE BABY\x04\x04\x04\x04"
plaintext2 = b"ICE ICE BABY\x05\x05\x05\x05"
plaintext3 = b"ICE ICE BABY\x01\x02\x03\x04"

try:
    validated_plaintext1 = validate_and_strip_padding(plaintext1)
    print("Validated plaintext 1:", validated_plaintext1.decode())
except ValueError as e:
    print("Error:", e)

try:
    validated_plaintext2 = validate_and_strip_padding(plaintext2)
    print("Validated plaintext 2:", validated_plaintext2.decode())
except ValueError as e:
    print("Error:", e)

try:
    validated_plaintext3 = validate_and_strip_padding(plaintext3)
    print("Validated plaintext 3:", validated_plaintext3.decode())
except ValueError as e:
    print("Error:", e)
