<?php
    session_start();
    
    include 'connect.php';
    if(!isset($_SESSION["authenticate"]) ||  $_SESSION["authenticate"] != "admin")
    {
    header("Location:LoginPage.php");
    }  
    else {
        extract($_GET); //$id,$name ,$location ,$manager
        $sql = "insert into store_branch values('$id','$name',$manager,'$location')";
        $result=$dbObj->query($sql); 
        if($result){
            echo("1");
        }
        else {echo($result);}
    }
   

?>