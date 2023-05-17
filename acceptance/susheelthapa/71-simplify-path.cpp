#include <iostream>
#include <string>
#include <stack>
#include <sstream>

std::string simpliyPath(std::string path)
{
    if (0 == path.length())
        return "/";

    std::stack<std::string> paths;

    std::stringstream ss(path);

    std::string token;
    while (std::getline(ss, token, '/'))
    {
        if (".." == token)
        {
            if (!paths.empty())
            {
                paths.pop();
            }
        }
        else if (("." != token) && ("" != token))
        {
            paths.push(token);
        }
    }

    if (paths.empty())
        return "/";

    std::string result(paths.top());
    result.reserve(path.length());

    paths.pop();

    while (!paths.empty())
    {

        result.insert(0, paths.top() + "/");
        paths.pop();
    }

    return "/" + result;
}

int main()
{
    std::string path;
    std::cin >> path;
    std::cout << simpliyPath(path) << std ::endl;
    return 0;
}