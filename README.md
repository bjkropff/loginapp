# A Login Module for my Player tracker app
## Desription

This is a basic login app written in PHP and MySQL with Silex and Twig. Locally, I used MAMP for MySQL and ran a PHP/Apache server .

It is an MVP and should be considered a work-in-progress. For information on how it was created checkout:

https://www.learnhowtoprogram.com/php/object-oriented-php/web-apps-with-silex

## Instructions

From the `web/` folder, start a PHP server: `php -S localhost:8000` and navigate to http://localhost:8000 on your browser.

If you are using on this project on a different setup than described above, you may see an error when testing that looks like this:


`PHP Fatal error:  Uncaught exception 'PDOException'...`

This is a sign that the PDO object you've instantiated does not match the location or credentials of your test database. Most likely the localhost port number in your app.php, TestTest.php, and CategoryTest.php file doesn't match the MySQL port number in your MAMP/LAMP/WAMP preferences. To fix the error in MAMP, open MAMP, click Prefer

#### Create a database
##### Part 1
To create a database, open MySQL (I use DevDesktop and the terminal it uses) and enter the following:
$ mysql -u <username>
> CREATE DATABASE login;
> USE login;
>   CREATE TABLE gamemasters (id serial PRIMARY KEY, user VARCHAR(60), user VARCHAR(60));


(Note: I have taken my password out of here. As such you might need to use the -p flag followed by your password or root password)

##### Part 2
I have this database set up with the PDO information in a directory on the same level as the docroot like so:

```
/my_folder $ ls -lah
.
./docroot
./settings.php";
```

But, when you make it live, you might want to directory on the same level as the `public` directory for security.

That might look like so:

```
/home $ ls -lah
.
./public
./settings.php";
```

As such, the settings information will need to be directed from`docroot/app/app.php` to the right path.

In side the `settings.php` file, make the following (while not my really setup):

```
<?php
    //MySQL database info
    $settings = [
      'host' => '(ip address of MySQL or localhost)',
      'port' => '(port number)',
      'namedb' => '(db name)',
      'testdb' => '(name of test db)',
      'username' => '(username)',
      'password' => '(password)'
    ];
?>

```
##### Part 3

Setting up access to MySQL and creating a PDO object from with in the `app/app/php` file:

```
require_once __DIR__."/../../settings.php";

$server = 'mysql:host=' .
    $settings['host'] . ':' .
    $settings['port'] . ';dbname=' .
    $settings['testdb'];
$username = $settings['username'];
$password = $settings['password'];

$DB = new PDO($server, $username, $password);
```

#### Alternative MySQL

I was also able to get MySQL working as follows:

```
$server = 'mysql:host=(ip address of MySQL or localhost):(port);dbname=(db name)';
```

## Setting up a new app
1. Copy over the composer.json and run `composer install` at the docroot
1. Copy over the .gitignore
1. Make README.md
1. Duplicate setup
  * Make `tests`, `app`, `src`, `views`, `web` folders
  * Make `web/index.php`, `views/index.html.twig`, and `app/app.php` files and copy over the data
  * Test and debug the home page
  * Copy over setup info. for src, tests, and views files


##Copyright

Copyright (c) 2017 Brian Kropff

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
