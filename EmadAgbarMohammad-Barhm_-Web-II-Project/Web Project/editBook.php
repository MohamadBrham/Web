<?php
    session_start();
    extract($_GET); //$bid
    include"connect.php";
    if(!isset($_SESSION["authenticate"]) ||  $_SESSION["authenticate"] != "manager")
    {
        header("Location:LoginPage.php");
    }
    
?>

<html>
    <head>
        <title>BookStore</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src="jquery-1.12.3.js"></script>
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
                       
            #title{
                background-color: crimson;
                opacity: 0.85;
                text-align: center;
                height: 60px;
                font-size: 40px;
            }
            
            .h{
                width: 100%;
                height: 100%;
            }
            
            #form{
                margin: 50px auto;
                background-color: rgba(0,0,0,.5);
                border-spacing: 20px;
                height: 400px;
            }
            
            input{
                border: 2px solid black;
                height: 30px;
            }
            
            
            textarea{
                width: 173px;
                height: 70px;
                border: 2px solid black;
            }
            .a{
                color: white;
            }
           
            table,td,th{
                //border: 1px solid white;
            }
            
        </style>
        <script>
            $(function (){
                $("#addBtn").click(function(){
                    name = $("#name").val();
                    author = $("#author").val();
                    price = $("#price").val();
                    stock = $("#stock").val();
                    year  = $("#year").val();
                    bid   = $("#bid").val(); 
                    if(name =="" || author == "" || price == "" || stock == "" || year == ""){
                        $("#result").css("color","red");
                        $("#result").html("Fill all the Fields :( ");
                    }else{                    
                        $.get("editBookRedirection.php",{ bid:bid,name : name , author : author ,price:price , stock:stock ,year:year}, function(result){
                            $("#result").css("color","greenyellow");
                            $("#result").html(name + "Book Edited Correctly :) ");
                            $("#name").val(name);
                            $("#author").val(author);
                            $("#price").val(price);
                            $("#stock").val(stock);
                            $("#year").val(year);
                        });
                    }
                });
                
            });
        
        
        </script>
        
        
        
        
        
        
    </head>
    
    <body>
        <table id="header" >
            <tr>
                <td rowspan="2" id="title">------ BookStore ------</td>
                <td class="x"><input type="button" class="h" value="Home" onclick="location.href = 'Manager.php';"></td>
            </tr>
            <tr>
                <td><input type="button" class="h" value="Logout" onclick="location.href = 'Logout.php';"></td>
            </tr>
            
        </table>
        
        <table id="form">
            <input type="hidden" id="bid" value="<?php
                if(isset($bid)){
                    echo $bid;
                }
            ?>">
            <tr><th colspan="4" style="height: 40px; background-color: rgba(255,255,0,0.5); font-size: 30px; font-weight: bold"> Edit a Book</th></tr>
            <tr ><th colspan="4" style="height: 40px;  font-size: 24px; font-weight: bold ;color: greenyellow ;" id="result"></th></tr>
                            <tr>
                                <td class="a">Book name : </td><td><input type="text" id="name" value="<?php
                                    if(isset($bid)){
                                        $sql = "SELECT * FROM books where bid=$bid";
                                        $result = $dbObj->query($sql);
                                        $row = $dbObj->getArray($result);
                                        echo "$row[1]";
                                    }
                                ?>"></td>
                                <td class="a" style="text-align: right;">Author(s) :</td><td><input type="text" id="author" value="<?php
                                    if(isset($bid))
                                        echo "$row[2]";
                                ?>"></td>
                            </tr>
                            <tr>
                                <td class="a">Publish year : </td><td><input type="text" id="year" value="<?php
                                    if(isset($bid))
                                        echo $row[3];
                                ?>"></td>
                                <td class="a" style="text-align: right;">Stock : </td><td><input type="text" id="stock" value="<?php
                                    $sql = "SELECT stock FROM branch_has where bid=$bid and sid in (select sid from store_branch where mid={$_SESSION['id']})";
                                        $result11 = $dbObj->query($sql);
                                        $row1 = $dbObj->getAssoc($result11);
                                        if($row1['stock']!=""){
                                        echo "{$row1['stock']}";
                                        }
                                        else {echo "0";}
                                ?>"></td>
                            </tr>
                            <tr>
                                <td class="a">Price : </td><td><input type="text" id="price" style="width: 100px;" value="<?php
                                    if(isset($bid))    
                                        echo "$row[4]";
                                ?>"></td>
                                <td colspan="2" style="text-align: center;"><input type="button" id="addBtn" value="Edit" style="height: 50px; width:100px ; font-size: 20px; font-weight: bold"></td>
                            </tr>
                            
                            
                        
        </table>
        
          
    </body>
</html>
