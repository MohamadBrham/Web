<html>
    <head>
        <meta charset="UTF-8">
        <title>Welcome to BookStore</title>
        <style>
            body {
                background-image: url("a.jpg") ;
                background-repeat: no-repeat;
                background-size: cover;
            }
            
            #container-table{
                margin: 100px auto;
                border-spacing: 0px;
                width: 400px;
                
            }
            
            #title {
                background-color: gold ;
                opacity: 0.75;
                text-align: center;
                height: 60px;
                font-size: 40px;
                color: black;
            }
            
            #contents td{
                width: 205px;
            }
            #contents{
                background-color: black;
                opacity: 0.75;
                height: 270px;
                width: 300px;
            }
            
            #logintable{
                text-align: center;
                margin: 0px auto;
                
            }
            
            #loginbuton{
                background-color: #0033cc;
                color: white;
                border-radius: 50%;
                width: 70px;
                height: 30px;
                margin-top: 10px;
            }
            
            #signupbuton{
                background-color: #33cc00;
                border-radius: 10%;
                width: 150px;
                height: 35px;
            }
            
        </style>
    </head>
    <body>
        <form method="GET" action="redirect.php">
            
            <table id="container-table">
            <tr>
                <td id="title" colspan="2">BookStore</td>
            </tr>
            <tr>
                <td id="contents">
                        <table id="logintable">
                            <tr style="text-align: left; color: white"><td>Login :</td></tr> 
                            <tr style="height: 50px;"><td><input type="text"  placeholder="Username" name="username"></td></tr> 
                            <tr><td><input type="password" placeholder="Password" name="password"></td></tr> 
                            <tr style="text-align: right;"><td><input type="submit" id="loginbuton" value="Login"></td></tr> 
                            <tr  style="height: 20px;"><td style="height: 40px;">
                            <?php 
                                extract($_GET);//$wrongPass
                                if(isset($wrongPass)&&$wrongPass==1){
                                    echo"<span style=' color: red; font-size:15px; '>* Wrong username or password.</span>";
                                }
                            ?>
                                    </td></tr>
                            <tr style="height: 30px; color: tomato; "><td style="border-top: 1px dashed white;">Don't have an account? </td></tr> 
                            <tr><td><input type="button" id="signupbuton" value="Sign up" onClick="window.open('SignUpPage.php','sdvwsv','resizable=0,width=450,height=350');"></td></tr> 
                        </table>
                </td>
            <tr>
        </form>
    </body>
</html>
