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

  String intToRoman(int num) {
    String res = '';

    bool cond = true;

    while (cond) {
      cond = false;
      for (int val in values) {
        if (val <= num) {
          String index = symbol[values.indexOf(val)];
          res = res + index;
          num = num - val;
          cond = true;
          break;
        }
      }
    }

    return res;
  }
}
