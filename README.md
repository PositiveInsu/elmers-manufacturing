# Elmer's Manufacturing Coding Test

Elmer's Manufacturing coding test project.
I really want to be the Elmer's development team member!!^^

## Environment
| Environment | Supported versions |
|-------------|--------------------|
| PHP         | >= 8.0             |
| Laravel     | >= 10              |

## Part 1

Creating the RESTful API when the consumer give the 32-bit integer number, it returns English word equivalents.
This API also should change the Word not only English but also the other languages later. 

### - API Url Format 

> /api/public-function/digit-to-word/{language}/{digit}

### - 32 bit Integer in PHP

In the PHP 32-bit system, Maximum value is **2147483647** and Minimum value is **-2147483648**

please look at [reference](https://www.php.net/manual/en/reserved.constants.php#:~:text=PHP_INT_MAX)


So in the question there is the **2147483648**, but I tested **2147483647** which is maximum value because of above reason.

If language is not yet implemented, the API will return English word as a default.

### - How to add the different Language word

Each languges has own number word strategy. 
So, you have to implement your own language strategy for changing the number.

**1. Adding the language file in the 'app/lang/' folder. Please see the 'app/lang/en/digitword.php'** 

For example, if you want to add France language then create the folder and file like

> app/lang/fr/digitword.php

**2. Creating the new word convert strategy class with 'extends AbstractDigitToWordConvertStrategy'.**

For example, if you want to add France convert strategy. Add below class in the *'/app/Http/Common/Converter/DigitToWord'* folder.
```php
class DigitToWordFrenchConvertStrategy extends AbstractDigitToWordConvertStrategy
{
   //...
}
```

**3. Implementing setLocale() method**

When you extend the AbstractDigitToWordConvertStrategy class, you have to implement setLocale() and convert() method.

In the setLocale method, you have to define the word set which use in your strategy class.

In the previous stage you already set the lang 'fr' folder, you define the locale with that folder name.


```php
protected function setLocale(): void
{
    App::setLocale('fr');
}
```

**4. Implementing convert() method**

Main business logic have to be placed in convert() method. 

The convert method will pass the $validateDigitString argument like '123', '-123', '0'.

The passed argument is validated in the previous logic, so **you don't need to concern about wrong argument.** 

You just implement the convert logic in the convert() method with that argument.


```php
public function convert(string $validatedDigitString): string
{
    // Convert business logic here!!
}
```

> You can see the DigitToWordEnglishConvertStrategy.php class for example.


## Part 2 
