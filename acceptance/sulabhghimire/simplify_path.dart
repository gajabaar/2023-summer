class Solution {
  String simplifyPath(String path) {
    List<String> stack = [];
    String curr = "";
    path += '/';
    List<String> pathValue = path.split('');

    for (String char in pathValue) {
      if (char == '/') {
        if (curr == '..') {
          if (stack.isNotEmpty) {
            stack.removeLast();
          }
        } else if (curr != '' && curr != '.') {
          stack.add(curr);
        }
        curr = '';
      } else {
        curr += char;
      }
    }

    String val = '/' + stack.join('/');
    return val;
  }
}
