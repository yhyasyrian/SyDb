<?php
namespace YhyaSyrian\Sql;
class Funcation{
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
        /**
    * @param mixed $string
    * Any String
    *
    * @return mixed
    * For Add CHAR ('|")
    */
    public function noFilter(mixed $string) :mixed
    {
        return str_replace(['&#34;','&#39;'],['"',"'"],$string); 
    }
}