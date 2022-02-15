<?php
session_start();
include("dbconnect.php");

if(isset($_SESSION['username']))
{
    $current_user = $_SESSION['username'];

    if($conn)
    {
      ?>
        <!DOCTYPE html>
<html lang="en">
<head>
<title>Contact</title>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="img/cookbook.png" type="image/gif">
<link rel="stylesheet" href="css/contact.css" type="text/css" media="screen">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
          <script src="js/jquery-3.6.0.min.js"></script>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



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
      <br>
      <div class="content">
        <div class="kata">
          <center>
            <br><br>
            <h3>How we can help you ?</h3>
            <br><br>

            <h4>Office</h4><br>
            <p>No.11, Lorong Ara Indah 2/2,<br>
              Taman Ara indah,<br>
              13500 Permatang Pauh, <br>
              Pulau Pinang, Malaysia.</p>
            <br><br>
            <h4>E-mail</h4><br>
            <hp>muhdikram733@gmail.com</p><br><br>
            <h4>Telephone</h4><br>
            <p>+6017-584-5874</p>
            

          </center>
          
        </div>
  
        

        

      </div>
 <?php

               include('chat.php');


               ?>
      

          <div class="footer">
                  <div class="contfoot">

                      <div class="footleft">
                        <img class="img-foot" src="img/cookbook.png">
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
                          <a class="foot-med2" href="contact.php" >Contact</a>
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

 
    




    


<!--==============================footer=================================-->
<footer>
  
</footer>
</body>








      <?php
    }
}
else 
{



}


?>

