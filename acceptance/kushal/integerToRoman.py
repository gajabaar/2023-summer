class Solution:
    def __init__(self):
        self.corr_value = {1000: 'M',900: 'CM',500: 'D',400: 'CD',100: 'C',90: 'XC',50: 'L',40: 'XL',10: 'X',9: 'IX',5: 'V',4: 'IV',1: 'I'}
    
    def intToRoman(self, num: int) -> str:
        roman_value = ''
        for value, numeral in self.corr_value.items():
            while num >= value:
                roman_value += numeral
                num -= value
        return roman_value

result = Solution()
print(result.intToRoman(3452))
