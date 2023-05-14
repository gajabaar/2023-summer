import math
number_map = {0:'',1:'I',5:'V',10:'X',50:'L',100:'C',500:'D',1000:'M'}
class Solution:
    def intToRoman(self, number: int) -> str:
        if number_map.get(number) is not None:
            return number_map.get(number)
        roman =""
        place = 1 
        while number > 0:
            last = number % 10 #get the last number
            roman = get_roman(last,place) + roman
            number = math.trunc(number /10)
            place = place * 10
        return roman
    

def get_roman(num:int,moder:int):

    if number_map.get(num*moder) is not None:
        return number_map.get(num*moder)
    if num == 4:
        return str(number_map.get(moder)+ number_map.get(5*moder))
    elif num == 9:
        # 1st symbol for mth place-value symbol  like I,X,C and M and higher place-value 1st symbol
        return str(number_map.get(moder)+number_map.get(moder*10))
    elif num<4:
        # 1st symbol for mth place-value n times 1,2 or 3
        return str(number_map.get(moder))*num
    else:
        # 5th place symbol for a place and 1 place-value symbom for n times
        return str(number_map.get(5*moder)+number_map.get(moder)*(num-5)) 

    





#Main Program
s=Solution()
print(s.intToRoman(1789))