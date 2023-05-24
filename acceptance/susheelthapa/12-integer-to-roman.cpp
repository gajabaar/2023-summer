#include <iostream>
#include <string>

std::string equivalentRoman(int number, int place_value)
{
    if (number == 0)
    {
        return "";
    }

    std::string value = "";

    switch (place_value)
    {
    case 0:
        if (number < 5)
        {

            if (number == 4)
            {
                return "IV";
            }
            else
            {

                while (number != 0)
                {
                    value.append("I");
                    number--;
                }
            }
        }
        else
        {
            if (number == 9)
            {
                return "IX";
            }
            else if (number == 5)
            {
                return "V";
            }
            else
            {
                value.append("V");
                while (number != 0)
                {
                    value.append("I");
                    number--;
                }
            }
        }
    case 1:
        if (number < 5)
        {

            if (number == 4)
            {
                return "XL";
            }
            else
            {

                while (number != 0)
                {
                    value.append("X");
                    number--;
                }
            }
        }
        else
        {
            if (number == 9)
            {
                return "XC";
            }
            else if (number == 5)
            {
                return "L";
            }
            else
            {
                value.append("L");
                while (number != 0)
                {
                    value.append("X");
                    number--;
                }
            }
        }
        break;
    case 2:
        if (number < 5)
        {

            if (number == 4)
            {
                return "CD";
            }
            else
            {
                while (number != 0)
                {
                    value.append("C");
                    number--;
                }
            }
        }
        else
        {
            if (number == 9)
            {
                return "CM";
            }
            else if (number == 5)
            {
                return "D";
            }
            else
            {
                value.append("D");
                while (number != 0)
                {
                    value.append("C");
                    number--;
                }
            }
        }
        break;

    case 3:
        if (number <= 3)
        {
            while (number != 0)
            {
                value.append("M");
                number--;
            }
        }
        break;
    }

    return value;
}

std::string integerToRoman(int number)
{
    std::string roman = "";
    int thousands = number / 1000;
    number = number % 1000;
    int hundred = number / 100;
    number = number % 100;
    int tens = number / 10;
    number = number % 10;
    int ones = number;

    return equivalentRoman(thousands, 3) + equivalentRoman(hundred, 2) + equivalentRoman(tens, 1) + equivalentRoman(ones, 0);
}

int main(int argc, char const *argv[])
{
    int number;
    std::cin >> number;
    std::cout << number << " = " << integerToRoman(number) << std::endl;
    return 0;
}
