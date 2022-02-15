
<!DOCTYPE html>
<?php

session_start();
include("dbconnect.php");


if(isset($_SESSION['username']))
{
    $current_user = $_SESSION['username'];
    $username = $_GET['username'];
    $_SESSION['userview'] = $username;

    
    if(isset($_GET['recipe']))
    {
    $_SESSION['recipeid2'] = $_GET['recipe'];
    $recipeid = $_SESSION['recipeid2'];
    
    }

    if(isset($_SESSION['username-temp']))
    {
      $username = $_SESSION['username-temp'];
    }

    if($conn)
    {
      
      ?>

      	
          <html lang="en">
          <head>
          <title>Cookhouse</title>
          <meta charset="utf-8">

          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="icon" href="img/cookbook.png" type="image/gif">
          <link rel="stylesheet" href="css/user_view.css" type="text/css" media="screen">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          
			<script src="js/jquery-3.6.0.min.js"></script>



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
                        <li><a href="homeuser.php" class="active"><i class="fa fa-home" style="padding: 0; padding-right: 5px;"></i>Home</a></li>
                        <li><a href="search_result.php"><i class="fa fa-search" style="padding: 0; padding-right: 5px;"></i>Browse</a></li>
                        <!--<form method="post" action="search_result.php">
                            <li><input class="input_search" type="text" name="recipe_search" placeholder="Search"><button class="search-btn" type="submit" name="submit">Search</button></li>
                        </form> -->
                        
                        <li><a href="collection.php"></i>Collection</a></li>
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
                <br><br><br><br><br><br><br>
            
                 
                <div class="content">
                	       <div class="cont-grid">
                    <div class="recommend">
                      <center>
                      
                      <h2 class="cat"><?php echo "<i style='color: white;'>".$username."</i>"; ?> 's Profile</h2>
                      <div class="profiluser">
                      	<?php

                      	$sql2 = "SELECT * FROM user WHERE username = '".$username."' ";
                      	$result2 = mysqli_query($conn,$sql2);
                        if(mysqli_num_rows($result2))
                        {
                          while($row2 = mysqli_fetch_array($result2))
                          { 
                          		?>
                          		<br>
                          		<table class="table123">
                          			<tr>
                          				<td rowspan="4" style="padding-right: 20px; font-weight: 550;"><img src="<?php echo $row2['user_img']; ?>" ></td>
                          				<td style=" margin-left: 20px;padding-left: 10px; padding-right: 10px; max-width: 400px;"><?php echo $row2['user_fullname']; ?></td>
                          			</tr>
                                <tr>
                                  
                                  <td style=" margin-left: 20px;padding-left: 10px; padding-right: 10px; max-width: 400px;"><?php echo $row2['user_email']; ?></td>
                                  <td style="padding-left: 10px; padding-right: 10px;"><strong>RECIPE</strong></td><td style="padding-left: 10px; padding-right: 10px;"><strong>FOLLOWER</strong></td>

                                </tr>
                                <tr>
                                  
                                  <td style=" margin-left: 20px; padding-left: 10px; padding-right: 10px; max-width: 400px;"><?php echo $row2['user_phone']; ?>
                                    

                                  </td>
                                  
                                    <?php
                                    $sql6 = "SELECT COUNT(*) AS recipecount FROM recipe WHERE recipe_owner = '".$username."' ";
                              $result6 = mysqli_query($conn,$sql6);
                              if(mysqli_num_rows($result6))
                              {
                                while ($row6 = mysqli_fetch_array($result6)) 
                                {
                                    
                                    echo "<td style='font-size: 30px; font-weight: 600; text-align: center;'>".$row6['recipecount']."</td>";
                                }
                                  
                              }
                              else
                              {
                                  echo "<td style='font-size: 30px; font-weight: 600; text-align: center;'>0</td>";
                              }


                                    ?>


                                  
                                  
                                    <?php

                                    
                                    $sql100 = "SELECT COUNT(*) AS follower FROM followuser WHERE userfollowed = '".$username."' ";
                              $result100 = mysqli_query($conn,$sql100);
                              if(mysqli_num_rows($result100))
                              {
                                while ($row100 = mysqli_fetch_array($result100)) 
                                {
                                  
                                    echo "<td style='font-size: 30px; font-weight: 600; text-align: center;'>".$row100['follower']."</td>";
                                }
                                  
                              }
                              else
                              {
                                  echo "<td style='font-size: 30px; font-weight: 600; text-align: center;'>0</td>";
                              }




                                  


                                    ?>
                                  
                                  

                                </tr>
                                <tr>
                                  
                                  <td style="margin-left: 20px; padding-left: 10px; padding-right: 10px; max-width: 400px;"><i>' <?php echo $row2['user_desc']; ?>'</i></td>
                                </tr>


                          		</table><br><br>
                              <form method='post' action='follow.php'>
                          
                        <?php
                        $sql7 = "SELECT * FROM followuser WHERE userfollowing = '".$current_user."' and userfollowed = '".$username."'";
                          $result7 = mysqli_query($conn,$sql7);
                          if(mysqli_num_rows($result7) > 0)
                          {
                            echo "<input type='hidden' name='followinguser' value='".$current_user."'>";
                              echo "<input type='hidden'name='followeduser' value='".$username."'>";
                            echo "<button id='unfollow' value='unfollow' name='unfollowview' class='unfollowuser'> Unfollow";
                            echo "</button>";
                          }
                          else
                          {
                            if($current_user != $username )
                            {
                              echo "<input type='hidden' name='followinguser' value='".$current_user."'>";
                              echo "<input type='hidden'name='followeduser' value='".$username."'>";
                              echo "<button type='submit' name='followview' class='followuser' >";
                              echo "<a class='fol'> Follow</a>";
                             echo "</button>";
                            
                            }
                          }

                        ?>
                        </form>

                        <br>


                          		<?php
                          }

                      	}



                      	?>
                      	<div class="bot-div"></div>
                      </div>
                  	</center>
                    </div>
                    <div class="filter">
                      
                      <input class="srch-col" type="text" name="search" id="search-col" placeholder="Search <?php echo $username; ?>'s recipe ..">
                      
               
  
                              <select class="filter-drp" name="filter" id="filval"><i class="fa fa-angle-down"></i>
                             
                                  <option value="" disabled="" selected="">Select Filter</option>
                                  <option  value="recipe_name">Name</option>
                                  <option  value="recipe_datetime">Newest date</option>
                                  <option  value="recipe_datetime DESC">Oldest date date</option>
                                  <option  value="recipe_time">Time to prepare</option>
                               </select>
                             
                      
                        

                      
            
                    </div>
                  <script type="text/javascript">
                  $(document).ready(function(){
                    $("#filval").on('change',function(){
                      var value = $(this).val();
                      var username = '<?php $username ?>';
                     // alert(value);

                      $.ajax({
                        url:"fetchviewuser.php",
                        type:"POST",
                        data:'request=' + value,

                        beforeSend:function(){
                         $(".result2").html("<div><img src='img/loading.gif'></div>");
                        },
                        success:function(data){
                         $(".result2").html(data);
                        }
                      });
                    });

                  });

                  $(document).ready(function(){
                    $("#search-col").on('keyup',function(){
                      var value = $(this).val();
                     // alert(value);

                      $.ajax({
                        url:"fetchviewuser.php",
                        type:"POST",
                        data:'request2=' + value,
                        beforeSend:function(){
                         $(".result2").html("<div><img src='img/loading.gif'></div>");
                        },
                        success:function(data){
                         $(".result2").html(data);
                        }
                      });
                    });

                  });
                </script>

                  <div class="result1">
                    
                    <div class="result2">
                      
                      <?php

                      $sql= "SELECT * FROM `recipe` WHERE recipe_owner='".$username."'";

                
                      

                        $result = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result) > 0)
                        {
                          while($row = mysqli_fetch_array($result))
                          { 
                             echo "<div class='box2'>";

                             echo "<div class='box2-grid'> ";

                             echo "<div class='box2-left'>";
                             echo "<img class='food_img' src='".$row['recipe_img']."' alt= 'Image'  >";
                             echo "</div>"; #box2-left


                             $recipe_id = $row['recipe_id'];
                             
                             echo "<div class='box2-title'>";
                              echo "<h3><a class='recname'>".$row['recipe_name']."</a></h3>";
                             echo "</div>"; #box2-title

                             echo "<div class='box2-right'>";
                            


                             echo "<div>";

                             echo "<form method='post' action='viewrecipe.php'>";
                             
                             echo "<button class='view-btn' type='submit' name='view' id='view' value='".$recipe_id."'>View</button>";
                             echo "</div>"; #recipe-save and view
                             echo "</form>";
                           
                             
                             echo "</div>"; #box2-right

                             echo "</div>"; #box2-grid
                            
                         

                             echo "</div>"; #box2

                          }

                        }
                        else
                        {
                          ?>
                          <div class="no-rec">
                              <i class="material-icons" style="font-size: 50px; margin-top: 100px;">&#xeb44;</i><br><br>
                              <h3>This user have no recipe for now :(</h3>
                              <div style="margin: auto; margin-top: 10px;width: 25%; border: 1px solid #f5f5f5;" ></div>
                          </div>

                          <?php
                        }





                      ?>
            
                    </div><br>
                  </div>

                  <script>
                  
                  </script>
                  
                  </div>
                </div>
                <br>

              

 <?php

               include('chat.php');


               ?>
                         </div>
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
                        <p>CookBook © 2021. All rights reserved.</p>  
                </center>
                </div>
           
            
              


          <!--==============================footer=================================-->
          <footer>
            
          </footer>
          </body>



      <?php
     
    }

}


?>