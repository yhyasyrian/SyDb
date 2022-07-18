<?php
namespace YhyaSyrian\Sql;

abstract class Query{
    /**
    * @param string $query
    * SQL Code
    * 
    * @return mixed
    * SQL Code Run And Return Result
    */
    public function query (string $query) : mixed {
        try {
            $result = $this->connect->query($query);
        } catch (\mysqli_sql_exception $th) {
            throw new Exception($th->getMessage(),$th->getCode());
            return $th->getMessage();
        }
        return $result;
    }
}