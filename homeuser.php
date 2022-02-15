<?php
session_start();
include("dbconnect.php");

if(isset($_SESSION['username']))
{
    $current_user = $_SESSION['username'];
    if(isset($_SESSION['submitsearch'])){
      unset($_SESSION['submitsearch']);
    }
    
    if(isset($_SESSION['submitsearch2'])){
      unset($_SESSION['submitsearch2']);
    }

    if(isset($_SESSION['userview'])){
        unset($_SESSION['userview']);
      }

    if(isset($_SESSION['username-temp']))
    {
      unset($_SESSION['username-temp']);
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
          <link rel="stylesheet" href="css/homeuser.css" type="text/css" media="screen">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   
			<script src="js/jquery-3.6.0.min.js"></script>
    
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
                    <div class="filter">
                      <br>
                      
                      
                      <h3 style="color:#dd7230;">Find other chef</h3>
                      <br>
                      <input type="text" class="user-search" id="search_user" name="user-search" placeholder="Search user .."><br>
                      
                      <div class="user-srh">
                        
                      </div>
                     
                    </div>
                    <script type="text/javascript">
                    $(document).ready(function(){
                    $("#search_user").on('keyup',function(){
                      var value = $(this).val();
                     // alert(value);

                     if (value == "") {
                        $(".user-srh").html("kambing");
                     }

                      $.ajax({
                        url:"searchuser.php",
                        type:"POST",
                        data:'request=' + value,
                        beforeSend:function(){
                         $(".user-srh").html("<br><div style='width=20%;'><img src='img/loading.gif' width='40' height='40'></div>");
                        },
                        success:function(data){
                         $(".user-srh").html(data);
                        }
                      });
                    });

                  });
                    </script>
                    <div class="no-data">
                      <div style="font-size: 18px; font-weight: 600; padding-top: 10px; padding-bottom: 10px; border-bottom: 2px dashed lightgrey; width: 90%; margin: auto;
                      " >User to follow</div>
                      <?php 
                        $dcount = 0;
                        $user = 0;
                        $sql2 = "SELECT * FROM user WHERE username != '".$current_user."' ORDER BY RAND() ";
                         $result2 = mysqli_query($conn,$sql2);
                              if(mysqli_num_rows($result2))
                              {
                                while ($row2 = mysqli_fetch_array($result2)) 
                                {

                                $sql5 = "SELECT * FROM followuser WHERE userfollowing= '".$current_user."' AND userfollowed = '".$row2['username']."' ";
                                $result5 = mysqli_query($conn,$sql5);

                                if(mysqli_num_rows($result5) == 0)
                                {

                                if($dcount < 4)
                                {

                                $sql3 = "SELECT COUNT(recipe_id) AS recipe_count FROM recipe WHERE recipe_owner = '".$row2['username']."'";
                                $result3 = mysqli_query($conn,$sql3);
                                if(mysqli_num_rows($result3))
                                {
                                  while ($row3 = mysqli_fetch_array($result3)) 
                                  {
                                    
                                    $count = $row3['recipe_count'];
                                  }
                                    
                                }
                                else
                                {
                                  $count = 0;
                                }


                              $sql100 = "SELECT COUNT(*) AS follower FROM followuser WHERE userfollowed = '".$row2['username']."' ";
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
                                    ?>

                                      <div class="usr">

                                          <div class="usr-img"><img src="<?php echo $row2['user_img']; ?>"></div>
                                          <h4><?php echo $row2['username']; ?></h4>
                                          <br>
                                          <div class="sd"><h5>Follower</h5><br>
                                              <p><?php echo $fcount; ?></p>
                                          </div>

                                          <div class="sd"><h5>Recipe</h5><br>
                                            <p><?php echo $count; ?></p>
                                          </div>
                                          <a href="user_view.php?username=<?php echo $row2['username']; ?>"><button class="vu">View Profile</button></a>
                                      </div>



                                    <?php
                                    $dcount++;
                                    $user++;
                                    }#if dcount
                                  }#if sql5
                                  

                                }
                              }#if sql2

                              if ($user == 0) {
                              
                                ?>

                                <div style="width: 90%; margin: auto; color: grey;"><br>Congratulations ! , You have followed all users :)<br><br></div>


                                <?php
                              }


                      ?>
                      
                    </div><br>
                  <div class="load-recipe">
                 
                    <div>
                      
                    </div>
                  
                  
                  </div>
                  <a href="#" class="to-top" style="color: white;">
                    <i class="fa fa-arrow-up" style="padding: 0; margin: 0; margin-left: -7px; margin-top: 2px;"></i>
                  </a>
                  <script type="text/javascript">
                    const toTop = document.querySelector(".to-top");

                    window.addEventListener("scroll", () =>{
                      if(window.pageYOffset > 100){
                        toTop.classList.add("active");
                      } else{
                        toTop.classList.remove("active");
                      }
                    })
                  </script>
                  <script type="text/javascript">
                    var start = 0;
                    var limit = 5;
                    var reachedMax = false;

                    function windowScroll(){
                      $(window).scroll(function(){
                      if($(window).scrollTop() == $(document).height() - $(window).height())
                        getData();
                    });
                    }

                  $(document).ready(function(){
                    getData();
                    windowScroll(); 

                    
                  });
                  
                  var count = 1;

                  function getData(){
                    if(reachedMax)
                      return;

                    $.ajax({
                      url: 'feed.php',
                      method: 'POST',
                      dataType: 'text',
                      data: {
                        getData: 1,
                        count: count,
                        start: start,
                        limit: limit
                      },
                      success: function(response){
                        if (response == "reachedMax")
                          reachedMax = true;
                        else{
                          count=count+1;
                          start+=limit;
                          $(".load-recipe").append(response);

                        }

                      }
                    });

                  }


                </script>
                  </div>
                  
           
                </div>

              

                
          </div>

           
          <?php

          include('chat.php');

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

