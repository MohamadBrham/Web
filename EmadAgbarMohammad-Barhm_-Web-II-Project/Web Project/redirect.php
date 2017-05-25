<?php
    session_start();
    extract($_GET);//$username , $password
    include "connect.php";
    
    
    $sql="select * from users where name='$username' and password=$password";
    $result = $dbObj->query($sql);
    
    $numOfRows = $dbObj->getSize($result);
    
    if($numOfRows == 1){
       $user = $dbObj->getAssoc($result);
       
        
        $_SESSION["id"] = $user["uid"];
        $_SESSION["name"] = $user["name"];
        $_SESSION["type"] = $user["type"];
        $_SESSION["address"] = $user["address"];
        $_SESSION["phone"] = $user["phoneNumber"];
        $_SESSION["email"] = $user["email"];
        $_SESSION["password"] = $user["password"];
        
       if($user["type"] == "customer"){
           $_SESSION["authenticate"] = "customer";
           header('Location: customer.php');
       }
       else if($user["type"]=="admin"){
           $_SESSION["authenticate"] = "admin";
           header('Location: admin.php');
       }
       else{ // manager
           $_SESSION["authenticate"] = "manager";
           header('Location: manager.php');
       }
    }    
    else {
        header('Location: LoginPage.php?wrongPass=1');
    }
    
    
?>