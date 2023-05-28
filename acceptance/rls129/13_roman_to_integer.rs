use std::collections::HashMap;

impl Solution {
    pub fn roman_to_int(num: String) -> i32 {
        let mut max = 0;

        // TODO:
        // this can be made much much faster by using a lookup table
        let mut map = HashMap::new();
        map.insert('I', 1);
        map.insert('V', 5);
        map.insert('X', 10);
        map.insert('L', 50);
        map.insert('C', 100);
        map.insert('D', 500);
        map.insert('M', 1000);

        num.chars().rev().map(|xx| {
            let x = map.get(&xx).unwrap().clone();
            if x >= max {
                max = x;
                x
            } else {
                x*-1
            }
        }).sum()
    }
}
