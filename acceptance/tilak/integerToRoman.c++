#include <iostream>
#include<bits/stdc++.h>
using namespace std;
string integerToRoman(int num){
      string roman="";
  vector<string>r={"I","IV","V","IX","X","XL","L","LC","C","CD","D","DM","M"};
  vector<int>val={1,4,5,9,10,40,50,90,100,400,500,900,1000};
  reverse(r.begin(),r.end());
  reverse(val.begin(),val.end());
  int i=0;
 while(num > 0){
    while(num >= val[i]){
        roman += r[i];
        num -= val[i];
        
    } 
    i++;
 }

 return roman;
}

int main() {
int n;
cout<<"enter integer"<<endl;
cin>>n;
cout<<endl;
cout<<"Equivalent Roman Number: ";
cout<<integerToRoman(n)<<endl;
return 0;
}