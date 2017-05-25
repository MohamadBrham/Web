<?php

    extract($_GET);// $sid
    include 'connect.php';
    $sql = "SET FOREIGN_KEY_CHECKS = 0;";
    $dbObj->query($sql);
    
    $sql1="DELETE FROM store_branch WHERE sid='114'; DELETE FROM branch_has WHERE sid='114';";
    echo"$sql1";
    $result=$dbObj->query($sql1);
    
    if($result){
        echo "1";
    }
    else if(!$result){
        echo "2";
    }
    $sql = "SET FOREIGN_KEY_CHECKS = 1;";
    $dbObj->query($sql);
