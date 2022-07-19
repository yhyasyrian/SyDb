<?php
namespace YhyaSyrian\Sql;

use YhyaSyrian\Sql\Exception;

require_once __DIR__.'/Close.php';
abstract class Connect extends Close{
    /**
    * @return bool
    */
    public function connect() : bool
    {
        try{
            @$this->connect = @mysqli_connect($this->Host,$this->User,$this->Pass,$this->DB);
            @mysqli_set_charset($this->connect,$this->charset);
        } catch (\mysqli_sql_exception $th) {
            throw new Exception($th->getMessage(),$th->getCode(),$th);
            return false;
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(),$th->getCode(),$th);
            return false;
        }
        if(!$this->connect){
			throw new Exception("I Can't Connect To Mysql",503);    
            return false;
		}
        return true;
    }
}