impl Solution {
    pub fn simplify_path(path: String) -> String {
        let mut files = path.split('/');
        let mut filenames = Vec::new();
        while let Some(f) = files.next() {
            if f == "." {}
            else if f == ".." {
                filenames.pop();
            } else if f == "" {}
            else {
                filenames.push(f);
            }
        }
        "/".to_owned() + &filenames.join("/")
    }
}
