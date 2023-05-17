#include <bits/stdc++.h>

using namespace std;

class Solution {
public:
    int romanToInt(string s) {

        int n = s.length()-1;
        int ans = 0;

        auto value = [](char ch)->int{
            switch(ch)
            {
                case 'M': return 1000;
                case 'D': return 500;
                case 'C': return 100;
                case 'L': return 50;
                case 'X': return 10;
                case 'V': return 5; 
                case 'I': return 1;
            }

            return 0;
        };

        int temp = 0;

        for( int i=n; i>=0; --i )
        {
            auto val = value(s[i]);
            if( val>=temp )
                ans += val;
            else 
                ans -= val;

            temp = val;
        }

        return ans;
    }
};