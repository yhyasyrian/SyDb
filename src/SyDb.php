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
    /**
    * SyDb constructor.
    *
    * @param string $Host
    * @param string $User
    * @param string $Pass
    * @param string $DB
    */
    public function __construct(public string $Host,public string $User,public string $Pass,public string $DB) { 
        $this->connect(); // For Connect DataBase
    }
}
// print_r(__DIR__);