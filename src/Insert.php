<?php
namespace YhyaSyrian\Sql;
require_once __DIR__.'/Delete.php';
class Insert extends Delete{
    /**
    * @param string $table
    * Name Table
    * @param array $data
    * column => row
    *
    * @return string
    * For initialization Sql Code (INSERT)
    */
    public function insert_sql(string $table,array $data) :string
    {
        $sql = "INSERT INTO `{$table}`";
        $datas = null;
        if (isset($data[0]) and is_array($data[0])) {
            $key = array_keys($data[0]);
            $key = array_merge($key,\array_keys($this->whereGlobal));
            $count = count($data);
            $i = 0;
            foreach ($data as $value) {
                $value = array_merge($value,$this->whereGlobal);
                $datas .= $this->forEach($value);
                $i++;
                if ($count != $i) {
                    $datas .= ',';
                }
            }
        } else {
            $data = array_merge($data,$this->whereGlobal);
            $key = array_keys($data);
            $datas = $this->forEach($data);
        }
        $sql .= ' (`'.$this->implode('`,`',$key).'`) VALUES '.$datas;
        return $sql.';';
    }
    /**
    * @param array $array
    * column => row
    *
    * @return string
    * For initialization Data To Insert DataBase
    */
    private function forEach(array $array) :string {
        $array = $this->filterArrayMap($array);
        $count = count($array);
        $i = 0;
        $result = null;
        foreach ($array as $key => $value) {
            if (\is_string($value) and !\preg_match('/^-[0-9]+$/',$value)) {
                $value = $this->Filter($value);
                $result .= "'{$value}'";
            } else {
                $result .= $value;
            }
            $i++;
            if ($count != $i) {
                $result .= ',';
            }
        }
        return "({$result})";
    }
    /**
    * @param string $table
    * Name Table
    * @param array $data
    * column => row
    *
    * @return string
    * For initialization And Run SQL Code -Insert Data- (INSERT)
    */
    public function insert(string $table,array $data) : bool
    {
        return $this->query($this->insert_sql($table,$data));
    }
    /**
    * @param string $string
    * Defaults to an empty string. This is not the preferred usage of implode as glue would be the second parameter and thus, the bad prototype would be used.
    * @param array $array
    * Array Implode To String
    *
    * @return string
    * Convert Array To String
    */
    private function implode(string $string,array $array) :string {
        $array = $this->filterArrayMap($array);
        $count = \count($array) - 1;
        $result = '';
        foreach ($array as $key => $value) {
            if ($count == $key) {
                $result .= $value;
                continue;
            }
            $result .= $value.$string;
        }
        return $result;
    }
}