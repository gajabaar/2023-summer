class Solution:
    def simplifyPath(self, path: str) -> str:
        path_arr = path.split('/')
        stack = []
        length = len(path_arr)
        current_item = ''
        
        for i in range(length):
            current_item = path_arr[i]
            if current_item == '' or current_item == '.':
                continue
            if current_item == '..':
               if stack:
                   stack.pop()
            else:
                stack.append(current_item)
        
        return '/' + '/'.join(stack)
            