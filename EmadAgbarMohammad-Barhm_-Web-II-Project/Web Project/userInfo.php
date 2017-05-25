<?php
    session_start();
    extract($_GET);
    include"connect.php";
    
    if(!isset($_SESSION["authenticate"]) ||  $_SESSION["authenticate"] != "customer")
    {
        header("Location:LoginPage.php");
    }
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
            
            td{
               // border:1px solid black;
                vertical-align: top;
            }
            input{
                width: 100%;
            }
            
            .x{
                width: 150px;
            }
            
            #title{
               background-color: chocolate;
                opacity: 0.85;
                text-align: center;
                height: 60px;
                font-size: 40px;
            }
            
            #content{
                background-color: rgba(0,0,0,0.45);
                margin-top: 60px;
                margin-left: auto;
                margin-right: auto;
                border-spacing: 0px;
                width: 1200px;
                height: 500px;
                border-radius: 5%;
                border: 2px solid black;
            }
            
            #a{
                text-align: center;
                margin:30px auto;
                border-spacing: 20px;
            }
            
            
            #add1,#add2{
                width: 200px;
                height: 50px;
                border-radius: 20%;
            }
            
            #add1{
                background-color: rgba(255,0,0,0.75);
              
            }
            
            #add2{
                margin-top: 50px;
                background-color: rgba(0,0,255,0.75);
            }
            
            #orders td{
                width: 240px;
                border: 1px solid black;
                height: 30px;
                background-color: peachpuff;
            }
           
            #right{
                margin: 20px auto;
                
            }
            
            #scroll{
                height: 100px;
                overflow-y: scroll;
            }
            
            #productTable{
                position: relative;
                left: 100px;
                top: 20px;
                border-spacing: 20px;
            }
            
            #product{
                border-spacing: 10px;
                border: 2px solid bisque;
                border-radius: 10%;
                width: 220px;
                height: 260px;
                text-align: center;
                background-color: rgba(255 ,228,196, .7);
            }
            #productTable{
                position: relative;
                left: 20px;
                top: 20px;
                border-spacing: 20px;
            }
            #picture img{
                width: 130px;
                height: 140px;
                
            }
            
            .b{
                padding-top: 5px; 
                font-size: 20px; 
                color: burlywood;
            }
        </style> 
        
        <script>
            function uptade(){
                    name = $("#name").val();
                    email= $("#email").val();
                    phone= $("#phone").val();
                    address= $("#address").val();
                    $.get("updateInfo.php", {name :name, email :email, phone :phone, address :address, update:"info"} , function(result){
                        if(result==="true"){
                            alert("Your information have been updated");
                        }
                        else {
                            alert("Failed");
                        }
                        
                    });
            }
            
            function changePass(){
                oldPass = $("#oldPass").val();
                newPass = $("#newPass").val();
                newPassConfim = $("#newPassConfim").val();
                $.get("updateInfo.php", {oldPass:oldPass, newPass:newPass, newPassConfim:newPassConfim, update:"pass"} , function(result){
                    if(result==="1"){
                        alert("Please enter your correct old password !");
                    }
                    else if(result==="2"){
                        alert("The new password and its confirmation are incompatible or empty.");
                    }
                    else if(result==="true"){
                        alert("Password has been updated successfully.");
                        $("#oldPass").val("");$("#newPass").val("");$("#newPassConfim").val("");
                    }
                    else {
                            alert("Failed");
                            alert(result);
                        }
                        
                    });
                
            }
        </script>
        
    </head>
    
    <body>
        
        <table id="header" >
            <tr>
                <td rowspan="2" id="title">------ BookStore ------</td>
                <td class="x"><input type="button" value="Home" onclick="location.href = 'customer.php';"></td>
                
            </tr>
            <tr>
                <td class="x"><input type="button" value="Logout" onclick="location.href = 'LoginPage.php';"></td>
            </tr>
            
        </table>
        
        <table id="content">
            
            <tr>
                <td>
                    <table id="a">
                        <tr ><td colspan="2" class="b"> -------------- Your info --------------</td></tr>
                        <tr>
                            <td><input type="text" placeholder="Name" id="name" value="<?php echo"{$_SESSION['name']}";?>"></td>
                            <td><input type="text" placeholder="Email" id="email" value="<?php echo"{$_SESSION['email']}";?>"></td>
                        </tr>
                        
                        <tr>
                            <td><input type="text" placeholder="Phone number" id="phone" value="<?php echo"{$_SESSION['phone']}";?>"></td>
                            <td><textarea placeholder="Address" id="address" style="width: 180px; height: 60px;"><?php echo"{$_SESSION['address']}";?></textarea></td>
                        </tr>
                        <tr><td colspan="2"><input type="button" value="Update" onclick="uptade();"></td></tr>
                        
                        <tr ><td colspan="2" class="b">-------------- Change password --------------</td></tr>
                        <tr>
                            <td colspan="2"><input type="password" placeholder="Old password" id="oldPass"></td>
                            
                        </tr>
                        <tr>
                            <td><input type="password" placeholder="New password" id="newPass"></td>
                            <td><input type="password" placeholder="Confirm new password" id="newPassConfim"></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="button" value="Change password" onclick="changePass()"></td>
                        </tr>
                            
                        
                        
                    </table>
                </td>
                
                <td style="vertical-align:middle; border-left: 2px dashed white; width: 700px;"><span style="margin-left: 80px; font-size: 20px; color: burlywood;">Books you ordered : </span>
                     <div style="overflow-y: auto; height:400px; width: 600px; margin: auto; border: 1px solid bisque; ">
                        <table id='productTable'>
                            <?php
        
                                $dbObj = new DB();
                                $sql1="select * from books k , customer_has c where c.uid ={$_SESSION['id']} and k.bid=c.bid";
                                $result1 = $dbObj->query($sql1);

                                $numberOfBooks=$dbObj->getNumberOfRows($result1);
                                if($numberOfBooks!=0){
                                    $x=$numberOfBooks/2;

                                    for($i=0;$i<$x;$i++){
                                            echo "<tr>";
                                            for($j=0;$j<2;$j++){
                                                if(!$book=$dbObj->getAssoc($result1))break;
                                                echo "<td><table id='product'>";
                                                echo"<tr><td colspan='2' style='font-weight: bold;'>{$book['bname']}</td></tr>";
                                                $bookk=stripslashes($book['bname']);
                                                echo"<tr><td colspan='2'><div id='picture'><img src='books/$bookk.jpg'>  </div></td></tr>";

                                                echo"<tr><td colspan='2'>{$book['author']}</td></tr>";
                                                echo"<tr><td colspan='2'>{$book['year']}</td></tr>";
                                                echo"<tr ><td style='color:brown'>Price : {$book['price']}</td></tr>";

                                                echo"</table></td>";

                                            }
                                            echo "</tr>";
                                        }
                                }
                                else {
                                    echo "<tr><td style='color : bisque; font-weight:bold;'> You havn't ordered any book yet !</td></tr>";
                                }
                            ?>
                        </table>
                     </div>
                </td>
            </tr>
            
        </table>
        
    </body>
    
</html>


                        