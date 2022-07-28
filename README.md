# SyDb
Syrian DataBase
It is a simple library that depends on connecting to databases via mysql that performs data processing, as it converts ordinary data into `sql` code.
The library is safe and does not contain `sql injection` vulnerabilities. It is intended to avoid these problems, which may be somewhat difficult for beginners to avoid, and it is easy and flexible to learn.


Index A sequential list of methods:
[Install Library](#install-library) How to install library SyDb
[Select Data](#Select) Get data from the database
[Insert Data](#Insert) Set data from the database
[Update Data](#Update) Update data from the database
[Delete Data](#Delete) Delete data from the database
[Query SQL](#Query) Run SQL code
[Connect DataBase](#Connect) New connect database
[Close Connect DataBase](#Close-Connect) Close the connect present
[Table](#Table) Table properties

# install-library
You can install library with `composer` You can install a library using Composer which is the best way to download SyDb by adding the following line to `composer.json` file:
```
{
    "require": {
        "yhyasyrian/sydb": "^1.3"
    }
}
```
Or run:
```
composer require yhyasyrian/sydb
```

# Select
In the "Select" class, there are several methods of use, namely:
`select_sql`, `select`, `fetch_all`, `fetch`

Use `select_sql` to display an integrated sql code that accepts three parameters:
$table means the table from which to fetch data of type string
$where means where to search from an array type and depends on the following form:
Column name => the value in it
$etcWhere It is intended to add properties to the search. Methods will be developed for it in future updates.
Example:
```
<?php
require 'vendor/autoload.php';
use \YhyaSyrian\Sql\SyDb;
$SyDb = new SyDb('localhost','root','pass','database');
$sql = $SyDb->select_sql('memers',['type'=>'admin']);
echo $sql; // SELECT * FROM `memers` WHERE `type`='admin';
// Example $_SESSION['user'] = 'Yhya'
$sql = $SyDb->select_sql('memers',['type'=>'admin','user'=>$_SESSION['user']]);
echo $sql; // SELECT * FROM `memers` WHERE `type`='admin' AND `user`='Yhya';
// Exaple $message = 'Heelo \' Yhya" I am Hak';
$sql = $SyDb->select_sql('message',['message'=>$message]);
echo $sql; // SELECT * FROM `message` WHERE `message`='Heelo &#39; Yhya&#34; I am Hak';
?>
```