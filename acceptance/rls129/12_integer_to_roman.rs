impl Solution {
    pub fn int_to_roman(num: i32) -> String {
        let lookup_ones = [ "", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX"];
        let lookup_tens = [ "", "X", "XX", "XXX", "XL", "L", "LX", "LXX", "LXXX", "XC"];
        let lookup_hundreds = [ "", "C", "CC", "CCC", "CD", "D", "DC", "DCC", "DCCC", "CM"];
        let lookup_thousands = [ "", "M", "MM", "MMM"];

        let num = num as usize;
        let ones = lookup_ones[num % 10];
        let tens = lookup_tens[num / 10 % 10];
        let hundreds = lookup_hundreds[num / 100 % 10];
        let thousands = lookup_thousands[num / 1000 % 10];
        [thousands, hundreds, tens, ones].concat()
    }
}
