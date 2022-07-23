<?php
namespace YhyaSyrian\Sql;
class Close{
    /**
    * @return string
    * For Close Connect DataBase
    */
    public function close() :bool
    {
        return mysqli_close($this->connect);
    }
    /**
    * @param mixed $string
    * Any String
    *
    * @return mixed
    * For Delete CHAR ('|")
    */
    public function Filter(mixed $string) :mixed
    {
        return str_replace(['"',"'"],['&#34;','&#39;'],$string); 
    }
}