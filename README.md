# Elmer's Manufacturing Coding Test

Elmer's Manufacturing coding test project.

I want to be the Elmer's Manufacturing development team member!!^^

<br>

## Environment
| Environment | Supported versions |
|-------------|--------------------|
| PHP         | >= 8.0             |
| Laravel     | >= 10              |

<br>

## Installation

I apologize for the inconvenience, but I don't have experience with Docker containers yet(I am currently studying it by myself). 

So I was unable to set up a Docker container environment. 

However, I will provide you with a detailed installation guide.

In order to start installation, your computer installed the PHP >= 8.0 version. 

<br>

**0.Composer Install to your Mac**

In order to manage the dependency for the Laravel development environment, you have to install the Composer to your Mac.
Please install the composer using [this link](https://getcomposer.org/download/).

```bash
$ php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
$ php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
$ php composer-setup.php
$ php -r "unlink('composer-setup.php');"

$ sudo mv composer.phar /usr/local/bin/composer
```

<br>

**1.Clone project**

Clone my project to your local

```bash
$ git clone git@github.com:PositiveInsu/elmers-manufacturing.git elmer
$ cd elmer
```

<br>

**2.Initialization project env file**

Copy the .env.example file to .env

```bash
elmer$ cp .env.example .env 
```

<br>

**3.Download related modules**

Download the project related modules using the Composer

```bash
elmer$ composer install 
```
<br>

**4.Run the test**

```bash
elmer$ php artisan test 
```

<br>

## Code location

Test code location.
> '/tests/Feature' folder.

Routing code location.
> '/routes/api.php'

Controller code location.
> '/app/Http/Controllers/Api/PublicFunctionController.php'

Convert class location.
> '/app/Http/Common/Converter/DigitToWord/'
 
> '/app/Http/Common/Converter/HexadecimalToProperty/'

Localization file location.
> '/lang/en/digitword.php'

> '/lang/kor/digitword.php'
 
<br>

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

Each language have own number word strategy. 
So, you have to implement your own language strategy for changing the number.

<br>

**1. Adding the language file in the '/lang/' folder. Please see the '/lang/en/digitword.php'** 

For example, if you want to add France language then create the folder and file like

> /lang/fr/digitword.php

<br>

**2. Creating the new word convert strategy class with 'extends AbstractDigitToWordConvertStrategy'.**

For example, if you want to add France convert strategy. Add below class in the *'/app/Http/Common/Converter/DigitToWord'* folder.
```php
class DigitToWordFrenchConvertStrategy extends AbstractDigitToWordConvertStrategy
{
   //...
}
```

<br>

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

<br>

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

<br>

## Part 2 

Creating the RESTful API when the consumer give the Hexadecimal string, it returns Property Object Json.

### - API Url Format

> /api/public-function/hexadecimal-to-property/{hexadecimal}

### - Hexadecimal String Difference between PHP and Java

In the Java development(not only Java, many languages also), it defined the hexadecimal string like '0xFFFF'.
But PHP handle the hexadecimal string like 'FFFF'.
So in this project, I developed api so that both '0xFFFF' and 'FFFFFF' can be used.

<br><br><br><br><br>

