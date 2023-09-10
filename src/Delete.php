<?php
namespace YhyaSyrian\Sql;
require_once __DIR__.'/Query.php';
class Delete extends Query{
    /**
    * @param string $table
    * Name Table
    * @param array $where
    * column => row
    *
    * @return string
    * For initialization Sql Code (DELETE)
    */
    public function delete_sql(string $table,array $where) : string
    {
        $sql = "DELETE FROM `{$table}`";
        $where = array_merge($where,$this->whereGlobal);
        $sql .= $this->ArrayToString($where,true);
        return $sql.';';

    }
    /**
    * @param array $array
    *
    * @return string
    * For Array Conversion To String Ready To Use
    */ 
    private function ArrayToString(array $array) : string
    {
        $result = '';
        $array = $this->filterArrayMap($array);
        $count = count($array);
        $i = 0;
        if ($count != 0) {
            $result = ' WHERE ';
            foreach ($array as $key => $value) {
                if (\is_string($value) and !\preg_match('/^-[0-9]+$/',$value)) {
                    $value = $this->Filter($value);
                    $result .= "`{$key}`='{$value}'";
                } else {
                    if (empty($value)) {
                        $value = "''";
                    }
                    $result .= "`{$key}`={$value}";
                }
                $i++;
                if ($count != $i) {
                    $result .= ' AND ';
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
    *
    * @return void
    * For initialization Sql Code And Run (DELETE)
    */
    public function delete(string $table,array $where) :void
    {
        $this->query($this->delete_sql($table,$where));
    }
}