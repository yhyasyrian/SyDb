<?php
namespace YhyaSyrian\Sql;
require_once __DIR__.'/Connect.php';
class Query extends Connect{
    /**
    * @param string $query
    * SQL Code
    * 
    * @return mixed
    * SQL Code Run And Return Result
    */
    public function query (string $query) : mixed {
        try {
            if (empty($this->connect)) {
                $this->connect();
            }
            $result = $this->connect->query($query);
        } catch (\mysqli_sql_exception $th) {
            throw new Exception($th->getMessage()." Code Error: {$query}",$th->getCode());
            return $th->getMessage();
        }
        return $result;
    }
}