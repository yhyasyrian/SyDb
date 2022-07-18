<?php
namespace YhyaSyrian\Sql;
require_once __DIR__.'/query.class.php';
abstract class Close extends Query{
    /**
    * @return string
    * For Close Connect DataBase
    */
    public function close() :bool
    {
        return mysqli_close($this->connect);
    }
    /**
    * @param string|int $string
    * Any String
    *
    * @return string
    * For Delete CHAR ('|")
    */
    public function Filter(string|int $string) :string
    {
        return (string) str_replace(['"',"'"],['&#34;','&#39;'],$string); 
    }
}