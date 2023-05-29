class Solution:
    def intToRoman(self, num: int) -> str:
        roman=''

        if num/1000>=1:
            for i in range(int(num/1000)):
                roman+='M'
                num=num%1000

        if num/500>=1:
            if num%1000==900:
                roman+='CM'
                return roman
            elif num%1000>900:
                roman+='CM'
                num=num%100
            else:
                roman+='D'
                num=num%500

        if num/100>=1:
            if num%500==400:
                roman+='CD'
                return roman
            elif num%500>400:
                roman+='CD'
                num=num%100 
            else:
                for i in range(int(num/100)):
                    roman+='C'
                    num=num%100

        if num/50>=1:
            if num%100==90:
                roman+='XC'
                return roman
            elif num%100>90:
                roman+='XC'
                num=num%10 
            else:
                roman+='L'
                num=num%50


        if num/10>=1:
            if num%50==40:
                roman+='XL'
                return roman
            elif num%50>40:
                roman+='XL'
                num=num%10 
            else:
                for i in range(int(num/10)):
                    roman+='X'
                    num=num%10
        
        if num/5>=1:
            if num%10==9:
                roman+='IX'
                return roman
            else:
                roman+='V'
                num=num%5
        
        if num%5==4:
            roman+='IV'
            return roman
        else:                
            for i in range(num):
                roman+='I'
            
        return roman


