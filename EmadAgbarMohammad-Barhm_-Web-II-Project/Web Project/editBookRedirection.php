<?php
    session_start();
    extract($_GET);//$price,$name ,$stock ,$year , $author ,$bid
    include 'connect.php';
    if(!isset($_SESSION["authenticate"]) ||  $_SESSION["authenticate"] != "manager")
    {
    header("Location:LoginPage.php");
    }     
    else {
         
        $sql = "UPDATE books SET price=$price , bname='$name' ,year =$year , author='$author' WHERE bid = $bid";
        $dbObj->query($sql); 
        $sql = "update branch_has set stock=$stock where bid=$bid and sid in (select sid from store_branch where mid={$_SESSION['id']})";
         $dbObj->query($sql);
        
    }
   

?>