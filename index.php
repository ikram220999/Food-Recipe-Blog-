<!DOCTYPE html>
<html lang="en">
<head>
<title>Cookhouse</title>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="img/cookbook.png" type="image/gif">
<link rel="stylesheet" href="css/index.css" type="text/css" media="screen">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">



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
              <!--<li><form action="search_result.php" method="post">
                <input class="search-recipe" type="text" name="recipe_search" placeholder="Search recipe here.." required>
                <button class="search-btn" name="submit" id="submit">Search</button>
              </form></i> -->
     
              <li><a href="login.html" class="login-btn">Login</a></li>
            </ul>
          </div>
      </div>
      <br><br><br><br><br>
      <?php
      include("dbconnect.php");

      if($conn)
      {
                        $sql2 = "SELECT COUNT(recipe_id) AS recipe_count FROM recipe ";
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


                        $sql3 = "SELECT COUNT(user_id) AS user_count FROM user ";
                        $result3 = mysqli_query($conn,$sql3);
                              if(mysqli_num_rows($result3))
                              {
                                while ($row3 = mysqli_fetch_array($result3)) 
                                {
                                  
                                  $ucount = $row3['user_count'];
                                }
                                  
                              }
                              else
                              {
                                $ucount = 0;
                              }
        }



      ?>

      <div class="content">
        <div class="kata">
          <h1>Become a power chef</h1>
          <p>Find your cooking idea or share yours here.</p><br><br>
          <div class="abox">
            <div class="abox1">
              <center><p>RECIPE<br>CREATED</p><center><br>
               <center><h1><?php echo $count ?></h1></center>

            </div>
            <div class="abox2">
              <center><p>TOTAL<br>USER</p><center><br>
               <center><h1><?php echo $ucount ?></h1></center>
             </div>
          </div>
        </div>
        <br>
        <div>

          <br><a href="signup.html"><button class="signup-btn">Join CookBook <i style='font-size:24px; padding: 0; margin: 0; margin-left: 5px;' class='fa'>&#xf101;</i></button></a>
        </div>

        <div class="food-img">

        </div>

      </div>
      <div class="bef-line"></div>
      <center><div class="line">
        <BR><BR><br><br><Br>
          <div><h2 style="color: white;">ABOUT COOKBOOK</h2></div>
          <br><br><p style="
          margin: auto;width: 800px; font-size: 20px;text-align: center; color: white; border-bottom: 2px solid #f5f5f5; border-top: 2px solid #f5f5f5; padding-bottom: 50px; padding-top: 50px;"><i> " CookBook is a web-based application technology that been developed to help people with a cook passion to share their ideas of cook in a right platform. The user will get a good target audience to view their recipe. This application also aim for easier the process of the people to find the recipe they want. " </i></p>
      </div><br><br>
        <div><h2>OUR OBJECTIVES</h2></div>
      <div class="content2">
        <br><br>
        <table  class="tbl1">
          <tr>
            <td style="text-align: center;"><img class="benefit-img" src="img/1.jpg"></td>
            <td><img class="benefit-img" src="img/2.PNG"></td>
            <td><img class="benefit-img" src="img/3.PNG"></td>
          </tr>
          <tr>
            <td>Follow people and also gain new follower to increase your daily recipe selection.</td>
            <td><br>Its time to change from write to type all your recipe. Also give a chance to other people to explore into your digital cookbook here</td>
            <td>Wasting time to flip the pages of old cookbook? Fix it here by searching for the recipe you want.</td>
          </tr>


        </table>
       </center>
       


        
      </div>
      <div class="devel">
        <center><BR><BR><BR>
        <h2 style="margin: auto; color: white;">DEVELOPER</h2>
        <br><br>
        <div style="margin: auto; width: 200px;"><img src="img/8.jpg"></div><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>
        <h3 style="color: white; letter-spacing: 1px;">MUHAMMAD IKRAM BIN AZHAR</h3><BR>
        <h4 style="color: white;"><I>BACHELOR OF INFORMATION TECHNOLOGY</I></h4></center><BR><BR><BR>
      </div><br><br>

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
                <a class="foot-med2" href="contact.html" >Contact</a>
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
              <p>Developed by Ikram 2021</p>  
      </center>
      </div>
      
</div>

 
    




    


<!--==============================footer=================================-->
<footer>
  
</footer>
</body>

