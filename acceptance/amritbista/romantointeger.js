/**
 * @param {string} s
 * @return {number}
 */
var romanToInt = function (s) {
  const weight = (S) => {
    if (S == "I") return 1;
    if (S == "V") return 5;
    if (S == "X") return 10;
    if (S == "L") return 50;
    if (S == "C") return 100;
    if (S == "D") return 500;
    if (S == "M") return 1000;
    return console.log("error");
  };

  function romanToDecimal(str) {
    var dec = 0;

    for (i = 0; i < str.length; i++) {
      // get the value of s[i] term
      var s1 = weight(str.charAt(i));

      // get the value of s[i+1] term
      if (i + 1 < str.length) {
        var s2 = weight(str.charAt(i + 1));

        // To compare both values
        if (s1 >= s2) {
          //if value of current symbol is greater or equal to that of upcomming symbol just add it
          dec = dec + s1;
        } else {
          // else subtract the value
          dec = dec + s2 - s1;
          i++;
        }
      } else {
        dec = dec + s1;
      }
    }

    return dec;
  }

  return romanToDecimal(s);
};
