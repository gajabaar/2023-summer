def simplifyPath(path):
    stack = []
    components = path.split("/")

    for component in components:
        if component == "..":
            if stack:
                stack.pop()
        elif component != "." and component != "":
            stack.append(component)

    simplified_path = "/" + "/".join(stack)

    return simplified_path


path = input("Enter a path: ")
simplified_path = simplifyPath(path)
print("Simplified path:", simplified_path)
