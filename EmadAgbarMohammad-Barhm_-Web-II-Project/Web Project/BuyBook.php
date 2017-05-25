<?php
    session_start();
    extract($_GET); //$bid $sid
    include 'connect.php';
    
    
    $sql="update branch_has set stock=stock-1 where bid=$bid";
    $result = $dbObj->query($sql);
    
    $sql="insert into customer_has values({$_SESSION['id']},$bid,'$sid');";
    
    $result2 = $dbObj->query($sql);
    if($result&&$result2){
        echo"1";
    }
    else if ($result) {
        echo"result";
    }
    else if ($result2) {
        echo"result2";
    }
 else {
        echo 'noo';
}
    

    
