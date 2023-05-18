class Solution:
    def int_to_roman(self, num):
        roman_mappings = [
            (1000, "M"),
            (900, "CM"),
            (500, "D"),
            (400, "CD"),
            (100, "C"),
            (90, "XC"),
            (50, "L"),
            (40, "XL"),
            (10, "X"),
            (9, "IX"),
            (5, "V"),
            (4, "IV"),
            (1, "I")
        ]

        pointer = 0
        roman_numeral = ""

        while num:
            if num >= roman_mappings[pointer][0]:
                roman_numeral += roman_mappings[pointer][1]
                num -= roman_mappings[pointer][0]
            else:
                pointer += 1

        return roman_numeral
