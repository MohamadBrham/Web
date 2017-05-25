<?php
include"connect.php";
session_start();
extract($_GET);
if(!isset($_SESSION["authenticate"]) ||  $_SESSION["authenticate"] != "admin")
{
    header("Location:LoginPage.php");
}

?>

<html>
    <head>
        <title>BookStore - Admin</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <style>
             body {
                background-image: url("c.jpg") ;
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
                background-color: crimson;
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
            
            #Branches{
                background-color: rgba(0,0,0, .3);
                margin: auto;
                width: 1000px;
                height: 400px;
                border: 3px solid black;
                overflow-y: auto;
            }
            
            #BranchesTable{
                width: 100%;
                text-align: left;
                
            }
            
            #BranchesTable td{
                height: 40px;
                padding-left: 5px;
            }
            th{height: 50px; border-bottom: 3px dashed black;}
            
            table,td,th,div{
                //border: 1px solid white;
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
            
        </table>
        
        
            <table style="margin: 10px auto; width: 300px; height:50px;">
                <tr>
                <td><input type="button" value="Add a branch" style="width: 100%; height: 100%;" onClick="location.href = 'addBranch.php';"></td>
                <td><input type="button" value="Add a manager" style="width: 100%; height: 100%;" onClick="location.href = 'addManager.php';"></td>
                </tr>
            </table>
       
        <div id="Branches">
            
            <table id="BranchesTable">
                <tr><th colspan="6" style="text-align: center; font-size: 30px; font-weight: bold;">Store Branches</th></tr>
                <tr>
                    <th style="width: 100px;">ID</th>
                    <th style="width: 300px;"> Branch Name</th>
                    <th> Location</th>
                    <th colspan="2"> Managers </th>
                    
                </tr>
                <?php
                $sql = "select * from store_branch";
                $result = $dbObj->query($sql);
                while($row = $dbObj->getArray($result)){
                    echo "<tr>";
                    echo "<td>$row[0]</td>";
                    echo "<td>$row[1]</td>";
                    echo "<td>$row[3]</td>";
                    $sql = "select * from users where uid = $row[2] ";
                    $res = $dbObj->query($sql);
                    $managerInfo = $dbObj->getArray($res);
                    echo "<td>$managerInfo[1]</td>";
                    
                    echo"<td style=\"width: 50px;\"><input type=\"button\" value=\"Modify\" onclick=\"location.href = 'editBranch.php?sid=$row[0]';\" ></td>";
                    
                    echo "</tr>";
                    
                    
                }
                
                ?>
                
                
            </table>
        </div>
          
    </body>
</html>
s