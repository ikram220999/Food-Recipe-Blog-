<?php
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
//session_cache_limiter('public'); // works too
session_start();
include("dbconnect.php");

if(isset($_SESSION['username']))
{
    $current_user = $_SESSION['username'];
    if(isset($_POST['view']))
    {
    $_SESSION['recipeid'] = $_POST['view'];
    $recipeid = $_SESSION['recipeid'];
    }

    if (isset($_SESSION['recipeid2'])) {
      $recipeid =  $_SESSION['recipeid2'];
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
          <link rel="stylesheet" href="css/viewrecipe.css" type="text/css" media="screen">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        
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
                      <a href="homeuser.php"><img class="logo" src="img/logo.png"></a>
                    </div>

                    <div class="menu">
                      <ul>
                        <li><a href="homeuser.php"><i class="fa fa-home" style="padding: 0; padding-right: 5px;"></i>Home</a></li>
                        <li><a href="search_result.php"><i class="fa fa-search" style="padding: 0; padding-right: 5px;"></i>Search</a></li>
                        <!--<form method="post" action="search_result.php">
                            <li><input class="input_search" type="text" name="recipe_search" placeholder="Search"><button class="search-btn" type="submit" name="submit">Search</button></li>
                        </form> -->
                        
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
                <br><br><br><br><br><br>
            

                <div class="content">
                	<br>
                	<div class="cont-grid">
                		<div class="recipe-view">
                			<?php

                				  $sql = "SELECT * FROM recipe WHERE recipe_id = '".$_SESSION['recipeid']."' ";
                				  $result = mysqli_query($conn,$sql);
		                        if(mysqli_num_rows($result))
		                        {
		                          while($row = mysqli_fetch_array($result))
		                          { 

                                  $rec_owner = $row['recipe_owner'];
                                  $_SESSION['recipeowner'] = $rec_owner;


                			?>
                			<div class="inner-pic-det">
	                			<div class="rec-pic">
	                				<?php echo "<img class='rec-img' src='".$row['recipe_img']."'>"; ?>
	                			</div>
	                			<div class="rec-det">
	                				<center><br>
                        
                        <!--<form method="post" action="sendTele.php">-->
                          
                        <!--</form>-->
                          <div style="width: 100%;"><div style="font-size: 17px; color: grey; width: 15%; padding-top: 7px; padding-bottom: 5px; padding-right: 1px; padding-left: 1px; border: 0; border-radius: 5px; background-color: #f5f5f5; margin-left: 430px; margin-bottom: 10px;   box-shadow: 0px 3px 1px lightgrey;"><i style=" padding: 0px; margin: 0px;" class="fa">&#xf06e;</i> <?php echo $row['recipe_view']; ?></div></div>
	                				<div class="rec-name"><p><h1><?php echo "".$row['recipe_name'].""; ?></h1></p></div>
	                				<div class="rec-des"><p><i><?php echo "".$row['recipe_description'].""; ?></i></p></div>
	                				
	                				<div class="rec-time"><i class="fa fa-clock-o"></i><?php echo "".$row['recipe_time'].""; ?> minutes</div>
	                				
	                				<div class="rec-tag">
	                					<?php

	                					$sql2 = "SELECT category_id FROM recipe_category_branch WHERE rec_id = '".$_SESSION['recipeid']."' ";
	                					$result2 = mysqli_query($conn,$sql2);
		                        		if(mysqli_num_rows($result2))
		                        			{
		                          			while($row2 = mysqli_fetch_array($result2))
		                          				{ 	
		                          					$category = $row2['category_id'];
		                          					$sql3 = "SELECT catname FROM foodcategory WHERE catid = '".$category."' ";
	                								$result3 = mysqli_query($conn,$sql3);
		                        					if(mysqli_num_rows($result3))
		                        						{
		                          						while($row3 = mysqli_fetch_array($result3))
		                          							{
		                          								echo "<div class='tag'>".$row3['catname']."</div>&nbsp;&nbsp;";
                                              
		                          							}
		                          					 	}
		                          				}
		                          			}
	                					?>

	                				</div>
	                				
	                				</center>
                          <br>
	                			</div>

							</div>
							<div class="line"></div>
							<br>
							<div class="inner-ingr-step">
								<div class="ingr">
									<div class="ingr-title">
                    <center><p><h3>Ingredients</h3></p></center>
                  </div>
                  <Br>
									<div class="ingr2">

										<?php 

                      echo " ".nl2br($row['recipe_ingredient'])." ";
										

										?>


                  <br>
									</div>
									
								</div>
								<div class="step">
									<div class="step-title">
                    <center><p><h3>Steps</h3></p></center>
                  </div>
                  <Br>
                  <div class="step2">

                    <?php 

                      echo " ".nl2br($row['recipe_step'])." ";
                    

                    ?>
                  </div>
									
								</div>

							</div>
							<?php
								   }  
							    }
							

							?>
                		</div>
                    <?php

                    $sql4 = "SELECT * FROM user WHERE username = '".$_SESSION['recipeowner']."' ";
                    $result4 = mysqli_query($conn,$sql4);
                                if(mysqli_num_rows($result4))
                                  {
                                    while($row4 = mysqli_fetch_array($result4))
                                      { 
                                            $sql11 = "UPDATE recipe SET recipe_view=recipe_view+1 WHERE recipe_id='".$_SESSION['recipeid']."' ";
                                            if($current_user != $_SESSION['recipeowner']){
                                                mysqli_query($conn, $sql11);
                                            }

                                   

                    ?>
                		<div class="recipe-owner">
                			<div class="wrapper-acc">
                        <center>
                        <div class="prof-pic">
                          <?php echo "<img class='profpic' src=' ".$row4['user_img']."'>"; ?>
                        </div>
                        <p>
                          <?php

                            $sql5 = "SELECT online_status FROM user_online WHERE username='".$row4['username']."' ";
                            $result5 = mysqli_query($conn,$sql5);
                                if(mysqli_num_rows($result5))
                                  {
                                    while($row5 = mysqli_fetch_array($result5))
                                      { 
                                          if($row5['online_status'] == 1)
                                          {
                                              echo "<i class='fa fa-circle' style='font-size:13px; color:green; padding: 0px;'></i>online";
                                          }
                                          else
                                          {
                                              echo "<i class='fa fa-circle' style='font-size:13px; color:grey; padding: 0px;'></i>offline";
                                          }

                                      }
                                  }

                          ?>
                        </p>
                        <p><h3><?php echo "".$row4['username'].""; ?></h3></p>
                        <div class="bio"><p><i><?php echo "".$row4['user_desc'].""; ?></i></p></div>
                        <div class="wrapper-count-rat">
                          <div class="rec-count">
                            <h5>Recipe</h5>
                            <?php

                              $sql6 = "SELECT COUNT(*) AS recipecount FROM recipe WHERE recipe_owner = '".$row4['username']."' ";
                              $result6 = mysqli_query($conn,$sql6);
                              if(mysqli_num_rows($result6))
                              {
                                while ($row6 = mysqli_fetch_array($result6)) 
                                {
                                    
                                    echo "<div class='rec-ct'>".$row6['recipecount']."</div>";
                                }
                                  
                              }
                              else
                              {
                                  echo "0";
                              }

                            ?>
                          </div>
                          <div class="user-rat">
                            <h5>Follower</h5>
                            <?php

                              $sql100 = "SELECT COUNT(*) AS follower FROM followuser WHERE userfollowed = '".$row4['username']."' ";
                              $result100 = mysqli_query($conn,$sql100);
                              if(mysqli_num_rows($result100))
                              {
                                while ($row100 = mysqli_fetch_array($result100)) 
                                {
                                  
                                    echo "<div class='rec-ct'>".$row100['follower']."</div>";
                                }
                                  
                              }
                              else
                              {
                                  echo "0";
                              }

                            ?>
                          </div>

                        </div>
                        <div>
                        <form method='post' action='follow.php'>
                          
                        <?php
                        $sql7 = "SELECT * FROM followuser WHERE userfollowing = '".$current_user."' and userfollowed = '".$row4['username']."'";
                          $result7 = mysqli_query($conn,$sql7);
                          if(mysqli_num_rows($result7) > 0)
                          {
                            echo "<input type='hidden' name='followinguser' value='".$current_user."'>";
                              echo "<input type='hidden'name='followeduser' value='".$row4['username']."'>";
                            echo "<button id='unfollow' value='unfollow' name='unfollow' class='unfollowuser'> Unfollow";
                            echo "</button>";
                          }
                          else
                          {
                            if($current_user != $row4['username'] )
                            {
                              echo "<input type='hidden' name='followinguser' value='".$current_user."'>";
                              echo "<input type='hidden'name='followeduser' value='".$row4['username']."'>";
                              echo "<button type='submit' name='follow' class='followuser' >";
                              echo "<a class='fol'> Follow</a>";
                             echo "</button>";
                            
                            }
                          }

                        ?>
                        </form>
                        </div> 
                    
                      

                        <a style="text-decoration: none;" href="user_view.php?username=<?php echo $row4['username']; ?>&recipe=<?php echo $recipeid; ?>"><div class="viewuser" style="text-decoration: none;">
                          view
                        </div></a>

                      </center>
                      <br>
                      </div>
                      <center>
                        <br>
                        <center>
                         
                      <?php 

                        if($row4['username'] != $current_user){
                          $sql28 = " SELECT * FROM collection WHERE recipe_id='".$_SESSION['recipeid']."' AND save_user='".$current_user."' ";
                          $result28 = mysqli_query($conn,$sql28);
                          if(mysqli_num_rows($result28) == 0)
                          {

                      ?>

                      <div id="here" style="height: 100%;">
                        <div style="border: 1px dashed lightgrey; margin-left: : 10px; width: 105%; padding-left: 5px;"></div><br>
                          <input type="hidden" name="recipeid" id="recipeid" value="<?php echo $recipeid;  ?>">
                          <input type="hidden" name="recowner" id="recowner" value="<?php echo $row4['username'];  ?>">
                        <button type="submit" id="savetocol" class="savetocol"><i style=" padding: 0; margin: 0;" class="fa">&#xf097;</i><strong> Save to collection</strong></button>
                        <br><br>
                       
                        <div style="border: 1px dashed lightgrey; margin-left: : 10px; width: 105%; padding-left: 5px;"></div>
                      </div>

                      <?php
                        }
                      }


                      ?>


                      <br><br>
                    <form method="post" action="recipePDF.php">
                          <input type="hidden" name="recipeid" value="<?php echo $_SESSION['recipeid'];  ?>">
                          <div><button class="download-btn"><i class="fa fa-download" style=" padding: 0px; margin: 0px;"></i> Download</button></div>

                        </form><br>



                        <form method="post" action="printRecipe.php">
                          <input type="hidden" name="recipeid" value="<?php echo $_SESSION['recipeid'];  ?>">
                          <div><button class="print-btn"><i class="fa fa-print" style=" padding: 0px; margin: 0px;"></i> Print</button></div>
                          
                        </form>


                        <br><br>
                        <div class="center">
                            <input type="checkbox" id="click">
                            <label for="click" class="sendtele-btn"><i class="fa fa-telegram" style=" padding: 0px; margin: 0px;"></i> Send</label>
                            <div class="cont-tele">
                              <div class="header">
                                <h3>Send Recipe To Telegram</h3>
                                <label for="click"><i class="fa fa-times" style="font-size:18px; padding: 0px; position: absolute; margin-top: -35px; margin-left: 170px; color: white; cursor: pointer;"></i></label>
                              </div><br>
                              <label for="click"><i class="fa fa-check" style="font-size:50px; padding: 0px; color: #0088CC; width: 80px; height: 80px; border: 2px solid #0088CC; border-radius: 50%; text-align: center; padding-top: 15px; box-sizing: border-box;"></i></label>
                              <p>1. Kindly check for your telegram <i>chat_id</i> before send recipe.</p>
                              <p>2. If you not yet update your telegram <i>chat_id</i>, you can update at your <strong>Account</strong>. (Instruction given there)</p>
                              <p>3. If the <i>chat_id</i> has been updated, you can proceed to send this recipe as you wish</p><Br>

                              <p class="small-note">Important note: If the <i>chat_id</i> is wrong, the recipe will not sent succesfully to telegram.</p>
                              <div class="tele-line"></div>
                             <form method="post" action="sendTele.php">
                                <button class="tele-sub-btn">Send</button>
                              </form>
                              <label for="click" class="close-btn">Close</label>
                            </div>
                          </div>

                      </center>
                		</div>
                    <script type="text/javascript">
                  $(document).ready(function(){
                    $('#savetocol').click(function(){
                      var recipeid = $('#recipeid').val();
                      var recowner = $('#recowner').val();
                     
                        $.ajax({
                          url:"saveToCol.php",
                          method:"POST",
                          data:{recipeid:recipeid,recowner:recowner},
                          dataType:"text",
                          success:function(data)
                          {
                            alert("Saved recipe to collection :)");
                            setInterval(function(){
      $("#here").load(window.location.href + " #here" );
}, 500);
                          }


                        });
                      
                    }); 

                  
                  });


                </script>


                    <?php
                                      }
                                  }
                    ?>
                	
                	</div>

                  
                  <br><br>
                </div>
                <div class="wrapper-comment">
                  <Br>
                  <p class="feedback"><h3>Recipe feedback</h3></p><br>
                  <div class="comment">
        
                    <input class="comment-sec" type="text" name="comment" id="commentinput" placeholder="Comment .. ">
                    <button type="submit" id="submit_comment" class="submit-comment">Comment</button>
                
                    <br><Br><br>
                  </div>
                    <br>
                    <div id="load_comment" class="load-comment">
  
                    </div>
                    <br>
                </div>
                <script type="text/javascript">
                  $(document).ready(function(){
                    $('#submit_comment').click(function(){
                      var commentvar = $('#commentinput').val();
                      if($.trim(commentvar) != '')
                      {
                        $.ajax({
                          url:"insertcomment.php",
                          method:"POST",
                          data:{commentinput:commentvar},
                          dataType:"text",
                          success:function(data)
                          {
                            alert("Feedback sent !");
                            $('#commentinput').val("");
                          }
                        });
                      }
                    }); 

                    setInterval(function(){
                        $('#load_comment').load("comment.php").fadeIn("slow");
                    }, 3000);
                  });


                </script>
                 <?php

               include('chat.php');


               ?>
                <div class="footer">
                  <div class="contfoot">

                      <div class="footleft">
                        <img class="img-foot" src="img/cookbook.png"><br>
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
                        <p>CookBook © 2021. All rights reserved.</p>  
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


