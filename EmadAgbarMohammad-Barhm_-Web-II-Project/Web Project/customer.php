<?php
    session_start();
    extract($_GET);  
    if(!isset($_SESSION["authenticate"]) ||  $_SESSION["authenticate"] != "customer")
    {
        header("Location:LoginPage.php");
    }
    include"connect.php";
?>

<html>
    <head>
        <title>BookStore - Customer</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src="jquery-1.12.3.js"></script>
        <style>
             body {
                background-image: url("d.png") ;
                background-repeat: no-repeat;
                background-size: cover;
            }
            #header{
                //border:1px solid black;
                width: 100%;
                margin: -10px;
            }
            
            #filter{
                //border:1px solid black;
                margin-top: 20px;
                width: 100%;
                text-align: center
            }
            td, table, div{
               //border:1px solid black;
            }
            
            input{
                width: 100%;
            }
            
            .x{
                width: 150px;
                margin :10px;
                
            }
            
            #title{
                background-color: chocolate;
                opacity: 0.85;
                text-align: center;
                height: 60px;
                font-size: 40px;
            }
            
            #t2{
                background-color: antiquewhite;
                border: 3px solid black;
                position: relative;
                top: 20px;
                width: 150px;
            }
            
            #t2 td{
                border: 1px solid black;
            }
            
            #product{
                border-spacing: 0px;
                border: 2px solid bisque;
                border-radius: 10%;
                width: 200px;
                height: 200px;
                text-align: center;
                background-color: rgba(255 ,228,196, .7);
            }
            
            #productTable{
                position: relative;
                left: 100px;
                top: 20px;
                border-spacing: 20px;
            }
            
            #logOut{
                width: 100%;
                height: 100%;
            }
            
            #picture{
                margin:5px;
                height: 160px;
                //width:100%;
               
            }
            #picture img{
                width: 180px;
                height: 160px;
            }
            
        </style>
        
        
        <script>
            $(function (){
                $("#branch").change(function(){
                    branch = $("#branch").val();
                   
                    $.get("getBooksInBranch.php", {sid : branch} , function(result){
                        $("#productTable").html(result);
                        
                    });
                });
                
                $("#searchBtn").click(function(){
                    value=$("#searchType").val()
                    key=$("#searchKey").val();
                    if(value==='0'){
                        $.get("searchBooks.php", {bname : key, branch : $("#branch").val()} , function(result){
                        $("#productTable").html(result);
                        
                        });
                    }
                    
                    else if(value==='1'){
                        $.get("searchBooks.php", {author : key, branch : $("#branch").val()} , function(result){
                        $("#productTable").html(result);
                        
                        });
                    }
                    
                });
             });  
             
             function BuyBook(id){//{$book['bid']}
                 sid=$("#branch").val();
                 
                 $.get("BuyBook.php", {bid:id,sid:sid} , function(result){
                        if(result==='1'){
                            alert("Book has been bought and added to your oredered books");
                            location.reload();
                        }
                        else {alert(result);}
                        });
                 
             }
             
             
        </script>
        
    </head>
    
    <body>
        <table id="header" >
            <tr>
                <td rowspan="2" id="title">------ BookStore ------</td>
                <td><input type="button" id="MyAccount" value="My account" onclick="location.href = 'userInfo.php';"></td>
            </tr>
            <tr>
                
                <td><input type="button" id="logOut" value="Logout" onclick="location.href = 'Logout.php';"></td>
            </tr>
            
        </table>
        <table id="filter">
            <tr>
                <td style="padding-left: 20px; color: bisque">Select Branch : 
                    <select name="branch" id="branch" name="branch" onclick="changed()" style="width: 200px;">
                        <?php
                        
                            $sql="select * from store_branch";
                            $result = $dbObj->query($sql);
                            
                            while($branch=$dbObj->getAssoc($result)){
                                echo"<option value='{$branch['sid']}'>{$branch['sname']}</option>";
                            }
                            
                        ?>
                        
                    </select>
                </td>
            
                <td>
                    <input type="text" style="width: 250px;" id="searchKey" class="x" placeholder="Searh here">
                    <select id="searchType">
                        <option value="0">Book Name</option>
                        <option value="1">Author Name</option>
                    </select>
                    <input type="button" class="x" id="searchBtn" value="Search">
                </td>
            </tr>
            
        </table>
        
        <div style="overflow-y: auto; height:500px; border: 3px solid black; background-color: rgba(0, 0, 0, .5); ">
            <table id='productTable'>
        <?php
        
            $dbObj = new DB();
            $sql="select * from store_branch";
            $result = $dbObj->query($sql);
            $branch=$dbObj->getAssoc($result);
            $sql1="select * from books k , branch_has b where b.sid ={$branch['sid']} and k.bid=b.bid";
            $result1 = $dbObj->query($sql1);
            
            $numberOfBooks=$dbObj->getNumberOfRows($result1);
            if($numberOfBooks !=0){
                $x=$numberOfBooks/5;

                for($i=0;$i<$x;$i++){
                        echo "<tr>";
                        for($j=0;$j<5;$j++){
                            if(!$book=$dbObj->getAssoc($result1))break;
                            echo "<td><table id='product'>";
                            echo"<tr><td colspan='2' style='font-weight: bold; height:40px;'>{$book['bname']}</td></tr>";
                            $bookk=stripslashes($book['bname']);
                            echo"<tr><td colspan='2'><div id='picture'><img src='books/$bookk.jpg'>  </div></td></tr>";

                            echo"<tr><td colspan='2'>{$book['author']}</td></tr>";
                            echo"<tr><td colspan='2'>{$book['year']}</td></tr>";
                            $sqll="SELECT stock FROM branch_has where bid={$book['bid']}";
                            $result11 = $dbObj->query($sqll);
                            $row1 = $dbObj->getAssoc($result11);
                            if($row1['stock']!=""){
                               echo"<tr><td colspan='2'>Stock : {$row1['stock']}</td></tr>";
                            }
                            else {echo "<tr><td colspan='2'>Stock : 0</td></tr>";}
                            if($row1['stock']==0){
                                echo"<tr style='height: 50px; color:brown'><td>Price : {$book['price']}</td><td><input style='width:70px;' type='button' value='Buy'  disabled='true')'></td></tr>";
                            }
                            else{
                                echo"<tr style='height: 50px; color:brown'><td>Price : {$book['price']}</td><td><input style='width:70px;' type='button' value='Buy' onclick='BuyBook({$book['bid']})'></td></tr>";
                            }
                            echo"</table></td>";

                        }
                        echo "</tr>";
                    }
            }
            else {
                echo"<tr><td style='color:red; font-size:20px;font-weight:bold;'>There are no books in this branch.</td></tr>";
            }
        ?>
            </table>
               
          
        </div>
          
    </body>
</html>
