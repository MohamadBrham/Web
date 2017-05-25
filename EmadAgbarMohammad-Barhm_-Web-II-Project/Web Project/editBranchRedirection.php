<?php
    session_start();
    extract($_GET);//$name,$location ,$manager , $sid
    
    include 'connect.php';
    if(!isset($_SESSION["authenticate"]) ||  $_SESSION["authenticate"] != "admin")
    {
    header("Location:LoginPage.php");
    }    
    else {
         
        $sql = "UPDATE store_branch SET sname='$name' , location='$location' ,mid =$manager WHERE sid = '$sid';";
        $result=$dbObj->query($sql); 
        if($result){
            echo"1";
        }
    }
   

?>