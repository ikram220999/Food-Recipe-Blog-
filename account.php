<?php
session_start();
include("dbconnect.php");

if(isset($_SESSION['username']))
{
    $current_user = $_SESSION['username'];
    if(isset($_SESSION['userview'])){
        unset($_SESSION['userview']);
      }
      
       if(isset($_SESSION['submitsearch2'])){
      unset($_SESSION['submitsearch2']);
    }
    if($conn)
    {
    ?>
        <!DOCTYPE html>
          <html lang="en">
          <head>
          <title>Cookhouse</title>
          <meta charset="utf-8">

          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="icon" href="img/cookbook.png" type="image/gif">
          <link rel="stylesheet" href="css/account.css" type="text/css" media="screen">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
<!-- Hotjar Tracking Code for https://www.cookbook22.com -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:2768383,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>


          </head>
          <body>

            <!--==============================header=================================-->
              
           <div class="main">
                <div class="navbar">
                    <div class="icon">
                      <img class="logo" src="img/logo.png">
                    </div>

                    <div class="menu">
                      <ul>
                        <!--<form method="post" action="search_result.php">
                            <li><input class="input_search" type="text" name="recipe_search" placeholder="Search"><button class="search-btn" type="submit" name="submit">Search</button></li>
                        </form> -->
                        <li><a href="homeuser.php"><i class="fa fa-home" style="padding: 0; padding-right: 5px;"></i>Home</a></li>
                        <li><a href="search_result.php"><i class="fa fa-search" style="padding: 0; padding-right: 5px;"></i>Browse</a></li>
                        <li><a href="collection.php">Collection</a></li>
                        <li><a href="tips.php"><i style="padding:0; padding-right: 5px; margin: 0;" class="fa">&#xf0eb;</i>Tips</a></li>
                        
                        <li><div class="dropdown">
                              <button class="dropbtn"><?php echo $current_user; ?></button>
                              <div class="dropdown-content">
                                <a href="account.php">Account</a>
                                <a href="logout.php">Logout</a>
                              </div>
                            </div>
                        </li>
                      </ul>
                    </div>
                </div>
                <br><br><br><br><br>
            
                <br><br>
                <div class="content">
                <br><br>
                   


              <center>
                    <div class="recommend">
                      <br>
                      <div class="wrapper-prof">
                        <br>
                        <h2 class="cat">Account setting</h2><br>
                        <?php

                        $lol = "'";

                        $sql2 = "SELECT COUNT(recipe_id) AS recipe_count FROM recipe WHERE recipe_owner = '".$current_user."'";
                        $result2 = mysqli_query($conn,$sql2);
                              if(mysqli_num_rows($result2))
                              {
                                while ($row2 = mysqli_fetch_array($result2)) 
                                {
                                  
                                  $count = $row2['recipe_count'];
                                }
                                  
                              }
                              else
                              {
                                $count = 0;
                              }

                                 $sql100 = "SELECT COUNT(*) AS follower FROM followuser WHERE userfollowed = '".$current_user."' ";
                              $result100 = mysqli_query($conn,$sql100);
                              if(mysqli_num_rows($result100))
                              {
                                while ($row100 = mysqli_fetch_array($result100)) 
                                {
                                  
                                    $fcount = $row100['follower'];
                                }
                                  
                              }
                              else
                              {
                                  $fcount = 0;
                              }


                        $sql = "SELECT * FROM user WHERE username = '".$current_user."' LIMIT 1 ";
                          $result = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result))
                        {
                          while($row = mysqli_fetch_array($result))
                          { 
                            ?>
                            <table class="tbl2">
                              <tr>
                                <?php echo "<td rowspan='2'><img class='user-profile' src='".$row['user_img']."'><img class='pic-prof' src='img/84380.png' id='show-pic'></td>"; ?>
                                <td>Recipe created</td>
                                <td>Follower</td>
                              </tr>
                              <tr>
                                <td><h2><?php echo $count; ?></h2></td>
                                <td><h2><?php echo $fcount; ?></h2></td>
                               
                              </tr>
                            </table>
                            <br>
                            <table  class="user-det">
                              <tr>
                                <td><h4>Name : </h4></td>
                                <td colspan="2"><?php if(!empty($row['user_fullname'])){ echo " ".$row['user_fullname']." "; } else echo "<i>No data</i>"; ?></td>
                              </tr>
                              <tr>
                                <td><h4>Email : </h4></td>
                                <td colspan="2"><?php if(!empty($row['user_email'])){ echo " ".$row['user_email']." "; } else echo "<i>No data</i>"; ?></td>
                              </tr>
                              <tr>
                                <td><h4>Phone number : </h4></td>
                                <td colspan="2"><?php if(!empty($row['user_phone'])){ echo " ".$row['user_phone']." "; } else echo "<i>No data</i>"; ?></td>
                              </tr>
                              <tr>
                                <td><h4>Address : </h4></td>
                                <td colspan="2"><?php if(!empty($row['user_address'])){ echo " ".$row['user_address']." "; } else echo "<i>No data</i>"; ?></td>
                              </tr>
                              <tr>
                                <td><h4>Bio : </h4></td>
                                <td colspan="2"><i><?php if(!empty($row['user_desc'])){ echo " ".$row['user_desc']." "; } else echo "<i>No data</i>"; ?></i></td>
                              </tr>
                              <tr>
                                <td><h4>Telegram chat id : </h4></td>
                                <td><i><?php echo " ".$row['user_teleid']." ";  ?></i></td>
                                <td>    <div class="center">
                            <input type="checkbox" id="click">
                            <label for="click" class="sendtele-btn"><i class="fa fa-telegram" style="font-size:15px; padding: 0px; margin-top: 3px; margin-bottom: 3px; margin-left: 3px; margin-right: 3px;"></i> Update</label>
                            <div class="cont-tele">
                              <div class="header">
                                <h3>Update Telegram chat_id</h3>
                                <label for="click"><i class="fa fa-times" style="font-size:18px; padding: 0px; position: absolute; margin-top: -35px; margin-left: 520px; color: white; cursor: pointer;"></i></label>
                              </div><br>
                              <center>
                              <div style="width:1000px; display: grid; grid-template-columns: 480px 520px;">
                              <div style="padding-left: 40px; display: inline-block;">
                                <table class="startbot">
                                  <tr>
                                    <td><strong>Start cookbook22 bot</strong></td>
                                  </tr>
                                  <tr>
                                    <td><strong>1. </strong> Open telegram app and search for <strong>CookBook22</strong> bot</td>
                                  </tr>
                                  <tr>
                                    <td><img class="bot1" style="width: 80%;" src="img/bot1.PNG"></td>
                                  </tr>
                                  <tr>
                                    <td><strong>2. </strong> Open and start the bot. Done for frst step.</td>
                                  </tr>
                                  <tr>
                                    <td><strong>3. </strong> Copy the chat id given by the bot.</td>
                                  </tr>
                                  <tr>
                                    <td><img class="bot1" style="width: 80%;" src="img/bot4.PNG"></td>
                                  </tr>
                                  <tr>
                                    <td><strong>4. </strong> Enter the chat id in the empty box.</td>
                                  </tr>
                                  <form method="post" action="submitID.php">
                                    <tr>
                                      <td><input class="botid" type="text" id="telechatid" name="telechatid" placeholder="Enter ID here .." required></td>
                                    </tr>
                                </table>
                              </div>

                               
                              </div>
                              </center>
                              
                              <br>

                              <p class="small-note"><strong>Important note:</strong> Please make sure the <i>chat_id</i> entered is correct, otherwise you will not get expected result.</p>
                              <div class="tele-line"></div>
                              <Br><br><br><br>
                             
                                <button class="tele-sub-btn" type="submit" name="submit">Send</button>
                              </form>
                              <label for="click" class="close-btn">Close</label>
                            
                            </div>
                          </div></td>
                              </tr>
                            </table>

                            <div class="popup">
                              <form method="post" action="pic-update.php">
                                <table>
                                  <tr>
                                    <td><input type="radio" class="hidebx" name="profpic" id="1" value="1">
                                      <td><div class="display-box">
                                              <img class="picprof" src="img/bavt.png">
                                            </div>
                                          </label>
                                  </tr>
                                  <tr>
                                    <td><input type="radio" class="hidebx" name="profpic" id="1" value="2">
                                      <td><div class="display-box">
                                              <img class="picprof" src="img/avt3.png">
                                            </div>
                                          </label>
                                  </tr>
                                  <tr>
                                    <td><input type="radio" class="hidebx" name="profpic" id="1" value="3">
                                      <td><div class="display-box">
                                              <img class="picprof" src="img/gavt.png">
                                            </div>
                                          </label>
                                  </tr>
                                  <tr>
                                    <td><input type="radio" class="hidebx" name="profpic" id="1" value="4">
                                      <td><div class="display-box">
                                              <img class="picprof" src="img/avt4.png">
                                            </div>
                                          </label>
                                  </tr>
                                </table>
                                
                                <i class="fa fa-close" id="close-pic"></i>
                                <button type="submit" class="picsubmit" name="save-pic"><i class="fa fa-check" id="save-pic"></i></button><br>
                            </form>

                            <script type="text/javascript">
                        
                              document.querySelector('#show-pic').addEventListener("click",function(){
                                document.querySelector(".popup").classList.add("active");
                              })
                              document.querySelector('#close-pic').addEventListener("click",function(){
                                document.querySelector(".popup").classList.remove("active");
                              })
                              

                              
                            </script>
                             
                            </div>
                            <br>
                            
                            <input type="checkbox" id="click2">
                            <label for="click2" class="sendtele-btn2">Edit profile</label><br>
                            <div class="cont-editprof">
                              <div class="header2">
                                <h3>Edit profile detail</h3>
                                <label for="click2"><i class="fa fa-times" style="font-size:18px; padding: 0px; position: absolute; margin-top: -35px; margin-left: 240px; color: white; cursor: pointer;"></i></label>
                              </div><br>
                              <center>
                              <div style="width:1000px; display: grid; grid-template-columns: 480px 520px;">
                              <div style="padding-left: 40px; display: inline-block;">
                                <form method="post" action="submitEditProfile.php">
                                <?php  

                                  $sql3 = "SELECT * FROM user WHERE username = '".$current_user."'LIMIT 1";

                     
                          $result3 = mysqli_query($conn,$sql3);
                        if(mysqli_num_rows($result3))
                        {
                          while($row3 = mysqli_fetch_array($result3))
                          { 


                                ?>
                                <table class="detail-form">
                                  <tr>
                                    <td style="font-size: 13px; font-weight: 600; margin-top: 10px;" >Username:<br><input type="text" class="det-input" value="<?php echo $row3['username'] ?>" disabled></td>
                                    <td style="font-size: 13px; font-weight: 600; margin-top: 10px; margin-left: 20px;" >Password:<input type="text" class="det-input2" name="user-pass" value="<?php echo $row3['password'] ?>" ></ins></td>
                                  </tr>
                                  <tr>
                                    <td colspan="2" style="font-size: 13px; font-weight: 600; margin-top: 10px;" >Name: <input type="text" class="det-input" name="user-name" value="<?php echo $row3['user_fullname'] ?>" ></td>
                                  </tr>
                                  <tr>
                                    <td colspan="2" style="font-size: 13px; font-weight: 600; margin-top: 10px;" >Email: <input type="text" class="det-input" name="user-email" value="<?php echo $row3['user_email'] ?>"></td>
                                  </tr>
                                  <tr>
                                    <td colspan="2" style="font-size: 13px; font-weight: 600; margin-top: 10px;" >Phone: <input type="text" class="det-input" name="user-phone" value="<?php echo $row3['user_phone'] ?>"></td>
                                  </tr>
                                  <tr>
                                    <td colspan="2" style="font-size: 13px; font-weight: 600; margin-top: 10px;" >Address: <input type="text" class="det-input" name="user-addr" value="<?php echo $row3['user_address'] ?>"></td>
                                  </tr>
                                  <tr>
                                    <td colspan="2" style="font-size: 13px; font-weight: 600; margin-top: 10px;" >Bio: <input type="text" class="det-input" name="user-desc" value="<?php echo $row3['user_desc'] ?>"></td>
                                  </tr>
                                 
                                  
                                   
                                </table>
                              </div>

                              <?php

                                }
                              }



                              ?>


                               
                              </div>
                              </center>
                              
                              <br>

                             
                              <div class="tele-line"></div>
                              <Br><br><br><br>
                             
                                <button class="tele-sub-btn2" type="submit" name="submit">Save</button>
                              </form>
                              <label for="click2" class="close-btn">Close</label>
                            <br>
                            </div><br>
                          </div></td>
                           <br>
                            <br>
                            <?php

                          }
                        }


                        ?>
                      </div><br>
                    <br><br>
                    </div><br>
                  </div><br></center>
                  <div class="content2">
                    <Br>
                    <?php 
                    $count = 0;
                    $rec_id = array();
                    $rec_name = array();
                    $sql11 = "SELECT * FROM recipe WHERE recipe_owner = '".$current_user."' ";
                    $result11 = mysqli_query($conn,$sql11);
                        if(mysqli_num_rows($result11))
                        { $i = 0;
                          while($row11 = mysqli_fetch_array($result11))
                          {
                            $rec_id[$i] = $row11['recipe_id'];
                            $rec_name[$i] = $row11['recipe_name'];
                            $i++;
                          }

                          $length = count($rec_id);
                          for($u=0; $u<$length; $u++){
                            
                          }
                        }
                    ?>


                    
                    <div class="comm-act">
                     <div class="comment-sec">
                              <div class="lat-com">Latest comment</div>
                              <div class="lin2"></div>
                              <?php
                    
                    $sql10 = "SELECT * FROM recipe_comment ORDER BY datetime_comment DESC";
                    $result10 = mysqli_query($conn,$sql10);
                        if(mysqli_num_rows($result10))
                        { $i = 0;
                          $kambing = 0;
                          while($row10 = mysqli_fetch_array($result10))
                          {

                          $length2 = count($rec_id);
                              for($o=0; $o<$length2; $o++)
                              {
                                  if($row10['recipeid'] == $rec_id[$o])
                                  {
                                    if($count<5)
                                    {
                                    ?>

                                    <div class="comment-wrapper">
                                      <div class="profpic-box">
                                                <br>
                                                <div class="profpic-comment">
                                                  <?php

                                                    $sql12 = "SELECT * FROM user WHERE username = '".$row10['usercomment']."' ";
                                                    $result12 = mysqli_query($conn,$sql12);
                                                    if(mysqli_num_rows($result12) > 0 )
                                                    { 
                                                      while($row12 = mysqli_fetch_array($result12))
                                                      {
                                                          echo "<img class='profpic-small' src='".$row12['user_img']."'>";
                                                      }
                                                    }

                                                  ?>
                                                </div>
                                      </div>
                                      <div>
                                        <br>
                                        <div class="comm-user" style="font-size: 14px;">
                                          <strong><?php echo $row10['usercomment']; ?></strong> &nbsp;&nbsp;<i style="font-size:16px; padding: 0px; margin-top: 0px;" class="fa">&#xf0da;</i>&nbsp;&nbsp;    <?php echo $rec_name[$o]; ?>
                                        </div>
                                        <div class="user-comment">
                                            <?php echo $row10['comment_input'];  ?>
                                        </div>
                                        <div style="font-size: 12px; padding-top: 10px; padding-bottom: 10px; color: grey;">
                                            <i><?php echo $row10['datetime_comment'];  ?></i>
                                        </div>
                                      </div>
                                      <div style=" justify-content: center; text-align: center;">
                                        <form method='post' action='viewrecipe.php'>
                                            <button class='view-btn' type='submit' name='view' id='view' value='<?php echo "".$rec_id[$o].""; ?>'>View</button>
                                        </form>
                                      </div>
                                
                                    </div>


                                    <?php

                                    }#count
                                    $count++;
                                    $kambing++;
                                  } #if row10
                                  

                              } #for loop var o

                          } #while sql10

                          
                        } #if sql10
                         
                        if($kambing == 0 ){
                          ?>
                          <br>
                          <div style="color: grey; text-align: center; border: 2px dashed lightgrey; width: 90%; margin: auto;"><br><br><p>No comment yet :(</p><br><br></div>


                          <?php
                        }
                            

                    ?>
                              
                              <br>
                    </div>
                    <div class="lat-act">
                      
                      <div class="nf">New follower</div>
                      <div class="lin2"></div><Br>
                      <?php

                      $sql20 = "SELECT user.username, user.user_img,followuser.follow_datetime FROM user,followuser WHERE (followuser.userfollowed = '".$current_user."' AND user.username = followuser.userfollowing) ORDER BY followuser.follow_datetime DESC";
                      $result20 = mysqli_query($conn,$sql20);
                        if(mysqli_num_rows($result20) > 0 )
                        { $countfollower = 0;
                          while($row20 = mysqli_fetch_array($result20))
                          {
                            if ($countfollower < 7) {
                              ?>

                              <div class="followdiv">
                                <div> <img src="<?php echo $row20['user_img']; ?>" ></div>
                                <strong><p><?php echo $row20['username']; ?></p></strong>
                                <p style="font-size: 14px;">You have been followed by this user at <?php echo $row20['follow_datetime'];  ?></p>
                              </div>
                              <br>



                              <?php
                            }$countfollower++;
                          }

                        }
                        else
                        {
                          ?>

                          
                          <div style="color: grey; text-align: center; border: 2px dashed lightgrey; width: 90%; margin: auto;"><br><br><p>No new follower yet :(</p><br><br></div>

                          <?php
                        }


                      ?>
                    </div>
                  </div>
               <br>
                </div>
          
                  
                  <br>
                
                <br><br>
               <?php

               include('chat.php');


               ?>


                <div class="footer">
                  <div class="contfoot">

                      <div class="footleft">
                        <img class="img-foot" src="img/cookbook.png"><br><br><br><br>
                        <div class="foot-med">
                          <a href="#" class="fa fa-facebook"></a>
                          <a href="#" class="fa fa-twitter"></a>
                          <a href="#" class="fa fa-google"></a>
                          <a href="#" class="fa fa-linkedin"></a>
                          <a href="#" class="fa fa-youtube"></a>
                          
                        </div>

                      </div>

                      <div class="footmid">
                        <center>
                          <br><br>
                          <a class="foot-med2" href="#" >FAQs</a><br><br>
                          <a class="foot-med2" href="#" >Privacy & Terms</a><br><br>
                          <a class="foot-med2" href="contact.php">Contact</a>
                        </center>
                        
                      </div>

                      <div class="footright">
                        <center>
                          <br><br>
                          <h4>General</h4>
                          <div class="foot-med3"><i class="material-icons">&#xe0be;</i>&nbsp;&nbsp;&nbsp;muhdikram733@gmail.com</div><br><br>
                          <h4>Phone no.</h4> 
                          <div class="foot-med3"><i class="material-icons">&#xe551;</i>&nbsp;&nbsp;&nbsp;017-5845874</div><br><br>

                        </center>
                        
                      </div>
                      
                    
                  </div>
                  <center>
                        <br>
                        <p>Developed by Ikram , 2021</p>  
                </center>
                </div>
                
          </div>

           
              



<?php
           
              ?>
              


          <!--==============================footer=================================-->
          <footer>
            
          </footer>
          </body>
          <?php
    }
}
else 
{

?>

<?php

}


?>

