function splitIntoPlace(num) {
    let digits = [];
    let divisor = 1;
    while (num >= divisor) {
        digits.unshift(Math.floor(num % (divisor * 10) / divisor) * divisor);
        divisor *= 10;
    }
    return digits;
}

var intToRoman = function (num) {
    let numArr = [1, 5, 10, 50, 100, 500, 1000];
    let romanArr = ['I', 'V', 'X', 'L', 'C', 'D', 'M']
    let rArrLen = romanArr.length;
    let convertRoman = [];
    let placeDigitArr = splitIntoPlace(num);
    let i = 0;
    placeDigitArr.forEach((element) => {
        for (k = 0; k < rArrLen; k++) {
            if (element == numArr[k]) {
                convertRoman.push(romanArr[k]);
            }
            else if (element != numArr[k] && element < numArr[k + 1]) {
                if (element == (numArr[k] + numArr[k])) {
                    convertRoman.push(romanArr[k] + romanArr[k]);
                }
                else if (element == (numArr[k] + numArr[k] + numArr[k])) {
                    convertRoman.push(romanArr[k] + romanArr[k] + romanArr[k]);
                }
                else if (element == (numArr[k + 1] - numArr[k])) {
                    convertRoman.push((romanArr[k] + romanArr[k + 1]));
                }
                else if (element == (numArr[k + 1] - numArr[k - 1])) {
                    convertRoman.push((romanArr[k - 1] + romanArr[k + 1]));
                }
                else if (element == (numArr[k - 1] + numArr[k])) {
                    convertRoman.push(romanArr[k] + romanArr[k - 1]);
                }
                else if (element == (numArr[k - 1] + numArr[k - 1] + numArr[k])) {
                    convertRoman.push(romanArr[k] + romanArr[k - 1] + romanArr[k - 1]);
                }
                else if (element == (numArr[k - 1] + numArr[k - 1] + numArr[k - 1] + numArr[k])) {
                    convertRoman.push(romanArr[k] + romanArr[k - 1] + romanArr[k - 1] + romanArr[k - 1]);
                }
                else if (element == (numArr[k + 1] - numArr[k - 2])) {
                    convertRoman.push((romanArr[k - 2] + romanArr[k + 1]));
                }
            }
            else if (element > 1999) {
                if (element == (numArr[k] + numArr[k])) {
                    convertRoman.push(romanArr[k] + romanArr[k]);
                }
                else if (element == (numArr[k] + numArr[k] + numArr[k])) {
                    convertRoman.push(romanArr[k] + romanArr[k] + romanArr[k]);
                }
            }
        }
    })
    return convertRoman.join('');
};