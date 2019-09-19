<?php
class Connection{
    private $host = 'localhost';
    private $dbname = 'teamvalid';
    private $username = 'root';
    private $password = '';
    public $conn;

    public function __construct(){
        try{
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->username,$this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $error){
            echo $error->getMessage();
        }
    }
    public function getDb() {
        if ($this->conn instanceof PDO) {
             return $this->conn;
        }
     }
}
?>