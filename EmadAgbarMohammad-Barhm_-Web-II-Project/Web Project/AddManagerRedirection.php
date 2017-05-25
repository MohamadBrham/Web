<?php
    session_start();
   
    include 'connect.php';
    if(!isset($_SESSION["authenticate"]) ||  $_SESSION["authenticate"] != "admin")
    {
    header("Location:LoginPage.php");
    }  
    
    else {
        extract($_GET); //$phone,$name ,$lemail ,$address ,$pass1 , $pass2
        $error=false;
         $sql="select * from users";
        $result = $dbObj->query($sql);
        
        while ($rows= $dbObj->getAssoc($result)) {
            if($rows["email"]==$email){ $error=true;}
         }
         
        if(strpos($email, "@")==false||$error==true) {
            echo '1';
        }
        
        else{
            $sql = "insert into users(name,password,type,address,phoneNumber,email) values('$name', '$pass1','manager','$address','$phone','$email');";
            $dbObj->query($sql);   
            echo "2";
        }
    }

?>