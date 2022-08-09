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
        $data = array_merge($data,$this->whereGlobal);
        $datas = null;
        if (isset($data[0]) and is_array($data[0])) {
            $key = array_keys($data[0]);
            $count = count($data);
            $i = 0;
            foreach ($data as $value) {
                $datas .= $this->forEach($value);
                $i++;
                if ($count != $i) {
                    $datas .= ',';
                }
            }
        } else {
            $key = array_keys($data);
            $datas = $this->forEach($data);
        }
        $sql .= ' (`'.implode('`,`',$key).'`) VALUES '.$datas;
        return $sql.';';
    }
    /**
    * @param array $array
    * column => row
    *
    * @return string
    * For initialization Data To Insert DataBase
    */
    private function forEach(array $array) {
        $count = count($array);
        $i = 0;
        $result = null;
        foreach ($array as $key => $value) {
            $value = $this->Filter($value);
            $result .= "'{$value}'";
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
}