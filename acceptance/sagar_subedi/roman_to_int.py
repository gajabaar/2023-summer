class Solution:
    def romanToInt(self, s: str) -> int:
        roman_mapping = {'I': 1, 'V': 5, 'X': 10, 'L': 50, 'C': 100, 'D': 500, 'M': 1000}
        length = len(s)
        result = roman_mapping[s[length - 1]]
        for i in range(length-2, -1, -1):
            if(roman_mapping[s[i]] >= roman_mapping[s[i+1]] ): result += roman_mapping[s[i]]
            else: result -= roman_mapping[s[i]]
        return result