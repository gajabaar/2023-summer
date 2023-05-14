var simplifyPath = function (path) {
    let finalPath = [];
    let Spath = path.split('/');
    Spath.forEach((element) => {
        if (element != '' && element != '.' && element != '..') {
            finalPath.push(element);
        }
        else if (element == '..') {
            if (finalPath.length > 0)
                finalPath.pop();
        }
    })
    return '/' + finalPath.join('');
}