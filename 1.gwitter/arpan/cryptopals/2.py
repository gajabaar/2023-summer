def xor_encrypt(buffer1, buffer2):
    bytes1 = bytes.fromhex(buffer1)
    bytes2 = bytes.fromhex(buffer2)
    xor_result = bytes(a ^ b for a, b in zip(bytes1, bytes2))
    xor_hex = xor_result.hex()
    return xor_hex

hex_buffer1 = "1c0111001f010100061a024b53535009181c"
hex_buffer2 = "686974207468652062756c6c277320657965"
result = xor_encrypt(hex_buffer1, hex_buffer2)
print("XOR Result:", result)
