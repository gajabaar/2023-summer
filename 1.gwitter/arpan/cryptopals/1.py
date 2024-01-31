import binascii
import base64

def hex_to_binary(hex_string):
    binary_data = binascii.unhexlify(hex_string)
    return binary_data 

def binary_bits(binary_data):
    binary_bits = ''.join(format(byte, '08b') for byte in binary_data)
    return binary_bits

def binary_to_base64(binary_data):
    base64_data=base64.b64encode(binary_data)
    return base64_data.decode()

hex_string = "49276d206b696c6c696e6720796f757220627261696e206c696b65206120706f69736f6e6f7573206d757368726f6f6d"
binary_data = hex_to_binary(hex_string)
binary_bits = binary_bits(binary_data)
base64_data = binary_to_base64(binary_data)

print("Hex:", hex_string)
print("Binary:",binary_data)
print("Binary Bits:", binary_bits)
print("Base64:", base64_data)
