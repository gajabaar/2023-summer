class Solution:
    def simplifyPath(self, path: str) -> str:
        stack = []
        components = path.split('/')

        for component in components:
            if component == '' or component == '.':
                continue
            elif component == '..':
                if stack:
                    stack.pop()
            else:
                stack.append(component)

        simplified_path = '/' + '/'.join(stack)
        return simplified_path

s = Solution()
print(s.simplifyPath("/home/"))      
print(s.simplifyPath("/../"))          
print(s.simplifyPath("/home//foo/"))   
