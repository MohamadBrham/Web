<?php
    extract($_GET);
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
            Bid = $("#Bid").val();     
            BName =$("#BName").val();
            BManager = $("#BManager").val();
            Location = $("#BLocation").val();
            $.get("addBranchRedirection.php",{id:Bid , name : BName , manager : BManager ,location:Location}, function(result){
                if(result==='1'){
                        $("#Bid").val(parseInt(Bid)+1);    
                        BName =$("#BName").val("");
                        BManager = $("#BManager").val("");
                        Location = $("#BLocation").val("");
                        alert("Branch has been added successfully");
                        location.reload();
                    }
                    else{
                        alert("Failed adding branch "+result)
                    }
                  });
            
            
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
            <tr><th colspan="4" style="height: 40px; background-color: rgba(255,255,0,0.5); font-size: 30px; font-weight: bold"> Add a Branch</th></tr>
            <tr>
                <td>Branch ID : </td><td><input type="text" id="Bid" class="a" disabled="" value="<?php
                //SELECT MAX(sid) FROM store_branch;
                $sql = "SELECT max(sid) from store_branch";
                $result = $dbObj->query($sql);
                $ro = $dbObj->getArray($result);
                $ro[0] = $ro[0] +1;
                echo "$ro[0]"  ;
                ?>"></td>
                <td >Branch Name : </td><td><input id="BName" type="text" class="b"></td>
            </tr>
            <tr>
                <td>Branch's Manager : </td>
                <td><select id='BManager' class='a' style="width: 150px">
                <?php
                         
                $sql = "select * from users where type='manager' and uid not in (select mid from store_branch)";
                $result = $dbObj->query($sql);
                $numOfRows=$dbObj->getNumberOfRows($result);
                if($numOfRows==0){
                    echo "<option disabled='true'>Add new manager</option>";
                }
                else {
                    while ($ro = $dbObj->getAssoc($result)) {                    
                             echo "<option  value='{$ro['uid']}'>{$ro['name']}</option>";
                    }
                }
                ?>
                  </select></td>     
                    
                  <td>Location : </td><td><input id="BLocation" type="text" class="b"></td>
            </tr>
            <tr>
                <td colspan="4"><input type="button" onclick="addBranch()" id="addBranch" value="Add" style="height: 100%; width:400px ; font-size: 30px; font-weight: bold"></td>
            </tr>
        </table>
        
          
    </body>
</html>
