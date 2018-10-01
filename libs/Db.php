<?php
namespace libs;
use PDO;

class DB
{
//    private static $pdo = null;
//    private function __clone(){}
//    private $_obj;
//    private function __construct()
//    {
//        $this->_obj = new \PDO('mysql:host=localhost;dbname=blog001','root','');
//        $this->_obj->exec('set names utf8');
//    }


    private static $pdo = null;
    private function __clone(){}
    private function __construct()
    {

    }

    public static function make()
    {
        if(self::$pdo === null)
        {
            self::$pdo = new PDO('mysql:hast=localhost;dbname=blog001','root','123456');
            self::$pdo->exec('set names utf8');
        }
        return self::$pdo;
    }

}

?>