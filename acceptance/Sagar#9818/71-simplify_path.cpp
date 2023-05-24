#include <bits/stdc++.h>

using namespace std;

class Solution {
public:
    string simplifyPath(string path) {
        string result=""; 
        vector<string>store;

        istringstream ss(path);

        string p;
        while(getline(ss, p, '/'))
        {
            //cout << p << endl;
            if( p.empty() || p=="." )continue;
   
            if( p==".." )
            {
                if( !store.empty() )store.pop_back();
            }
            else 
                store.push_back(p);
        }

        //cout << store.size() << endl;

        for( auto s: store )
            result += "/" + s;

        //cout << result << endl; 

        result = result.empty()?"/":result;

        return result;
    }
};