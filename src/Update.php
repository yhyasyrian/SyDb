<?php
namespace YhyaSyrian\Sql;
require_once __DIR__.'/Insert.php';
class Update extends Insert{
    /**
    * @param string $table
    * Name Table
    * @param array $where
    * column => row
    * @param array $new
    * column => row
    *
    * @return string
    * For initialization Sql Code (UPDATE)
    */
    public function update_sql(string $table,array $where,array $new) : string
    {
        $sql = "UPDATE `{$table}` SET";
        $sql .= $this->ArrayToString($new);
        $sql .= $this->ArrayToString($where,true);
        return $sql.';';

    }
    /**
    * @param array $array
    *
    * @param bool $where 
    * For Add WHERE In Sql Or None
    *
    * @return string
    * For Array Conversion To String Ready To Use
    */ 
    private function ArrayToString(array $array,bool $where = false) : string
    {
        $result = '';
        if ($where == true) {
            $array = array_merge($array,$this->whereGlobal);
        }
        $count = count($array);
        $i = 0;
        if ($count != 0) {
            if ($where == true) {
                $result = ' WHERE ';
            } else {
                $result = ' ';
            }
            foreach ($array as $key => $value) {
                $value = $this->Filter($value);
                $result .= "`{$key}`='{$value}'";
                $i++;
                if ($count != $i) {
                    if ($where == false) {
                        $result .= ', ';
                    } else {
                        $result .= ' AND ';
                    }
                }
            }
        }
        return $result;
    }
    /**
    * @param string $table
    * Name Table
    * @param array $where
    * column => row
    * @param array $new
    * column => row
    *
    * @return string
    * For initialization Sql Code And Run (UPDATE)
    */
    public function update(string $table,array $where,array $new) 
    {
        return $this->query($this->update_sql($table,$where,$new));
    }
}