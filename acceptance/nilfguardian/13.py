def romanToInt(s):
    roman_dict = {'I': 1, 'V': 5, 'X': 10, 'L': 50, 'C': 100, 'D': 500, 'M': 1000}
    prev_value = 0
    total = 0

    for i in range(len(s) - 1, -1, -1):
        current_value = roman_dict[s[i]]

        if current_value >= prev_value:
            total += current_value
        else:
            total -= current_value

        prev_value = current_value

    return total


roman_numeral = input("Enter a Roman numeral: ")
result = romanToInt(roman_numeral)
print("Integer value:", result)