var romanToInt = function (s) {
    let numArr = [1, 5, 10, 50, 100, 500, 1000];
    let romanArr = ['I', 'V', 'X', 'L', 'C', 'D', 'M'];
    let givenArr = [];
    let givenNumArr = [];
    let totalValue = 0;
    let upperS = s.toUpperCase();
    givenArr = upperS.split("");
    let givenArrLen = givenArr.length;
    for (i = 0; i < givenArrLen; i++) {
        if (givenArr[i] == 'I') {
            givenNumArr.push(1);
        }
        else if (givenArr[i] == 'V') {
            givenNumArr.push(5);
        }
        else if (givenArr[i] == 'X') {
            givenNumArr.push(10);
        }
        else if (givenArr[i] == 'L') {
            givenNumArr.push(50);
        }
        else if (givenArr[i] == 'C') {
            givenNumArr.push(100);
        }
        else if (givenArr[i] == 'D') {
            givenNumArr.push(500);
        }
        else if (givenArr[i] == 'M') {
            givenNumArr.push(1000);
        }
    }
    for (i = 0; i < givenArrLen; i++) {
        if (givenNumArr[i] < givenNumArr[i + 1]) {
            totalValue -= givenNumArr[i];
        } else {
            totalValue += givenNumArr[i];
        }
    }
    return totalValue;
};
