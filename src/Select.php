<?php
namespace YhyaSyrian\Sql;
require_once __DIR__.'/Update.php';
abstract class Select extends Update{
    /**
    * @param string $table
    * Name Table
    * @param array $where
    * column => row
    * @param string $etcWhere
    *
    * @return string
    * For initialization Sql Code (SELECT)
    */
    public function select_sql(string $table,array $where = [],string $etcWhere = null) : string
    {
        $sql = "SELECT * FROM `{$table}`";
        $sql .= $this->ArrayToString($where);
        if (!empty($etcWhere)) $sql .= ' '.$etcWhere;
        return $sql;

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
        $count = count($array);
        $i = 0;
        if ($count != 0) {
            $result = ' WHERE ';
            foreach ($array as $key => $value) {
                $value = $this->Filter($value);
                $result .= "`{$key}`='{$value}'";
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
    * @param string $etcWhere
    *
    * @return mysqli_result
    * For initialization And Run SQL Code -Select Data- (SELECT) 
    */
    public function select(string $table,array $where = [],string $etcWhere = null) : \mysqli_result 
    {
        return $this->query($this->select_sql($table,$where,$etcWhere));
    }
    /**
    * @param mixed $sqlResult
    * SQL Code (SELECT)
    * @return array
    * For View All Data (SQL Code)
    */
    public function fetch_all_query(mixed $sqlResult) :array
    {
        try {
            return mysqli_fetch_all($sqlResult,MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(),$th->getCode());
            return ['ok'=>false,'error'=>$th->__toString()];
        }
    }
    /**
    * @param mixed $table
    * Name Table
    * @param array $where
    * column => row
    * @param string $etcWhere
    *
    * @return array
    * For View All Data With (SQL Code Or Selection Data Special)
    */
    public function fetch_all(mixed $table,$where = [],string $etcWhere = null) :array
    {
        if(is_string($table)){
            return $this->fetch_all_query($this->select($table,$where,$etcWhere));
        } else {
            return $this->fetch_all_query($table);
        }
    }
    /**
    * @param mixed $sqlResult
    * SQL Code (SELECT)
    * @return array
    * For View Data With (SQL)
    */
    public function fetch_query(mixed $sqlResult) :array
    {
        try {
            return mysqli_fetch_assoc($sqlResult);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(),$th->getCode());
            return ['ok'=>false,'error'=>$th->__toString()];
        }
    }
    /**
    * @param mixed $table
    * Name Table
    * @param array $where 
    * column => row
    * @param string $etcWhere
    * 
    * @return array
    * For View Data With (Sql Code Or Selection Data Special)
    */
    public function fetch(mixed $table,$where = [],string $etcWhere = null) :array
    {
        if(is_string($table)){
            return $this->fetch_query($this->select($table,$where,$etcWhere));
        } else {
            return $this->fetch_query($table);
        }
    }
}