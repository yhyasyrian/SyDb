<?php
namespace YhyaSyrian\Sql;
class FunctionSql{
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
    public function addWhere(array $array) :bool
    {
        $this->whereGlobal = $array;
        return \true;
    }
}