<?php
    session_start();
    extract($_GET); 
    
    if(!isset($_SESSION["authenticate"]) ||  $_SESSION["authenticate"] != "manager")
    {
        header("Location:LoginPage.php");
    }
    include"connect.php";
?>

<html>
    <head>
        <title>BookStore - Manager</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <style>
             body {
                background-image: url("b.jpg") ;
                background-repeat: no-repeat;
                background-size: cover;
            }
            #header{
                //border:1px solid black;
                width: 100%;
                margin: -10px;
            }
                        
            input{
                width: 100%;
            }
                        
            #title{
                background-color: goldenrod;
                opacity: 0.85;
                text-align: center;
                height: 60px;
                font-size: 40px;
            }
            
            #logOut{
                width: 100%;
                height: 100%;
            }
            
            #info{
                margin:50px auto;
                margin-bottom: 10px;
                border:1px solid black; 
                padding:10px; 
                width: 1000px;
                background-color:rgba(255,255,255, .5);
            }
            
            .headers{
                text-align: center;  
                height: 40px; 
                font-size: 20px;
            }
            
            #booksInBranch{
                background-color: rgba(244,164,96, .8);
                margin: auto;
                width: 1100px;
                height: 600px;
                border: 3px solid black;
                overflow-y: auto;
            }
            
            #booksInBranchTable{
                width: 100%;
                text-align: left;
            }
            
            #booksInBranchTable td{
                height: 40px;
                padding-left: 5px;
            }
            th{height: 50px; border-bottom: 3px dashed black;}
            
            table,td,th{
               // border: 1px solid white;
            }
        </style>
        
        
        
    </head>
    
    <body>
        <table id="header" >
            <tr>
                <td rowspan="2" id="title">------ BookStore ------</td>
                <td><input type="button" id="logOut" value="Logout" onclick="location.href = 'Logout.php';"></td>
            </tr>
            
        </table>
        
        <table id="info">
            <tr><td colspan="4" class="headers">----------------- Personal Info -----------------</td> </tr>
            <tr>
                <?php
                echo "<td style='padding-right: 10px;'><span style='font-weight: bold'>ID :</span> {$_SESSION["id"]} </td>";
                echo "<td style='padding-right: 50px;'><span style='font-weight: bold'>Name :</span> {$_SESSION["name"]}</td>";
                echo "<td style='padding-right: 50px;' ><span style='font-weight: bold'>Type :</span> {$_SESSION["type"]}</td>";
                ?>
            </tr>
            <tr>
                <?php
                echo "<td><span style='font-weight: bold'>Phone Number </span> {$_SESSION["phone"]} </td>";
                echo "<td><span style='font-weight: bold'>Email : </span> {$_SESSION["email"]}</td>";
                echo "<td><span style='font-weight: bold'>Address </span> {$_SESSION["address"]}</td>";
                 ?>
            </tr>
            </tr>
            
            <tr><td colspan="4" class="headers">----------------- Branch Info -----------------</td> </tr>
            <tr>
                <?php
                $sql = "select * from  store_branch where mid={$_SESSION["id"]}";
                $result = $dbObj->query($sql);
                if($dbObj->getSize($result) > 0){
                    $row = $dbObj->getArray($result);
                    echo "<td><span style='font-weight: bold'>Branch ID : </span> {$row[0]}</td>";
                    echo "<td><span style='font-weight: bold'>Branch name : </span> {$row[1]}</td>";
                    echo "<td><span style='font-weight: bold'>Address : </span>{$row[3]}</td>";
                }
                
                ?>    
            </tr>
        </table>
        
        <div style="margin: 10px auto; width: 150px; height: 50px;"><input type="button" value="Add a book" style=" width: 100%; height: 100%;" onclick="location.href = 'addBook.php';"></div>
        <div id="booksInBranch">
            
            <table id="booksInBranchTable">
                <tr><th colspan="6" style="text-align: center; font-size: 30px; font-weight: bold;">Books in this branch</th></tr>
                <tr>
                    <th style="width: 300px;"> Book Name</th>
                    <th style="width: 300px;"> Author(s)</th>
                    <th> Publish year</th>
                    <th> price </th>
                    <th colspan="2"> Stock </th>
                    
                </tr>
                <?php
                $sql = "SELECT * FROM books_store.books where bid in (select bid from branch_has where sid=(select sid from store_branch where mid = {$_SESSION["id"]}));";
                $result = $dbObj->query($sql);
                while($row = $dbObj->getArray($result)){
                    echo "<tr>";
                    echo "<td>$row[1]</td>";
                    echo "<td>$row[2]</td>";
                    echo "<td>$row[3]</td>";
                    echo "<td>$row[4]</td>";
                    $sqll="SELECT stock FROM branch_has where bid=$row[0]";
                        $result11 = $dbObj->query($sqll);
                        $row1 = $dbObj->getAssoc($result11);
                    echo "<td>{$row1['stock']}</td>";
                    echo "<td style='width: 50px;'><input type='button' value='Modify' onclick=\"location.href = 'editBook.php?bid=$row[0]';\"></td>";
                    echo "</tr>";
                    
                    
                }
                ?>
                
                
            </table>
        </div>
          
    </body>
</html>
