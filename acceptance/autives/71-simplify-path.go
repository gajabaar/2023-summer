package main

import "strings"

type node struct {
	dir        string
	next, prev *node
}

func simplifyPath(path string) string {
	root := new(node)
	curr := root
	*root = node{dir: "", next: nil, prev: nil}

	var pathSegments []string
	var builder strings.Builder
	for _, item := range path[1:] {
		if item == '/' {
			if builder.Len() > 0 {
				pathSegments = append(pathSegments, builder.String())
				builder.Reset()
			}
		} else {
			builder.WriteRune(item)
		}
	}
	if builder.Len() > 0 {
		pathSegments = append(pathSegments, builder.String())
	}

	for _, item := range pathSegments {
		if item == "." {
			continue
		} else if item == ".." {
			if curr.prev == nil {
				curr = root
			} else {
				curr = curr.prev
				curr.next = nil
			}
		} else {
			newNode := new(node)
			newNode.dir = item
			newNode.prev = curr
			newNode.next = nil
			curr.next = newNode
			curr = newNode
		}
	}

	if root.next == nil {
		return "/"
	}

	var canonPath strings.Builder

	for trav := root; trav != nil; trav = trav.next {
		canonPath.WriteString(trav.dir)
		canonPath.WriteRune('/')
	}

	return canonPath.String()[:canonPath.Len()-1]
}
