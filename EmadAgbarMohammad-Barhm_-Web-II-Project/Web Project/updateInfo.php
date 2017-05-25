<?php
    session_start();
    extract($_GET); // $name $email $phone $address $update $oldPass $newPass $newPassConfim
    include 'connect.php';
    
    if (isset($update)&&$update=='info'){
        $sql2="update users set name='$name',address='$address',phoneNumber='$phone',email='$email' where uid={$_SESSION["id"]}";
        $result2=$dbObj->query($sql2);
        if ($result2==true) {
            $sql="select * from users where name='$name'";
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

            echo"true";
            }
        }
    }
    
    else if (isset($update)&&$update=='pass'){
        if($oldPass!=$_SESSION["password"]){
            echo "1";
        }
        else if(($newPass==""||$newPassConfim=="")||($newPass!=$newPassConfim)){
             echo "2";
        }
        
        else {
        
           $sql2="update users set password='$newPass' where uid={$_SESSION["id"]}";
           $result2=$dbObj->query($sql2);
           if ($result2==true) {
               echo"true";
                $sql="select * from users where uid={$_SESSION["id"]}";
                $result = $dbObj->query($sql);
                $numOfRows = $dbObj->getSize($result);
                if($numOfRows == 1){
                    $user = $dbObj->getAssoc($result);
                    $_SESSION["password"] = $user["password"];
                }
            }
        }
    }
    
    ?>