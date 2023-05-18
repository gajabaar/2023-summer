class Solution {
public:
    int romanToInt(string r) {
        int answer = 0;
        map<char, int> map;

        map['I'] = 1;
         map['L'] = 50;
        map['C'] = 100;
       
        map['V'] = 5;
        map['X'] = 10;
         map['D'] = 500;
        map['M'] = 1000;
       
        
       
        
        for(int i=0; i<r.length(); i++){
            if(map[r[i]] < map[r[i+1]]){
                answer -= map[r[i]];
            }
            else{
                answer += map[r[i]];
            }
        }
        return answer;

    }
};