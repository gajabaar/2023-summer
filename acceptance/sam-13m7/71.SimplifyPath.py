class Solution:
    def simplifyPath(self, path: str) -> str:
    
        stack=[]
        for a in path.split('/'):
            if a=='..':
                if stack:
                    stack.pop()

            elif a not in ('','.'):
                stack.append(a)


        return "/"+"/".join(stack) 
