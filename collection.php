<?php
session_start();
include("dbconnect.php");

if(isset($_SESSION['username']))
{
    $current_user = $_SESSION['username'];
    if(isset($_SESSION['submitsearch'])){
      unset($_SESSION['submitsearch']);
    }
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
          <link rel="stylesheet" href="css/collection.css" type="text/css" media="screen">
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
                        <!--<form method="post" action="search_result.php">
                            <li><input class="input_search" type="text" name="recipe_search" placeholder="Search"><button class="search-btn" type="submit" name="submit">Search</button></li>
                        </form> -->
                        <li><a href="homeuser.php"><i class="fa fa-home" style="padding: 0; padding-right: 5px;"></i>Home</a></li>
                        <li><a href="search_result.php"><i class="fa fa-search" style="padding: 0; padding-right: 5px;"></i>Browse</a></li>
                        <li><a href="" class="active">Collection</a></li>
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
            
            
                
                <div class="content">
                  <div class="cont-grid">
                    <div class="recommend">
                      <center>
                        <br>
                      <h2 class="cat">Recipe Collection</h2><br><br></center>
                    </div>
                    <div style="width: 100%; text-align: center;"><button class="col-rec actv" id="myrec" onclick="function1()">My Recipe</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="col-rec" id="savedrec" onclick="function2()">Saved Recipe</button></div>
                    <div id="myRecipe" class="myRecipe">
                    <div class="filter">
                      
                      <input class="srch-col" type="text" name="search" id="search-col" placeholder="Search by recipe name">
                      <a href="addnewrecipe.php" class="add-new-recipe-btn">+ Create new recipe</a>
               
  
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
                     // alert(value);

                      $.ajax({
                        url:"fetch.php",
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
                        url:"fetch.php",
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
                <script type="text/javascript">

                            
                  function function1() {
                          document.getElementById("myRecipe").style.display = "block";
                          document.getElementById("myrec").classList.add('actv');
                          document.getElementById("savedRecipe").style.display = "none";
                          document.getElementById("savedrec").classList.remove('actv');
                        }
                        function function2() {
                          document.getElementById("savedRecipe").style.display = "block";
                          
                          document.getElementById("savedrec").classList.add('actv');
                         document.getElementById("myRecipe").style.display = "none";
                          document.getElementById("myrec").classList.remove('actv');
                        }
                </script>

                  <div class="result1">
                    
                    <div class="result2">
                      
                      <?php
                      $rcount = 0;
                      $sql= "SELECT * FROM `recipe` WHERE recipe_owner='".$current_user."'";

                
                      

                        $result = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result))
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
                             ?>

                             <a href="editRecipe.php?recipeid=<?php echo "".$recipe_id."" ?>"><button class='save-btn' type='submit' name='save' id='save'>Edit</button></a>
                             <div style="height: 10px;"></div>
                            <?php echo "<a onclick='javascript:confirmationDelete($(this));return false;' href='deleteRecipe.php?recipeid=".$recipe_id."'><button class='del-btn' type='submit' name='save' id='save'>Delete</button></a>"; 
                             ?>


                             <?php
                             echo "<form method='post' action='viewrecipe.php'>";
                             
                             echo "<button class='view-btn' type='submit' name='view' id='view' value='".$recipe_id."'>View</button>";
                             echo "</div>"; #recipe-save and view
                             echo "</form>";
                           
                             
                             echo "</div>"; #box2-right

                             echo "</div>"; #box2-grid
                            
                         

                             echo "</div>"; #box2
                             $rcount++;
                          }

                        }
                        if($rcount == 0){
                        ?>

                        <div style="color: grey; text-align: center; border: 2px dashed lightgrey; width: 400%; margin-left: 50px; margin-top: 50px;"><br><br><p>Start create your first recipe :)</p><br><br></div>
                          <?php
                        }




                      ?>
            
                    </div>
                  </div>
                </div>


                <div id="savedRecipe" class="savedRecipe" style="display: none;">
                  <div class="filter">
                      
                    
                      
               
                             
                      
                        

                      
            
                    </div>
                      <script type="text/javascript">
            

              
                </script>
                <div class="result1">
                    
                    <div class="result3" m>
                      
                      <?php
                      $rcount = 0;

                      $sql4 = "SELECT recipe_id FROM collection WHERE save_user='".$current_user."' ";
                      $result4 = mysqli_query($conn,$sql4);
                        if(mysqli_num_rows($result4))
                        {
                          while($row4 = mysqli_fetch_array($result4))
                          {
                      $sql= "SELECT * FROM `recipe` WHERE recipe_id='".$row4['recipe_id']."'";

                
                      

                        $result = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result))
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
                             ?>

                             <div style="height: 10px;"></div>
                            <?php 


                            echo "<a onclick='javascript:confirmationDelete($(this));return false;' href='removecolRecipe.php?recipeid=".$recipe_id."'><button class='del-btn' type='submit' name='save' id='save' style='background-color: #dd4b39;'>Remove</button></a>"; 
                             ?>


                             <?php
                             echo "<form method='post' action='viewrecipe.php'>";
                             
                             echo "<button class='view-btn' type='submit' name='view' id='view' value='".$recipe_id."'>View</button>";
                             echo "</div>"; #recipe-save and view
                             echo "</form>";
                           
                             
                             echo "</div>"; #box2-right

                             echo "</div>"; #box2-grid
                            
                         

                             echo "</div>"; #box2
                             $rcount++;
                          }

                        }
                      }
                    }
                        if($rcount == 0){
                        ?>

                        <div style="color: grey; text-align: center; border: 2px dashed lightgrey; width: 400%; margin-left: 50px; margin-top: 50px;"><br><br><p>Find and start save your first recipe :)</p><br><br></div>
                          <?php
                        }




                      ?>
            
                    </div>
                  </div>
                </div>

                  <script>
                  function confirmationDelete(anchor)
                  {
                     var conf = confirm('Are you sure want to delete this recipe?');
                     if(conf)
                        window.location=anchor.attr("href");
                  }

                  </script>
                  
                  </div>
                  
                  
                </div>
                 <?php

               include('chat.php');


               ?>

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

