class Solution(object):
    def romanToInt(self, s):
        roman_dict = {
        'I': 1,
        'V': 5,
        'X': 10,
        'L': 50,
        'C': 100,
        'D': 500,
        'M': 1000
        }
        result = 0
        prev_val = 0
        for i in range(len(s) - 1, -1, -1):
            val = roman_dict[s[i]]
            if val < prev_val:
                result -= val
            else:
                result += val
            prev_val = val
        return result

solution = Solution()
output = solution.romanToInt("VI")
print(output)    # Output: 6