class Solution:
    def simplifyPath(self, path: str) -> str:
        stack =[]
        canonical_path = ""
        
        list = path.split('/') 
        for item in list:
            if item == "..":
                if len(stack)>0:
                    stack.pop()
            elif item == "." or item == "":
                continue
            else:    
                stack.append(item)
        for it in stack: 
            if it == '':
                continue
            canonical_path = canonical_path+"/"+it
        if canonical_path == "": # if the stack items are all popped.
            canonical_path += "/"    
        return canonical_path
    

solution = Solution()
print(solution.simplifyPath("/../"))