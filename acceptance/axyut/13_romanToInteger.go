package main

import "fmt"

func romanToInt(roman string) int {
	// mapping roman unicode to int values
	values := map[rune]int{
		'I': 1,
		'V': 5,
		'X': 10,
		'L': 50,
		'C': 100,
		'D': 500,
		'M': 1000,
	}

	result := 0
	length := len(roman)

	for i := 0; i < length; i++ {
		value := values[rune(roman[i])]

		// if next roman value is greater then subtract else add
		if i < length-1 && values[rune(roman[i+1])] > value {
			result -= value
		} else {
			result += value
		}
	}

	return result
}

func main() {
	// output
	fmt.Println(romanToInt("CDXCI"))

}
