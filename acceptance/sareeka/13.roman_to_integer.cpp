class Solution {
public:
    int romanToInt(string s) {
        int num = 0;
        int prev = 0;
        int curr = 0; 
        
        //moving from right to left
        for (int i = s.length() - 1; i >= 0; i--) {
            curr = getValue(s[i]);
            
            if (curr < prev) {
                num -= curr;
            } else {
                num += curr;
            }
            
            prev = curr;
        }

        return num;
    }
    
private:
    int getValue(char c) {
        switch(c) {
            case 'M': return 1000;
            case 'D': return 500;
            case 'C': return 100;
            case 'L': return 50;
            case 'X': return 10;
            case 'V': return 5;
            case 'I': return 1;
            default: return 0;
        }
    }
};