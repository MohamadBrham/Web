<?php
    extract($_GET);//$Username $email $phone $address $password $confirmPass
    include"connect.php";
   $error=false;
    $sql="select * from users";
    $result = $dbObj->query($sql);
    while ($rows= $dbObj->getAssoc($result)) {
        if($rows["email"]==$email){ $error=true;}
    }
    
    if($Username=="" || $email=="" ||$phone=="" ||$address=="" ||$password=="" ||$confirmPass==""){
        header("Location: SignUpPage.php?passError=0&&Username=$Username&email=$email&phone=$phone&address=$address&password=$password&confirmPass=$confirmPass");
    }
    
    else if($confirmPass != $password){
        header("Location: SignUpPage.php?passError=1&Username=$Username&email=$email&phone=$phone&address=$address");
    }
    
    else if(strpos($email, "@")==false||$error==true) {
        header("Location: SignUpPage.php?passError=2&Username=$Username&phone=$phone&address=$address&password=$password&confirmPass=$confirmPass");
    }
    
    
    
    
    
    
    else{
    $sql1="insert into users(name,password,type,address,phoneNumber,email) values('$Username', '$password','customer','$address','$phone','$email');";
    $r=$dbObj->query($sql1);
    header("Location: SignedUp.php?");
    }
?>