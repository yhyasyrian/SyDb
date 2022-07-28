<?php

use YhyaSyrian\Sql\SyDb;

require_once __DIR__.'/../src/SyDb.php';
try {
    $SyDb = new \YhyaSyrian\Sql\SyDb('localhost','root','','test');
    print_r($SyDb->select_sql('message',['message'=>'Heelo \' Yhya" I am Hak']));
} catch (\Throwable $th) {
    print_r($th);
}