class Solution:
    def romanToInt(self, s: str) -> int:
        romanValue={
            'I':1,
            'V':5,
            'X':10,
            'L':50,
            'C':100,
            'D':500,
            'M':1000
        }

        revRoman=s[::-1]

        value=0 + romanValue[revRoman[0]]

        for i in range(1,len(revRoman)):
            if romanValue[revRoman[i]]<romanValue[revRoman[i-1]]:
                value-=romanValue[revRoman[i]]
            else:
                value+=romanValue[revRoman[i]]

        return value
