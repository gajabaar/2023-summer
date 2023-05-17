character_map={'I':1,'V':5,'X':10,'L':50,'C':100,'D':500,'M':1000 }
class Solution:
    def romanToInt(self, roman: str) -> int:
        
        integer_value=0
        i=0
        while i+1<len(roman): #checking two characters as a group
            current_number = character_map.get(roman[i])
            next_number = character_map.get(roman[i+1])
            if(current_number>=next_number):
                integer_value += current_number
                i = i + 1
            else:
                integer_value = integer_value + (next_number-current_number)
                i = i + 2
        if i < len(roman): # since we check for i+1 < len(roman) we miss the last character in some cases.
            integer_value += character_map.get(roman[i])
        return integer_value
    



#Main Program
s=Solution()
print(s.romanToInt("MDCCLXXXIX"))
