class Solution(object):
    def simplifyPath(self, path):
        """
        :type path: str
        :rtype: str
        """
        path_stack = []
        for s in path.split("/"):
            if not s:
                continue
            elif s == ".":
                continue
            elif s == "..":
                if path_stack:
                    path_stack.pop()
            else:
                path_stack.append(s)
        return "/" + "/".join(path_stack)