<?php
namespace YhyaSyrian\Sql;
require_once __DIR__.'/Exception.php';
require_once __DIR__.'/Select.php';
class SyDb extends Select{
    /* *
    * @var Charset Data In DataBase 
    */
    public $charset = 'utf8mb4';
    /* *
    * @var Connect In DataBase
    */
    public $connect;
    /* *
    * @var whereGlobal For Add Key And Value In Table
    */
    public $whereGlobal = [];
    /**
    * SyDb constructor.
    *
    * @param string $Host
    * @param string $User
    * @param string $Pass
    * @param string $DB
    */
    public function __construct(public string $Host,public string $User,public string $Pass,public string $DB) { 
        try {
            $this->connect(); // For Connect DataBase
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(),$th->getCode(),$th);
        }
    }
}
// print_r(__DIR__);