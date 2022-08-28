<?php
namespace YhyaSyrian\Sql;
class FunctionSql{
    /**
    * @var Chars For Remove In Filter
    */
    private $Char = [
        '"' => '&#34;',
        "'" => '&#39;',
        \PHP_EOL => '&#Line;',
        '\\' => '&#Slash;'
    ];
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
            if (empty($string)) {
                return '';
            }
            $string = str_replace(\array_keys($this->Char),\array_values($this->Char),$string); 
            return $string;
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
            if (empty($string)) {
                return '';
            }
            $string = str_replace(\array_values($this->Char),\array_keys($this->Char),$string); 
            return $string;
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
        foreach ($array as $key => $value) {
            if (empty($key) or empty($value)) {
                unset($array[$key]);
            }
        }
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
    public function endColumn(string $name = 'Id',int $number = 10,int $start = 0) :string 
    {  // Start Form 10 To 0
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
	public function startColumn(string $name = 'Id',int $number = 10,int $start = 0) :string
    { // Start Form 0 To 10
		$start *= $number;
		return 'ORDER BY '.$name.' LIMIT '.$start.','.$number;
    }
    /**
    * @param array $array
    * Array Datas
    * @return array
    * result array all values isn't empey
    */
    public function filterArrayMap(array $array) :array
    {
        foreach ($array as $key => $value) {
            if ($key == 0) {
                continue;
            }
            if (empty($key)) {
                unset($array[$key]);
            }
        }
        return $array;
    }
    /**
    * @param int $time
    * Set Time Such As Second
    * @return void
    */
    public function setTimeConnect(int $time) :void
    {
        $this->timeConnect = $time;
    }
}