class Solution(object):
    knownValue = {"M": 1000, "D": 500, "C": 100, "L": 50, "X": 10, "V": 5, "I": 1}
    number = 0
    def romanToInt(self, s):
        self.s=s
        previous = 0
        length = len(s)

        for i in range(0,length):
            current = 0
            for j in self.knownValue:
                if s[i] == j:
                    current = self.knownValue[j]
                    if current > previous:
                        self.number += current - 2 * previous
                    else:
                        self.number += current
                    previous = current
                    break
        return self.number
"""
a = Solution()
result = a.romanToInt("MCMXCIV")
print(result)
"""