package main

import (
	"fmt"
	"strings"
)

func simplifyPath(path string) string {
    var stack []string
    dirs := strings.Split(path, "/")
    for _, dir := range dirs {
        if dir == "." || dir == "" {
            continue
        }
        if dir == ".." {
            if len(stack) > 0 {
                stack = stack[:len(stack)-1]
            }
        } else {
            stack = append(stack, dir)
        }
    }
    return "/" + strings.Join(stack, "/")
}
func main() {
	fmt.Println("Type 'exit' to exit.")
    for {
        fmt.Print("Enter a path: ")
        var path string
        fmt.Scanln(&path)
		if path == "exit" {
			break
		}
        simplified := simplifyPath(path)
        fmt.Printf("Simplified path: %s\n", simplified)
    }
}
