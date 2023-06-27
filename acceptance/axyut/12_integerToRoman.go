package main

import (
	"fmt"
	"sort"
)

func intToRoman(num int) string {
	// mapping interger to equivalent number
	values := map[int]string{
		1:    "I",
		4:    "IV",
		5:    "V",
		9:    "IX",
		10:   "X",
		40:   "XL",
		50:   "L",
		90:   "XC",
		100:  "C",
		400:  "CD",
		500:  "D",
		900:  "CM",
		1000: "M",
	}

	nums := make([]int, 0)
	for key := range values {
		nums = append(nums, key)
	}
	
	// sorting in descending order
	// for i := 0; i < len(nums)-1; i++ {
	// 	for j := i + 1; j < len(nums); j++ {
	// 		if nums[i] < nums[j] {
	// 			nums[i], nums[j] = nums[j], nums[i]
	// 		}
	// 	}
	// }

	sort.Sort(sort.Reverse(sort.IntSlice(nums)))
	//fmt.Println(nums)
	
	output := ""
	for _, value := range nums {
		for num >= value {
			output += values[value]
			num -= value
		}
	}

	return output
}

func main() {
	
	// output
	fmt.Println(intToRoman(491))
}
