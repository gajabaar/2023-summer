class Solution(object):
        knownValue={"M":1000,"CM":900,"D":500, "CD":400,"C":100,"XC":90,"L":50,"XL":40,"X":10,"IX":9,"IV":4,"V":5,"I":1}
        def intToRoman(self,num):
            self.num=num
            if (num<1 | num>3999):
                print("invalid input")
            else:
                Roman=""
                for i in self.knownValue:
                        if(num>=self.knownValue[i]):
                                div=int(num/self.knownValue[i])
                                rem=num%self.knownValue[i]
                                for j in range(0,div):
                                        Roman=Roman+i
                                num=num-div*self.knownValue[i]
            return Roman
"""
a = Solution()
result = a.intToRoman(1994)
print(result)
"""