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
          <link rel="stylesheet" href="css/search_result.css" type="text/css" media="screen">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


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
                        <li><a href="search_result.php" class="active"><i class="fa fa-search" style="padding: 0; padding-right: 5px;"></i>Browse</a></li>
                       <!-- <form method="post" action="search_result.php">
                            <li><input class="input_search" type="text" name="recipe_search" placeholder="Search"><button class="search-btn" type="submit" name="submit">Search</button></li>
                        </form> -->
                        <li><a href="collection.php" >Collection</a></li>
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
            
                <br><br><br>
                <div class="content">
                  <div class="cont-grid">
                    
                          <div class="filter">
                            <div class="sidebar-menu">
                              <div class="item"><a href="search_result.php"></i> All</a></div>
                              <div class="item">
                                <a class="sub-btn"><i class="fa fa-reorder" style="padding: 0; margin-top: 0px; margin-left: 0px; margin-bottom: 0px;"></i> Category <i style='font-size:24px; padding: 0; margin: 0; margin-left: 70px;' class='fa'>&#xf101;</i></a>
                                <div class="sub-menu">
                                  <?php

                      $sql20 = "SELECT * FROM foodcategory";
                      $result20 = mysqli_query($conn,$sql20);
                      if(mysqli_num_rows($result20))
                      {
                        while($row20 = mysqli_fetch_array($result20))
                        { 
                    ?>

                                    <a href="search_result.php?category=<?php echo $row20['catid']; ?>" class="sub-item"><?php echo $row20['catname'];?></a>
                                   <?php

                          }
                        }

                            ?>
                                </div>
                              </div>
                              <!--<div class="item">
                                <a class="sub-btn"><i class="fa fa-clock-o" style="padding: 0; margin-top: 0px; margin-left: 0px; margin-bottom: 0px;"></i>Time<i class="fas fa-angle-right dropdown2" style="margin-left: 130px;"></i></a>
                                <div class="sub-menu">
                                    <a href="#" class="sub-item">Ikram</a>
                                    <a href="#" class="sub-item">muhammad</a>
                                    <a href="#" class="sub-item">ikram</a>
                                    <a href="#" class="sub-item">bin</a>
                                    <a href="#" class="sub-item">azhar</a>
                                  </div>
                              </div> -->

                            </div>


                    </div>
                    <script type="text/javascript">
                      $(document).ready(function(){
                        $('.sub-btn').click(function(){
                          $(this).next('.sub-menu').slideToggle();
                          $(this).find('.dropdown2').toggleClass('rotate');
                        });

                      });

                      
                    </script>

                    <div class="result">
                      
                      <div class="search-cont">
                     
        
                        <input class="search-input" type="text" name="search-rec" id="searchinput" placeholder="Search recipe by name .. ">

                        <button type="submit" id="submit_search" class="submit-search" >Search</button>
                
                    
                   
                      </div>
                      <script type="text/javascript">
                        $(document).ready(function(){
                          $('#submit_search').click(function(){
                            var submitsearch = $('#searchinput').val();
                            if($.trim(submitsearch) != '')
                            {
                              $.ajax({
                                url: "searchFetch.php",
                                method: "POST",
                                data:{submitsearch:submitsearch},
                                dataType:"text",
                                success:function(data)
                                {
                                  $('#result_recipe').html(data);
                                }
                              });
                            }
                          });
                        });

                      </script>

                      <div id="result_recipe" class="result-recipe">
                        <?php
                          
                            include("search_result_fetch.php");
                          

                        ?>
                      <br>
                      </div>
                      
                    </div>
                  </div>
                  
                  
                </div>
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


}


?>

