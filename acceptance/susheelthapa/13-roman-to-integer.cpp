#include <iostream>

int equivalentInteger(char r)
{
    switch (r)
    {
    case 'I':
        return 1;
    case 'V':
        return 5;
    case 'X':
        return 10;
    case 'L':
        return 50;
    case 'C':
        return 100;
    case 'D':
        return 500;
    case 'M':
        return 1000;
    }
}

int romanToInteger(std::string roman)
{
    int integer = 0;
    int current_value = 0;
    int previous_value = 0;
    
    for (int i = 0; i < roman.length(); i++)
    {
        previous_value = current_value;
        current_value = equivalentInteger(roman[i]);

        if (previous_value < current_value)
        {
            integer -= previous_value * 2;
        }
        integer += current_value;
    }

    return integer;
}

int main()
{
    std::string roman;
    std::cin >> roman;
    std::cout << romanToInteger(roman) << std::endl;
    return 0;
}