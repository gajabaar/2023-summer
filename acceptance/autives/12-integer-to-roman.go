package main

import (
	"strings"
)

var placeValues [][]byte = [][]byte{{'I', 'V', 'X'},
	{'X', 'L', 'C'},
	{'C', 'D', 'M'},
	{'M'}}

func reverse(str string) (result string) {
	for _, v := range str {
		result = string(v) + result
	}
	return
}

func intToRoman(num int) string {
	if num >= 4000 || num <= 0 {
		return ""
	}

	var roman strings.Builder

	for i := 0; num > 0; i++ {
		rem := num % 10

		if rem == 0 {
			num = num / 10
			continue
		} else if rem <= 3 {
			for j := 0; j < rem; j++ {
				roman.WriteByte(placeValues[i][0])
			}
		} else if rem == 4 {
			roman.WriteByte(placeValues[i][1])
			roman.WriteByte(placeValues[i][0])
		} else {
			rem -= 5
			if rem == 0 {
				roman.WriteByte(placeValues[i][1])
				num = num / 10
				continue
			} else if rem <= 3 {
				for j := 0; j < rem; j++ {
					roman.WriteByte(placeValues[i][0])
				}
				roman.WriteByte(placeValues[i][1])
			} else if rem == 4 {
				roman.WriteByte(placeValues[i][2])
				roman.WriteByte(placeValues[i][0])
			}

		}

		num = num / 10
	}

	return reverse(roman.String())
}
