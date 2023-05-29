class Solution:
    def simplifyPath(self, path: str) -> str:
        final=[]
        splitted=path.split('/')
        for i in splitted:
            if i!='' and i!='.' and i!='..':
                final.append(i)
            elif i=='..':
                if len(final)>0:
                    final.pop()

        return '/'+'/'.join(final)

