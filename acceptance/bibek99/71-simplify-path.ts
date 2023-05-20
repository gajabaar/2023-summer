function simplifyPath(path: string): string {
  const splittedPath = path.split("/").filter(Boolean);

  const actualPath: string[] = [];

  for (let path of splittedPath) {
    if (path === "..") {
      /** move a path up */
      actualPath.pop();
    } else if (path !== ".") {
      /** only push if a path */
      actualPath.push(path);
    }
  }

  return "/" + actualPath.join("/");
}
