def fixed_xor(hex_str1, hex_str2):
    # Convert the input hexadecimal strings to binary
    binary1 = bytes.fromhex(hex_str1)
    binary2 = bytes.fromhex(hex_str2)
    #print(binary1,binary2)
    # Perform the XOR operation on the binary data
    result = bytes(x ^ y for x, y in zip(binary1, binary2))
    
    # Convert the result back to hexadecimal format
    result_hex = result.hex()
    
    return result_hex

# Example usage
hex_input1 = "1c0111001f010100061a024b53535009181c"
hex_input2 = "686974207468652062756c6c277320657965"
result = fixed_xor(hex_input1, hex_input2)

print(result)


# if __name__=='__main__':
#     main()
