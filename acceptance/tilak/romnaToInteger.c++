#include <iostream>
#include <bits/stdc++.h>
using namespace std;

int romanToInteger(string romanNumber){
unordered_map<char,int>roman;
roman['I'] = 1;
roman['V'] = 5;
roman['X'] = 10;
roman['L'] = 50;
roman['C'] = 100;
roman['D'] = 500;
roman['M'] = 1000;


int result = 0;
for(int i=0;i<romanNumber.length();i++)
{
// left value is less than right then subtract otherwise add to result
    if(i<romanNumber.length() && (roman[romanNumber[i]] < roman[romanNumber[i+1]])){ 
        result -= roman[romanNumber[i]];
      
    }
    else result +=roman[romanNumber[i]];
}

return result;
}
int main() {
string Roman;
cout<<"Enter Roman number:";
cin>>Roman;
cout<<endl;
cout<<"Integer: "<<romanToInteger(Roman);
    return 0;
}