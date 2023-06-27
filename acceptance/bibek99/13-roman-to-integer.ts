const characterValues: Record<string, number> = {
  I: 1,
  V: 5,
  X: 10,
  L: 50,
  C: 100,
  D: 500,
  M: 1000,
};

function romanToInt(s: string): number {
  let result = 0;

  /** calculate for upto the second last character */
  for (let i = 0; i < s.length - 1; i++) {
    if (characterValues[s[i]] < characterValues[s[i + 1]]) {
      result -= characterValues[s[i]];
    } else {
      result += characterValues[s[i]];
    }
  }

  /** add value for last roman character */
  result += characterValues[s.slice(-1)];

  return result;
}
