<?php
namespace core;

class db extends \PDO{
    public function __construct(){
        $dsn = 'mysql:host=localhost;dbname=skphp';
        $username = 'root';
        $passwd = 'root';
        try{
            parent::__construct($dsn,$username,$passwd);
            // echo 'database connect success';
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }
}