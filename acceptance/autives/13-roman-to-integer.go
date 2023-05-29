package main

import (
	"math"
	"strings"
)

var base string = "IXCM"
var mids string = "VLD"

func romanToInt(s string) int {
	res := 0

	for i, char := range s {
		if index := strings.IndexRune(base, char); index >= 0 {
			res += int(math.Pow10(index))

			if i == 0 {
				continue
			}

			if prevIndex := strings.IndexRune(base, rune(s[i-1])); prevIndex >= 0 && prevIndex == index-1 {
				res -= 2 * int(math.Pow10(prevIndex))
			}
		} else if index := strings.IndexRune(mids, char); index >= 0 {
			res += int((math.Pow10(index + 1)) / 2)

			if i == 0 {
				continue
			}

			if prevIndex := strings.IndexRune(base, rune(s[i-1])); prevIndex >= 0 && prevIndex == index {
				res -= int(2 * math.Pow10(prevIndex))
			}
		}

	}

	return res
}
