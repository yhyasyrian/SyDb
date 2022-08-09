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
        try {
            return str_replace(['"',"'"],['&#34;','&#39;'],$string); 
        } catch (\Throwable $e) {
            return $string;
        }
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
        try {
            return str_replace(['&#34;','&#39;'],['"',"'"],$string); 
        } catch (\Throwable $e) {
            return $string;
        }
    }
    /**
    * @param array $array
    * For Add Key And Value In Table
    *
    * @return bool
    */
    public function addWhere(array $array) :bool
    {
        $this->whereGlobal = $array;
        return \true;
    }
    /**
    * @param string $name
    * Name Column
    * @param int $number
    * Number Get Value
    * @param int $start
    * Start After $number * $start
    *
    * @return string
    * Can You Use The String In Function select In Third Param For Get Rows Last
    */
    public function endColumn(string $name = 'Id',int $number = 10,int $start = 0){ // Start Form 10 To 0
		$start *= $number;
		return 'ORDER BY '.$name.' DESC LIMIT '.$start.','.$number;
	}
        /**
    * @param string $name
    * Name Column
    * @param int $number
    * Number Get Value
    * @param int $start
    * Start After $number * $start
    *
    * @return string
    * Can You Use The String In Function select In Third Param For Get Rows Start
    */
	public function startColumn(string $name = 'Id',int $number = 10,int $start = 0){ // Start Form 0 To 10
		$start *= $number;
		return 'ORDER BY '.$name.' LIMIT '.$start.','.$number;
	}
}