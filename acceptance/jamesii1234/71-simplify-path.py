class Solution:
        def simplifyPath(self,path):         
                self.path=path
                stack=[]
                current=""

                for i in path + "/":
                         if i=="/":
                                 if current == "..":
                                        if stack:stack.pop()
                                 elif current !="" and current !=".":
                                         stack.append(current)
                                 current=""
                         else:
                                 current+=i

                return "/"+"/".join(stack)
"""
a=Solution().simplifyPath("/home//foo/")
print(a)
"""        