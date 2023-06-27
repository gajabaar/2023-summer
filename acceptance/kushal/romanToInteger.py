class Solution:
    def __init__(self):
        self.corr_value = {'I': 1,'V': 5,'X': 10,'L': 50,'C': 100,'D': 500,'M': 1000}

    def romanToInt(self, rom: str) -> int:
        result = 0
        prev_value = 0

        for i in range(len(rom)-1, -1, -1):
            curr_value = self.corr_value[rom[i]]
            if curr_value < prev_value:
                result -= curr_value
            else:
                result += curr_value
            prev_value = curr_value

        return result

rom = Solution()
print(rom.romanToInt('III'))     
print(rom.romanToInt('LVIII'))   
print(rom.romanToInt('MCMXCIV')) 
