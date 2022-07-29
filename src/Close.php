<?php
namespace YhyaSyrian\Sql;
require_once __DIR__.'/Table.php';
class Close extends Table{
    /**
    * @return string
    * For Close Connect DataBase
    */
    public function close() :bool
    {
        return mysqli_close($this->connect);
    }
}