<?php
namespace YhyaSyrian\Sql;
class Table{
    /**
    * @return array
    * For View Tables In DataBase
    */
    public function viewTable() :array
    {
        $result = [];
        try{
            $DataBase = $this->DB;
            $Table = $this->query('show tables;');
            while ($NameTable = $this->fetch($Table)) {
                $result[] = $NameTable["Tables_in_{$DataBase}"];
            }
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(),$th->getCode());
        }
        return $result;
    }
    /**
    * @param string $table
    * Name Table
    * @param string $dir
    * Dir Path For Save Files In The Dir
    * @param bool $bool
    * Add Number Time UNIX For Name File Export
    * @return bool
    * For Export All Data In File .sql
    */
    public function exportTable(string $table,string $dir,bool $bool = false) :bool
    {
        try {
            $sql = $this->insert_sql($table,$this->fetch_all($table));
            $dir = dirname($dir);
            if ($bool == \true) {
                $table .= '-'.time();
            }
            file_put_contents($dir.'/'.$table.'.sql',$sql);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(),$th->getCode());
        }
        return \true;
    }
    /*
    * @param string $dir
    * Dir Path For Save Files In The Dir
    * @param bool $bool
    * Add Number Time UNIX For Name File Export
    * @return bool
    * For Exports All Table In Files .sql
    */
    public function exportTables(string $dir,bool $bool = true) :bool
    {
        try {
            foreach ($this->viewTable() as $value) {
                $this->exportTable($value,$dir,$bool);
            }
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(),$th->getCode());
        }
        return \true;
    }
}