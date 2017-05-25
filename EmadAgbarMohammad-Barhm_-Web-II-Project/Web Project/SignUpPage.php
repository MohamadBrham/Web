<html>
    <head>
        <title>BookStore - Sign up</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <style>
            body{
                background-image: url("b.jpg");
                background-repeat: no-repeat;
                background-size: cover;
            }
            
            h1{
                background-color: red;
                opacity: 0.75;
                width: 230px;
                border: 3px solid black;
                margin: -8px;
                padding: 5px;
               
            }
            
            table{
                margin: 5px 5px;
                border-spacing: 5px;
               // border: 1px solid black;
            }
            input,textarea{
                border: 2px solid black;
            }
            textarea{
                width: 173px;
                height: 70px;
            }
            
            .buttons{
                width: 150px;
                height: 40px;
                border-bottom-left-radius: 50%;
                border-bottom-right-radius: 50%;
                border-top-left-radius: 50%;
                border-top-right-radius: 50%;
                opacity: .75;
            }
            
            .a{
                color: white;
            }
            
        </style>
    </head>
    
    <body>
        <?php
            extract($_GET); // $passError
        ?>
        <form method="GET" action="SignUp.php">
            
            <h1>BookStore</h1>
            <table>
                <tr>
                    <td>
                        <table>
                            <tr><td class="a">Enter your info please:</td></tr>
                            <tr><td><input type="text" <?php if(isset($passError)&&(($passError==1|| $passError==2)||(($passError==0)&&isset($Username)))){echo"value='$Username'";}?> placeholder="Username" name="Username"></td></tr>
                            <tr><td><input type="text"<?php if(isset($passError)&&(($passError==1)||(($passError==0)&&isset($email)))){echo"value='$email'";}?> placeholder="Email address" name="email"></td></tr>
                            <tr><td><input type="number" <?php if(isset($passError)&&(($passError==1|| $passError==2)||(($passError==0)&&isset($phone)))){echo"value='$phone'";}?> placeholder="Phone Number" name="phone"></td></tr>
                            <tr><td class="a">Address :</td></tr>
                            <tr><td><textarea placeholder="Exact address"  name="address"><?php if(isset($passError)&&(($passError==1|| $passError==2)||(($passError==0)&&isset($address)))){echo"$address";}?></textarea><td></tr>
                        </table>
                    </td>

                    <td style="vertical-align: top;">
                        <table>
                            <tr><td class="a">Password : </td></tr>
                            <tr><td><input type="password"  placeholder="Password" <?php if(isset($passError)&&(($passError==2)||(($passError==0)&&isset($password)))){echo"value='$password'";}?>name="password"></td></tr>
                            <tr><td><input type="password" placeholder="Confirm Password" <?php if(isset($passError)&&(($passError==2)||(($passError==0)&&isset($confirmPass)))){echo"value='$confirmPass'";}?> name="confirmPass"></td></tr>
                            <tr style="height: 70px;">
                                <?php
                                    $msg="";
                                    if(isset($passError)&&$passError==0){
                                        $msg = "* Please fill all the fields";
                                    }
                                    if(isset($passError)&&$passError==1){
                                        $msg = "* Passwords are incompatible or empty";
                                    }
                                    if(isset($passError)&&$passError==2){
                                        $msg = "* Email address is wrong or already used";
                                    }
                                    echo "<td style=' color: red; background-color: rgba(0,0,0,.8); font-size: 15px; text-align: center;'>$msg</td>";
                                ?>
                            </tr>
                            <tr><td style="text-align: center;"><input type="submit" value="Sign up" class="buttons" style="background-color: #33ff33; "></td></tr>
                            <tr><td style="text-align: center;"><input type="button" value="Cancel" onclick="window.close();" class="buttons" style="background-color: #ff3333"></td></tr>
                        </table>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>


                                