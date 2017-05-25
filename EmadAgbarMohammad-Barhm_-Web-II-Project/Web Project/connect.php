<?php
class DB{
    private $username = "root";
    private $password= "root123";
    private $host = "localhost";
    private $dbname = "books_store";
    private $con;
    private $db_select;

    public function __construct() {
       $this->con = mysqli_connect($this->host, $this->username, $this->password) or die("MySQL DBMS connection fail");
       $db_select = mysqli_select_db($this->con, $this->dbname) or die("can not connect to Database");
    }
    public function __destruct() {
        mysqli_close($this->con);
    }
    public function query($sql){
        return mysqli_query($this->con, $sql);
    }
    public function getArray($result){
        return mysqli_fetch_array($result);
    }
    public function getAssoc($result){
        return mysqli_fetch_assoc($result);
    }    
    public function getNumberOfRows($result){
        return mysqli_num_rows($result);
    }
    public function getNumberOfFileds($result){
        return mysqli_num_fields($result);
    }
    function getSize($result){
     return mysqli_num_rows($result);
    }
}
$dbObj = new DB();


