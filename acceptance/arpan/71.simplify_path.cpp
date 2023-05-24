class Solution {
public:
    string simplifyPath(string path) {
        vector<string> dirOrFiles;
        stringstream ss(path);
        string dirOrFile;
        while (getline(ss, dirOrFile, '/')) {
            if (!dirOrFiles.empty() && dirOrFile == "..") {
                dirOrFiles.pop_back();
            } else if (dirOrFile != "." && dirOrFile != "" && dirOrFile != "..") {
                dirOrFiles.push_back(dirOrFile);
            }
        }
        string simplified_path = "";
        for (string dirOrFile : dirOrFiles) {
            simplified_path += "/" + dirOrFile;
        }
        return simplified_path.empty() ? "/" : simplified_path;
        
    }
};