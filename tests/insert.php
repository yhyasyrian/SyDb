<?php

use YhyaSyrian\Sql\SyDb;

require_once __DIR__.'/../src/SyDb.php';
try {
    $SyDb = new \YhyaSyrian\Sql\SyDb('localhost','root','','test');
    print_r($SyDb->query($SyDb->insert_sql('member',['Email'=>'Hak','UserName'=>'YhyaSyrian"'])));
} catch (\Throwable $th) {
    print_r($th);
}