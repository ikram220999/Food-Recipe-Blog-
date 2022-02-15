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
          <title>Cookhouse</title>
          <meta charset="utf-8">

          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="icon" href="img/cookbook.png" type="image/gif">
          <link rel="stylesheet" href="css/addnewrecipe.css" type="text/css" media="screen">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
          <script src="js/jquery-3.6.0.min.js"></script>
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
                      <img class="logo" src="img/logo.png">
                    </div>

                    <div class="menu">
                      <ul>
                       <!-- <form method="post" action="search_result.php">
                            <li><input class="input_search" type="text" name="recipe_search" placeholder="Search"><button class="search-btn" type="submit" name="submit">Search</button></li>
                        </form> -->
                        <li><a href="homeuser.php"><i class="fa fa-home" style="padding: 0; padding-right: 5px;"></i>Home</a></li>
                        <li><a href="search_result.php"><i class="fa fa-search" style="padding: 0; padding-right: 5px;"></i>Search</a></li>
                        <li><a href="collection.php">Collection</a></li>
                        
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
         
            

                <div class="content">
                  <div class="cont-grid">
                    <div class="recommend">
                      <center>
                        <br>
                      <h2 class="cat">Create new recipe</h2><br></center>
                    </div>
                 
                  <form name="form1" class="recipe-form" method="post" action="proc-addnewrecipe.php" enctype="multipart/form-data" >
                    <br>
                    <table class="tbl1">
                      <tr>
                        <td><h3>Title</h3></td>
                        <td rowspan="9">
                          <div class="container">
                            <div class="wrapper">
                              <div id="display-img" class="image2">
                                <img src="#" id="myImg" width="100" height="100" alt="">
                              </div>
                                <div class="content-upl">
                                  <div class="icon"><i class="fa fa-cloud-upload"></i></div>
                                  <div class="text">Upload Image</div>
                                </div>
                                <div id="cancel-btn"><i class="fa fa-times"></i></div>
                                <div class="file-name">File name here</div>
                             </div>  
                              <input id="uimage" name="uimage" type="file" accept="image/png, image/jpg" required>
                          </div>

                          <script>
                         

                            window.addEventListener('load', function() {
                            document.querySelector('input[type="file"]').addEventListener('change', function() {
                                  if (this.files && this.files[0]) {
                                      var img = document.querySelector('#myImg');
                                      img.onload = () => {
                                          URL.revokeObjectURL(img.src);  // no longer needed, free memory
                                      }

                                      img.src = URL.createObjectURL(this.files[0]); // set src to blob url
                                  }
                              });
                            });


                          </script>


                        </td>
                      </tr>
                      <tr>
                        <td><input class="rec-title" type="text" name="rec-title" placeholder="Title" required><br><br><br></td>
                      <tr>
                      <tr>
                        <td><h3>Description</h3></td>
                      <tr>
                      <tr>
                        <td><input class="rec-title" type="text" name="rec-des" placeholder="Recipe description .. " required><br><br><br></td>
                      </tr>

                      <tr>
                        <td><h3>Time to complete (minutes)</h3><br></td>
                      </tr>
                      <tr>
                        <td>
                        <center>
                        <div class="wrapper-slider">
                          <div class="slider">
                            <input type="range" name="rec-time" min="1" max="200" value="100" id="myRange" class="sliderr" required>
                          </div>
                          <span class="svalue" id="value"></span>
                        </div>
                      </center>
                    </td>
                    </tr>
                    </table>
                  <script>
                      var slider = document.getElementById("myRange");
                      var output = document.getElementById("value");

                      output.innerHTML = slider.value;

                      slider.oninput = function(){
                        output.innerHTML = this.value;
                      }
                    
                  </script>
                    <br>
                    <div><h3>Category</h3><br></div>
                    <div class="wrapper2">
                      
                      <center>
                      <div class="contain">
                  <?php


                          $result = mysqli_query($conn,"SELECT catname FROM foodcategory ORDER BY catname ASC");

                          $count = 1;

                          if(mysqli_num_rows($result))
                            {
                              while($row = mysqli_fetch_array($result))
                              { 
                                ?> 
                                     <label class="option_item">
                                      <input type="checkbox" class="checkbox1" name="catrec[]" value="<?php echo "".$count.""; ?>">
                                      <div class="option_inner">
                                        <div class="tickmark"></div>
                                        <div class="rec-cat"><?php echo "".$row['catname'].""; ?></div>
                                      </div>
                                      
                                    </label>

                                <?php
                                $count++;
                              }

                            }

                        ?>
                  

                    
                     
                      </div>
                      
                    </center>
                      


                    </div>
                    <br><br>
                    <center>
                      <table class="tbl2">
                        <tr>
                          <td align="left"><h3>Ingredients</h3><br></td>
                          <td align="left"><h3>Steps</h3><br></td>

                        </tr>
                        <tr>
                          <td><textarea class="rec-mats" id="ingr" name="rec-mats" placeholder="Please enter recipe ingredients here .." required></textarea></td>
                          <td><textarea class="rec-step" id="steps" name="rec-step" placeholder="Please enter recipe steps here .." required></textarea></td>
                        </tr>
                      </table>
                    </center>

                    <br><br><br>
               
                    

                    <button type="submit" name="submit" class="create-btn">Create</button>
                    <br><br><br>
                  </form>

                  <script type="text/javascript">
                   

                  </script>
                  <br><br>

                  </div>

                  
                  
                </div>
                <br><br>


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
                        <p>CookBook © 2021. All rights reserved.</p>  
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

?>

<?php

}


?>

