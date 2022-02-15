<?php
session_start();
include("dbconnect.php");

if(isset($_SESSION['username']))
{
    $current_user = $_SESSION['username'];
    if(isset($_SESSION['userview'])){
        unset($_SESSION['userview']);
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
          <link rel="stylesheet" href="css/tips.css" type="text/css" media="screen">
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
                        <li><a href="homeuser.php"><i class="fa fa-home" style="padding: 0; padding-right: 5px;"></i>Home</a></li>
                        <li><a href="search_result.php"><i class="fa fa-search" style="padding: 0; padding-right: 5px;"></i>Browse</a></li>
                       <!-- <form method="post" action="search_result.php">
                            <li><input class="input_search" type="text" name="recipe_search" placeholder="Search"><button class="search-btn" type="submit" name="submit">Search</button></li>
                        </form> -->
                        <li><a href="collection.php" >Collection</a></li>
                        <li><a href="tips.php" class="active"><i style="padding:0; padding-right: 5px; margin: 0;" class="fa">&#xf0eb;</i>Tips</a></li>
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
                                <center>
                              <button class="create" style="text-decoration: none; color: black;" onclick="document.getElementById('id02').style.display='block'"> + Create tips </button></center>
                              <div id="id02" >
                                  <span onclick="document.getElementById('id02').style.display='none'"><i style="font-size:20px; position: absolute; margin-left: 350px; margin-top: -5px; cursor: pointer; color: grey;" class="fa">&#xf00d;</i></span>
            <br>
                                  <h4>Create and share new tips</h4><br>
                                  <div style="width: 90%; border: 1px solid orange; margin: auto;"></div><br>
                                  <input type="radio" id="cate" name="cat" value="1">
                                <label for="cat1">Cooking</label>&nbsp;&nbsp;&nbsp;
                                <input type="radio" id="cate" name="cat" value="2">
                                <label for="cat2">Equipment</label><br>  <br>
                                
                                  <input style="width: 80%; margin: auto;margin-bottom: 15px; padding-top: 8px; padding-bottom: 8px; padding-left: 20px; padding-right: 20px; font-size: 15px; border-radius: 10px; border: 1px solid grey;" type="text" name="title" id="title" placeholder="Tips title ..">
                                   <textarea style=" min-height: 130px; max-height: 130px; mid-width: 80%; max-width: 80%;width: 80%; margin: auto; padding-top: 8px; padding-bottom: 8px; padding-left: 20px; padding-right: 20px; font-size: 15px; border-radius: 10px; border: 1px solid grey;" type="text" name="point" id="point" placeholder="Your tips .."></textarea>
                                              <button type="submit" id="submitbtn2" style="padding-right: 15px; padding-left: 15px; padding-bottom: 8px; padding-top: 8px; font-size: 15px; border-radius: 5px; border: 0px; background-color: orange; color: white; cursor: pointer; margin-top: 12px; margin-left: 600px;">Send</button>

                              </div>
                              <script type="text/javascript">
                                $(document).ready(function(){
                                        $('#submitbtn2').click(function(){
                                           
                                                var cate = $("input[name='cat']:checked").val();
                                            
                                            
                                          var title = $('#title').val();
                                          var point = $('#point').val();
                                          if($.trim(point) != '')
                                          {
                                            $.ajax({
                                              url:"submitTips.php",
                                              method:"POST",
                                              data:{cate:cate,title:title,point:point},
                                              dataType:"text",
                                              success:function(data)
                                              {
                                                alert("Feedback sent !");
                                                $('#cate').val("");
                                                $('#title').val("");
                                                $('#point').val("");
                                                 $('#result_recipe').html(div);
                                              }
                                            });
                                          }
                                        }); 
                    
                                      
                                      });
                              </script>
                              <div class="item">
                                                                  <a href="tips.php?my=<?php echo 1; ?>" class="sub-btn"> My tips </a>
                                <a class="sub-btn"><i class="fa fa-reorder" style="padding: 0; margin-top: 0px; margin-left: 0px; margin-bottom: 0px;"></i> Category <i style='font-size:24px; padding: 0; margin: 0; margin-left: 70px;' class='fa'>&#xf101;</i></a>
                                <div class="sub-menu">
                                  <?php

                      $sql20 = "SELECT * FROM tips_category";
                      $result20 = mysqli_query($conn,$sql20);
                      if(mysqli_num_rows($result20))
                      {
                        while($row20 = mysqli_fetch_array($result20))
                        { 
                    ?>

                                    <a href="tips.php?category=<?php echo $row20['id']; ?>" class="sub-item"><?php echo $row20['name'];?></a>
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
                     
        
                        <input class="search-input" type="text" name="search-rec" id="searchinput" placeholder="Search for any tips ? ">

                        <button type="submit" id="submit_search" class="submit-search" >Search</button>
                
                    
                   
                      </div>
                      <script type="text/javascript">
                        $(document).ready(function(){
                          $('#submit_search').click(function(){
                            var submitsearch = $('#searchinput').val();
                            if($.trim(submitsearch) != '')
                            {
                              $.ajax({
                                url: "searchtipsFetch.php",
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
                    <div id="canvas">
                      <div id="result_recipe" class="result-recipe">
                        <?php
                            if(!isset($_GET['my'])){
                            include("tips_result_fetch.php");
                            }
                            else
                            {
                             ?>
                             <div style="  overflow-y: scroll; height: 800px;">
                                 <?php
                                   function shorten($string, $length){
                                if(strlen($string)<=$length){
                                    echo $string;
                                }
                                else{
                                    $rec_desc = $string;
                                    $rec_desc_result = substr($rec_desc,0,$length). '... ';
                                    echo $rec_desc_result;
                                }
                             }
                                 $sql25 = "SELECT * FROM tips WHERE owner='".$current_user."' ";
                                 $result25 = mysqli_query($conn,$sql25);
                                if(mysqli_num_rows($result25))
                                {
                                    
                                  while($row25 = mysqli_fetch_array($result25))
                                  {
                                      
                                      ?>
                                      <div class='box2'>


                            

                             <?php  $tips_id = $row25['id'];   ?>


                             <div class='box2-right-wrapper'>

                             <div class='box2-title'>
                                <h3><?php echo "".$row25['title'].""; ?></h3>
                             </div> <!--box2-title-->

                             <div class='box2-desc'>
                                <i> <?php shorten($string=$row25['point'], 200); ?></i>
                             </div> <!--box2-title-->

                             <div style="font-size: 13px; color: grey; margin-left: 740px;">
                                 <i> <?php echo "".$row25['tdatetime'].""; ?></i>
                             </div>
                             <div style="font-size: 14px; color: grey; margin-left: 740px; margin-top: 10px;">
                                 &nbsp;&nbsp;&nbsp;&nbsp;
                                     <button onclick="document.getElementById('id03').style.display='block'" style="background-color: transparent; border: 0px; text-decoration: underline; color: blue; cursor: pointer;">Edit</button>&nbsp;&nbsp;
                                     <a href="deleteTips.php?tipsid=<?php echo $row25['id']; ?>" onclick="return confirm('Are you sure you want to delete this item?');" style="color: red;">Delete</a>
                                     
                                     
                                      <div id="id03" style="width: 600px; margin-left: -600px;">
                                  <span onclick="document.getElementById('id03').style.display='none'"><i style="font-size:20px; margin-top: -5px; cursor: pointer; color: grey;" class="fa">&#xf00d;</i></span>
                                  <br>
                                  <h4>Edit tips</h4><br>
                                  <div style="width: 90%; border: 1px solid orange; margin: auto;"></div><br>
                                  
                                
                                  <input style="width: 80%; margin: auto;margin-bottom: 15px; padding-top: 8px; padding-bottom: 8px; padding-left: 20px; padding-right: 20px; font-size: 15px; border-radius: 10px; border: 1px solid grey;" type="text" name="title" id="title" value="<?php echo $row25['title']; ?>">
                                   <textarea style=" min-height: 130px; max-height: 130px; mid-width: 80%; max-width: 80%;width: 80%; margin: auto; padding-top: 8px; padding-bottom: 8px; padding-left: 20px; padding-right: 20px; font-size: 15px; border-radius: 10px; border: 1px solid grey;" type="text" name="point" id="point" ><?php echo $row25['point']; ?></textarea>
                                              <button type="submit" id="submitbtn3" style="padding-right: 15px; padding-left: 15px; padding-bottom: 8px; padding-top: 8px; font-size: 15px; border-radius: 5px; border: 0px; background-color: orange; color: white; cursor: pointer; margin-top: 12px; margin-left: 600px;">Save</button>

                              </div>
                                    

                             </div>
                            

                             <div class='box2-right'>
                

                    
                          
                             
                             </div> <!--box2-right-->

                             </div> <!--box2-right-wrapper-->
                          
                             
                            
                         

                             </div> <!--box2-->
                                      
                                      
                                      
                                      
                                      <?php
                                      
                                      
                                      
                                  }
                                }
  
                                 ?>
                               
                                 
                             </div>
                             
                             
                             
                             <?php
                            }

                        ?>
                      <br>
                      </div>
                      
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

