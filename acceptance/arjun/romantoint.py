class Solution(object):
    
    def romanToInt(self, st):
        number = 0
        equivalent = {"I":1,"V":5,"X":10,"L":50,"C":100,"D":500,"M":1000}
        for i in range(len(st)-1):
                if (equivalent[st[i]] < equivalent[st[i+1]]):
                    number -= equivalent[st[i]]
                else:
                    number += equivalent[st[i]]
        
        return number+equivalent[st[-1]]