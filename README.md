# SyDb
Syrian DataBase
It is a simple library that depends on connecting to databases via mysql that performs data processing, as it converts ordinary data into `sql` code.
The library is safe and does not contain `sql injection` vulnerabilities. It is intended to avoid these problems, which may be somewhat difficult for beginners to avoid, and it is easy and flexible to learn.


Index A sequential list of methods:
[Install Library](#install-library) How to install library SyDb
[Select Data](#select) Get data from the database
[Insert Data](#insert) Set data from the database
[Update Data](#update) Update data from the database
[Delete Data](#delete) Delete data from the database
[Query SQL](#query) Run SQL code
[Connect DataBase](#connect) New connect database
[Close Connect DataBase](#close) Close the connect present
[Table](#table) Table properties
[Error](#error) Error Exception
Some future:
* [Add data where](#addwhere)
* [Starting column](#startcolumn)
* [Ending column](#endcolumn)
* [Allocate contact time](#settimeconnect)
# install-Library
You can install library with `composer` You can install a library using Composer which is the best way to download SyDb by adding the following line to `composer.json` file:
```json
{
    "require": {
        "yhyasyrian/sydb": "^1.4"
    }
}
```
Or run:
```bash 
composer require yhyasyrian/sydb
```

# Select
In the "Select" class, there are several methods of use, namely:
`select_sql`, `select`, `fetch_all`, `fetch`

    Used to fetch data
## select_sql
Use `select_sql` to display an integrated sql code that accepts three parameters:
\$table means the table, type `String`
\$where means where to search, type `Array` value defult="[]", Syntax:
Column name => the value in it
\$etcWhere It is intended to add properties to the search, Methods will be developed for it in future updates, type `String` value defult="".
Return Code Sql, `String` type.

Example:
```php
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
$sql = $SyDb->select_sql('message',['message'=>"Heelo ' Yhya\" I am Hak"]);
echo $sql; // SELECT * FROM `message` WHERE `message`='Heelo &#39; Yhya&#34; I am Hak';
?>
```
## select
Use `select` to run sql code that accepts three parameters:
\$table means the table, type `String`
\$where means where to search, type `Array` value defult="[]", Syntax:
Column name => the value in it
\$etcWhere It is intended to add properties to the search, Methods will be developed for it in future updates, type `String` value defult="".
Return \mysqli_result, `Object` type.

Example:
```php
<?php
require 'vendor/autoload.php';
use \YhyaSyrian\Sql\SyDb;
$SyDb = new SyDb('localhost','root','pass','database');
$select = $SyDb->select('memers',['type'=>'band']);
$select->num_rows; // Count rows ; int|string @link https://www.php.net/manual/en/mysqli-result.num-rows.php
// And You Can View All Data
while ($row = $SyDb->fetch($select) /*
    * It is shortcut for function mysqli_fetch_assoc
*/) {
    print_r($row); // For print this data
}
?>
```
## fetch_all
Use `fetch_all` to select all data that accepts three parameters:
\$table means the table, type `String`
\$where means where to search, type `Array` value defult="[]", Syntax:
Column name => the value in it
\$etcWhere It is intended to add properties to the search, Methods will be developed for it in future updates, type `String` value defult="".
Return Data rows, `Array` type.

Example:
```php
<?php
require 'vendor/autoload.php';
use \YhyaSyrian\Sql\SyDb;
$SyDb = new SyDb('localhost','root','pass','database');
$fetch_all = $SyDb->fetch_all('memers',['type'=>'active']);
print_r($fetch_all); /* * Output is :
    Array(
         Array(
            [id] => 1,
            [type] => "active",
            [name] => "Yhya"
        ),
        Array(
            [id] => 2,
            [type] => "active",
            [name] => "Saied"
        ),
    )
*/
?>
```
## fetch
Use `fetch` to select first data that accepts three parameters:
\$table means the table, type `String`
\$where means where to search, type `Array` value defult="[]", Syntax:
Column name => the value in it
\$etcWhere It is intended to add properties to the search, Methods will be developed for it in future updates, type `String` value defult="".
Return Data row, `Array` type.

Example:
```php
<?php
require 'vendor/autoload.php';
use \YhyaSyrian\Sql\SyDb;
$SyDb = new SyDb('localhost','root','pass','database');
$fetch = $SyDb->fetch('memers',['type'=>'active']);
print_r($fetch); /* * Output is :
        Array(
        [id] => 1,
        [type] => "active",
        [name] => "Yhya"
    )
*/
?>
```
# Insert
In the "Insert" class, there are several methods of use, namely:
`insert_sql`, `insert`

    Used to insert data
## insert_sql
Use `insert_sql` to display an integrated sql code for add data to database that accepts two parameters:
\$table means the table, type `String`
\$data means data that you want to add into database, type `Array` Syntax:
Column name => the value in it
Return Code Sql, `String` type.

Example:
```php
<?php
require 'vendor/autoload.php';
use \YhyaSyrian\Sql\SyDb;
$SyDb = new SyDb('localhost','root','pass','database');
$sql = $SyDb->insert_sql('memers',['type'=>'admin','name'=>'Yhya']);
echo $sql; // INSERT INTO `memers` (`type`,`name`) VALUES ('admin','Yhya');
$sql = $SyDb->insert_sql('memers',['type'=>'active','name'=>'Hello I am\' Hack']);
echo $sql; // INSERT INTO `memers` (`type`,`name`) VALUES ('active','Hello I am&#39; Hack');
?>
```
## insert
Use `insert` to run an integrated sql code for add data to database that accepts two parameters:
\$table means the table, type `String`
\$data means data that you want to add into database, type `Array` Syntax:
Column name => the value in it
Return true, `Bool` type.

Example:
```php
<?php
require 'vendor/autoload.php';
use \YhyaSyrian\Sql\SyDb;
$SyDb = new SyDb('localhost','root','pass','database');
$sql = $SyDb->insert('memers',['type'=>'admin','name'=>'Yhya']); // Adding to the database is done
?>
```
# Update
In the "Update" class, there are several methods of use, namely:
`update_sql`, `update`

    Used to update data
## update_sql
Use `update_sql` to display an integrated sql code for update data to database that accepts three parameters:
\$table means the table, type `String`
\$where means where data that you want to update into database, type `Array` Syntax:
Column name => the value in it
\$new means data that you want to update into database, type `Array` Syntax:
Column name => the value in it
Return Code Sql, `String` type.

Example:
```php
<?php
require 'vendor/autoload.php';
use \YhyaSyrian\Sql\SyDb;
$SyDb = new SyDb('localhost','root','pass','database');
$sql = $SyDb->update_sql('memers',['type'=>'admin','name'=>'Yhya'],['status'=>"online"]);
echo $sql; // UPDATE `memers` SET `status`='online' WHERE `type`='admin' AND `name`='Yhya';
$sql = $SyDb->update_sql('memers',['type'=>'active','name'=>'Hello I am\' Hack'],['status'=>"ofline"]);
echo $sql; // UPDATE `memers` SET `status`='ofline' WHERE `type`='active' AND `name`='Hello I am&#39; Hack';
?>
```
## update
Use `update` to run an integrated sql code for update data to database that accepts three parameters:
\$table means the table, type `String`
\$where means where data that you want to update into database, type `Array` Syntax:
Column name => the value in it
\$new means data that you want to update into database, type `Array` Syntax:
Column name => the value in it
Return `Void` type.

Example:
```php
<?php
require 'vendor/autoload.php';
use \YhyaSyrian\Sql\SyDb;
$SyDb = new SyDb('localhost','root','pass','database');
$SyDb->update('memers',['type'=>'admin','name'=>'Yhya'],['status'=>"online"]);
$SyDb->update('memers',['type'=>'active','name'=>'Hello I am\' Hack'],['status'=>"ofline"]);
?>
```
# Delete
In the "Delete" class, there are several methods of use, namely:
`delete_sql`, `delete`

    Used to delte data
## delete_sql
Use `delete_sql` to display sql code that accepts three parameters:
\$table means the table, type `String`
\$where means where to delete from Database, type `Array` Syntax:
Column name => the value in it
Return Code Sql, `String` type.

Example:
```php
<?php
require 'vendor/autoload.php';
use \YhyaSyrian\Sql\SyDb;
$SyDb = new SyDb('localhost','root','pass','database');
$sql = $SyDb->delete_sql('memers',['type'=>'admin']);
echo $sql; // SELECT * FROM `memers` WHERE `type`='admin';
$sql = $SyDb->delete_sql('message',['message'=>"Heelo ' Yhya\" I am Hak"]);
echo $sql; // DELETE FROM `message` WHERE `message`='Heelo &#39; Yhya&#34; I am Hak';
?>
```
## delete
Use `delete` to run sql code that accepts three parameters:
\$table means the table, type `String`
\$where means where to delete from Database, type `Array` Syntax:
Column name => the value in it
Return `Void` type.

Example:
```php
<?php
require 'vendor/autoload.php';
use \YhyaSyrian\Sql\SyDb;
$SyDb = new SyDb('localhost','root','pass','database');
$SyDb->delete('memers',['type'=>'admin']);
$SyDb->delete('message',['message'=>"Heelo ' Yhya\" I am Hak"]);
?>
```
# Query
In the "Query" class, there are several methods of use, namely:
`query`

    Used to run sql code
## query
Use `query` to run sql code that accepts one parameters:
\$query means sql code a type mixed
Return `Mixed` type

Example:
```php
<?php
require 'vendor/autoload.php';
use \YhyaSyrian\Sql\SyDb;
$SyDb = new SyDb('localhost','root','pass','database');
$SyDb->query("INSERT INTO `memers` (`type`,`name`) VALUES ('active','Hello I am&#39; Hack');");
// Or
$SyDb->query(
    $SyDb->insert_sql('memers',['type'=>'active','name'=>'Hello I am\' Hack'])
);
// Or 
$SyDb->insert('memers',['type'=>'active','name'=>'Hello I am\' Hack'])
```

    {Note}: Using the method can directly cause a sql injection-type hack.
    To avoid the problem use the available methods, Example: select, update, etc ...    
# Connect
In the "Connect" class, there are several methods of use, namely:
`connect`

    Used to connect database
## connect
Use connect a database and don't need parameters
Return true, `Bool` type

Example:
```php
<?php
require 'vendor/autoload.php';
use \YhyaSyrian\Sql\SyDb;
$SyDb = new SyDb('localhost','root','pass','database'); // Coonect DataBase simple
//  Or
$SyDb->connect();
```
    {Note}: In PHP CLI between each connection there is an interval (Defult 15s)
# Close
In the "Close" class, there are several methods of use, namely:
`close`

    Used to end connect database
## close
Use end connect a database and don't need parameters
Return true, `Bool` type

Example:
```php
<?php
require 'vendor/autoload.php';
use \YhyaSyrian\Sql\SyDb;
$SyDb = new SyDb('localhost','root','pass','database'); 
$SyDb->close();
$Sydb->query('SELECT * FROM `table`'); // Error beacuse not found connect, you can connect with function connect()
```
# Table
In the "Table" class, there are several methods of use, namely:
`viewTable`, `exportTable`, `exportTables`

    Used to tables  a database
## viewTable
Use view a tables in database and don't need parameters
Return all tables, `Array` type

Example:
```php
<?php
require 'vendor/autoload.php';
use \YhyaSyrian\Sql\SyDb;
$SyDb = new SyDb('localhost','root','pass','database');
$tables = $SyDb->viewTable();
print_r($tables); /* * Output is:
    Array(
        [0] => Members,
        [1] => Tokens,
        [2] => Logs,
        [3] => Sitting,
        [4] => CronsJob
    )
*/
?>
```
## exportTable
Use export a table in database and three parameters:
\$table means the table, type `String`
\$dir means the path for save files in it, type `String`
\$bool for add number time UNIX for name file export, type `Bool`
Return true, `bool` type
```php
<?php
require 'vendor/autoload.php';
use \YhyaSyrian\Sql\SyDb;
$SyDb = new SyDb('localhost','root','pass','database');
$SyDb->exportTable('Members','.'); // you can show file Members.sql
```
## exportTables
Use export a tables in database and tow parameters:
\$dir means the path for save files in it, type `String`
\$bool for add number time UNIX for name file export, type `Bool`
Return true, `bool` type
```php
<?php
require 'vendor/autoload.php';
use \YhyaSyrian\Sql\SyDb;
$SyDb = new SyDb('localhost','root','pass','database');
$SyDb->exportTables('.'); // you can show file Members.sql
```
# Error
In the "Error" class, In order to classify errors

    Used to show errors
## Exception
Example:
```php
<?php
require 'vendor/autoload.php';
use \YhyaSyrian\Sql\SyDb;
try{
    $SyDb = new SyDb('localhost','root','passNoTrue','database');
} catch (\YhyaSyrian\Sql\Exception $error) {
    // The error from database
    echo $error->getMessage();
} catch (\Throwable $error) {
    // The error from your file
    echo $error->getMessage();
}
```
# Function Helps
Some functions help this library Example:
* [Add data where](#addwhere)
* [Starting column](#startcolumn)
* [Ending column](#endcolumn)
* [Allocate contact time](#settimeconnect)
## AddWhere
The function renders an array as a generic factor of all connections

Example:
```php
<?php
require 'vendor/autoload.php';
use \YhyaSyrian\Sql\SyDb;
$SyDb = new SyDb('localhost','root','pass','database');
$SyDb->addWhere(['site'=>($_SERVER['SERVER_NAME'] ?? "CLI")]);
echo $SyDb->select_sql('member',['type'=>'admin']); // SELECT * FROM `member` WHERE `type`='admin' AND `site`='CLI';
echo $SyDb->insert_sql('member',['type'=>'admin','name'=>"Yhya"]); // INSERT INTO `member` (`type`,`name`,`site`) VALUES ('admin','Yhya','CLI');
echo $SyDb->delete_sql('member',['type'=>'banded']); // DELETE FROM `member` WHERE `type`='banded' AND `site`='CLI';
echo $SyDb->update_sql('member',['status'=>'ofline','name'=>"test"],['status'=>"online"]); // UPDATE `member` SET `status`='online' WHERE `status`='ofline' AND `name`='test' AND `site`='CLI';
```
    {Advice}: It may be difficult to add the array manually if you want to change your storage format
## StartColumn
## EtartColumn
## SetTimeConnect
