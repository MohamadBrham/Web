<?php
    extract($_GET); //$sid
    include"connect.php";
   
?>

<html>
    <head>
        <title>BookStore - Add Branch</title>
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
                text-align: center;
            }
            #form td{
                height: 50px;
            }
            
            .a{
              width: 100px;
              height: 40px;
            }
            .b{
                height: 40px;
            }
           
            table,td,th{
                //border: 1px solid white;
            }
            
        </style>
        <script>
        function addBranch(){            
            sid = $("#Bid").val(); 
            BName =$("#BName").val();
            BManager = $("#BManager").val();
            Location = $("#BLocation").val();
            if(BName =="" || Location == "" ){
                        $("#result").css("color","red");
                        $("#result").html("Fill all the Fields :( ");
            }else{                    
                $.get("editBranchRedirection.php",{ sid:sid , name : BName , manager : BManager ,location:Location}, function(result){
                    if(result==='1'){
                        $("#result").css("color","greenyellow");
                        $("#result").html(name + "Branch Edited Correctly :) ");
                        $("#Bid").val(sid);     
                        $("#BName").val(BName);
                        $("#BManager").val(BManager);
                        $("#BLocation").val(Location);
                    }
                    else{
                        $("#result").css("color","red");
                        $("#result").html("Failed editing Branch");
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
            <tr><th colspan="4" style="height: 40px; background-color: rgba(255,255,0,0.5); font-size: 30px; font-weight: bold"> Edit a Branch</th></tr>
            <tr><th colspan="4" id="result" style="height: 30px;  font-size: 24px; font-weight: bold ; color: greenyellow"> </th></tr>
            <tr>
                <td>Branch ID : </td><td><input type="text" id="Bid" class="a" disabled="" value="<?php
                if(isset($sid)){
                    $sql = "select * from store_branch where sid = $sid ";
                    $res = $dbObj->query($sql);
                    $BranchInfo = $dbObj->getArray($res);
                    echo $BranchInfo[0];
                    
                }
                ?>"></td>
                <td >Branch Name : </td><td><input id="BName" type="text" class="b" value="<?php
                if(isset($sid)){                   
                    echo $BranchInfo[1];                    
                }
                ?>"></td>
            </tr>
            <tr>
                <td>Branch's Manager : </td>
                <td><select id='BManager' class='a' style="width: 150px">
                      
                <?php
                         
                $sql = "select * from users where type='manager'";
                $result = $dbObj->query($sql);
                        

               while ($ro = $dbObj->getAssoc($result)) {
                        if(isset($sid) && $ro["uid"] == $BranchInfo[2] ){
                            echo "<option  selected value='{$ro['uid']}'>{$ro['name']}</option>";
                        }else {
                           echo "<option   value='{$ro['uid']}'>{$ro['name']}</option>"; 
                        }    
               }
                ?>
                  </select></td>     
                    
                  <td>Location : </td><td><input id="BLocation" type="text" class="b" value="<?php
                if(isset($sid)){                   
                    echo $BranchInfo[3];                    
                }
                ?>"></td>
            </tr>
            <tr>
                <td colspan="4"><input type="button" onclick="addBranch()" id="addBranch" value="Edit" style="height: 100%; width:400px ; font-size: 30px; font-weight: bold"></td>
            </tr>
        </table>
        
          
    </body>
</html>
