<?php
    extract($_GET);
    include"connect.php";

    
?>

<html>
    <head>
        <title>BookStore - Add Manager</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src="jquery-1.12.3.js"> </script>
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
            
            input,textarea{
                border: 2px solid black;
            }
            
            
            textarea{
                width: 173px;
                height: 70px;
            }
            .a{
                color: white;
            }
           
            table,td,th{
               // border: 1px solid white;
               text-align: center;
            }
            
        </style>
        <script>
        
        function addManager(){     
            name =$("#name").val();
            email = $("#email").val();
            address = $("#address").val();
            phone = $("#phone").val();
            pass1 = $("#pass1").val();
            pass2 = $("#pass2").val();
            if( name == "" || email == "" || address == "" || phone == "" || pass1 == "" || pass2 =="" ){
                $("#result").css("color","red");
                $("#result").html("Fill all the Fields :( ");
                
            }
            else if(pass1 != pass2){
                $("#result").css("color","red");
                $("#result").html("Passwords are incopatible");
            } 
            else{
                $.get("AddManagerRedirection.php",{email:email , name : name , address : address ,phone:phone , pass1:pass1 ,pass2:pass2}, function(result){
                    if(result==='1'){
                        $("#result").css("color","red");
                        $("#result").html("Email is wrong ar already exists");
                    }
                    else if (result==='2'){
                    $("#result").css("color","greenyellow");
                    $("#result").html(name +"  Added Correctly :)  ");
                    }
                    else {
                        $("#result").css("color","red");
                        $("#result").html("Couldn't add manager :/");
                    }
                });
            }
            
        }
        </script>
        
    </head>
    
    <body>
        <table id="header" >
            <tr>
                <td rowspan="2" id="title">------ BookStore ------</td>
                <td class="x"><input type="button" class="h" value="Home" onclick="location.href = 'admin.php';"></td>
            </tr>
            <tr>
                <td><input type="button" class="h" value="Logout" onclick="location.href = 'LoginPage.php';"></td>
            </tr>
            
        </table>
        
        <table id="form">
            <tr><th colspan="4" style="height: 40px; background-color: rgba(255,255,0,0.5); font-size: 30px; font-weight: bold"> Add a Manager</th></tr>
            <tr><th colspan="4" id="result" style="height: 30px; font-size: 24px; font-weight: bold ; color: greenyellow"></th></tr>
                        
                            <tr>
                                <td class="a">Enter your info please :</td>
                                <td class="a">Password : </td>
                            </tr>
                            <tr>
                                <td><input id="name" type="text" placeholder="Manager name" style="height: 30px" tabindex="1"></td>
                                <td><input id="pass1" type="password" placeholder="Password" style="height: 30px" tabindex="5"></td>
                            </tr>
                            <tr>
                                <td><input id="email" type="text" placeholder="Email address" style="height: 30px" tabindex="2"></td>
                                <td><input id="pass2"  type="password" placeholder="Confirm Password" style="height: 30px" tabindex="6"></td>
                            </tr>
                            <tr>
                                <td><input id="phone" type="number" placeholder="Phone Number" style="height: 30px" tabindex="3"></td>
                                <td rowspan="3" style="text-align: center;">
                                    <input type="button" value="Add" id="addManager" onclick="addManager()" style="height: 50px; width:100px ; font-size: 20px; font-weight: bold">
                                </td>
                            </tr>
                            <tr>
                                <td class="a">Address :</td>
                            </tr>
                            
                            <tr>
                                <td><textarea id="address" placeholder="Exact address" tabindex="4"></textarea></td>
                            </tr>
                            
                        
        </table>
        
          
    </body>
</html>
s