class Solution {
  List<int> values = [1000, 900, 500, 400, 100, 90, 50, 40, 10, 9, 5, 4, 1];
  List<String> symbol = [
    "M",
    "CM",
    "D",
    "CD",
    "C",
    "XC",
    "L",
    "XL",
    "X",
    "IX",
    "V",
    "IV",
    "I"
  ];
  int romanToInt(String s) {
    int total = 0;

    for (int i = 0; i < s.length; i++) {
      try {
        if (values[symbol.indexOf(s[i])] >= values[symbol.indexOf(s[i + 1])]) {
          total = total + values[symbol.indexOf(s[i])];
        } else {
          total = total - values[symbol.indexOf(s[i])];
        }
      } finally {
        if (i == (s.length - 1)) {
          total = total + values[symbol.indexOf(s[i])];
          break;
        }
      }
    }
    return total;
  }
}
