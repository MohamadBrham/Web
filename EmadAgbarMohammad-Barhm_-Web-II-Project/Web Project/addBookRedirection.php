<?php
    session_start();
    extract($_GET);//$price,$name ,$stock ,$year , $author
    include 'connect.php';
    
    if(!isset($_SESSION["authenticate"]) ||  $_SESSION["authenticate"] != "manager")
    {
    header("Location:LoginPage.php");
    }    
    else {
         
        $sql = "insert into books(bname,author,year,price) values('$name','$author',$year ,$price)";
        $dbObj->query($sql); 
        
        $sql = "SET FOREIGN_KEY_CHECKS = 0;";
        $result=$dbObj->query($sql);
        $sql="insert into branch_has values((select bid from books where bname='$name'),(select sid from store_branch where mid = {$_SESSION["id"]}),$stock);";
        $result=$dbObj->query($sql);
        if ($result) {
            echo"seccess";
        }
        else {
            echo 'Failed'; echo "$sql";
            
        }
        $sql="SET FOREIGN_KEY_CHECKS = 1;";
        $result=$dbObj->query($sql);
        
    }
   

?>