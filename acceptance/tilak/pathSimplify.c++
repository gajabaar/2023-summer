#include <iostream>
#include<bits/stdc++.h>
#include <stack>
using namespace std;
// I printed stack content to check element are in proper order or not
void printStack (stack <string> values) {
    
    if (values.empty ()) {
        return;
    }

    string topElement = values.top ();
    values.pop();
    cout << topElement << endl;

    printStack (values);
}
string simplifyPath(string path){
    stack<string>s; // used for push and pop operation
    string res;  // for string result
    
    for(int i=0;i<path.size();i++){
        // skip if '/' and '.'
        if(path[i] == '/'  ) continue;
        string temp; // used to store path between '/path/'
        while(i< path.size() && path[i] != '/'){
            temp += path[i];
            i++;
        }
        // cout<<temp<<endl; checking what is between two '/'
        if(temp==".") continue;
        // check of .. between '/' if present then pop element from stack
        else if(temp == ".."){
            if(!s.empty()){
                s.pop();
            }
        }
        else {
            s.push(temp);
        }
    }
 while(!s.empty()){
     res+='/'+s.top();
     s.pop();
 }
    if(res.size()==0) return "/";
    return res;
}

int main() {
    string str ;
    cout<<"Enter path ";
    cin>>str;
    cout<<"------------"<<endl;
   string result = simplifyPath(str);
cout<<"simplify path: "<<result<<endl;
    return 0;
}