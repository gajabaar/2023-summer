const characterValues: Record<number, string> = {
  1: "I",
  5: "V",
  10: "X",
  50: "L",
  100: "C",
  500: "D",
  1000: "M",
};

/**
 *
 * @param intValue actual value to be converted
 * @param multiplier significant multiplier for the digit place: 1, 10, 1000
 * @returns a roman string for the supplied int value
 */
function getRoman(intValue: number, multiplier: number): string {
  if (characterValues[intValue * multiplier]) {
    return characterValues[intValue * multiplier];
  }

  if (intValue < 4) {
    /** repeat the unit roman string */
    return characterValues[multiplier].repeat(intValue);
  } else if (intValue === 4) {
    /** add a unit string before the string for 5* */
    return characterValues[multiplier] + characterValues[5 * multiplier];
  } else if (intValue === 9) {
    /** add a unit string before the string for 10* */
    return characterValues[multiplier] + characterValues[multiplier * 10];
  } else {
    /** repeat the unit strings after a string of 5* */
    return (
      characterValues[5 * multiplier] +
      characterValues[multiplier].repeat(intValue - 5)
    );
  }
}

function intToRoman(num: number): string {
  /** out of constraint */
  if (num < 1 || num > 3999) return "";

  let roman = "";
  let multiplier = 1;

  while (num > 0) {
    const lastDigit = num % 10;
    roman = getRoman(lastDigit, multiplier) + roman;
    multiplier = multiplier * 10;
    num = Math.floor(num / 10);
  }

  return roman;
}
