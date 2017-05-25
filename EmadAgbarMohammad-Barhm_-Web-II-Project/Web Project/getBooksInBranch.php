<?php
        
            extract($_GET);// $sid
            include 'connect.php';
            //$dbObj = new DB();
           
          
            $sql1="select * from books k , branch_has b where b.sid =$sid and k.bid=b.bid";
           
            $result1 = $dbObj->query($sql1);
            
            $numberOfBooks=$dbObj->getNumberOfRows($result1);
            if($numberOfBooks !=0){
                $x=$numberOfBooks/5;
                for($i=0;$i<$x;$i++){
                        echo "<tr>\n";
                        for($j=0;$j<5;$j++){
                            if(!$book=$dbObj->getAssoc($result1))break;
                            echo "<td><table id='product'>\n";
                            echo"<tr><td colspan='2' style='font-weight: bold; height:40px;'>{$book['bname']}</td></tr>\n";
                            $bookk=stripslashes($book['bname']);
                            echo"<tr><td colspan='2'><div id='picture'><img src='books/$bookk.jpg'>  </div></td></tr>\n";

                            echo"<tr><td colspan='2'>{$book['author']}</td></tr>\n";
                            echo"<tr><td colspan='2'>{$book['year']}</td></tr>\n";
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
                            echo"</table></td>\n";

                        }
                        echo "</tr>\n\n";
                    }
            }
            else {
                echo"<tr><td style='color:red; font-size:20px;font-weight:bold;'>There are no books in this branch.</td></tr>";
            }
        ?>
s