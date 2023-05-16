class Solution(object):
    def simplifyPath(self, path):
        # Split the path into directories
        dirs = path.split("/")
        print(dirs) #check 
        stack = []
        for dir in dirs:
            # Ignore empty directories and current directory
            if dir == "" or dir == ".":
                continue
            # If "..", pop the last directory from the stack
            if dir == "..":
                if len(stack) > 0:
                    stack.pop()
            # Or, push the directory onto the stack
            else:
                stack.append(dir)
        # Join the remaining directories on the stack and return the simplified path
        return "/" + "/".join(stack)
    
solution = Solution()
output = solution.simplifyPath("/home//foo/")
print(output)    