<?php
session_start();
include("dbconnect.php");

if(isset($_SESSION['username']))
{
    $current_user = $_SESSION['username'];
    if(isset($_SESSION['submitsearch'])){
      unset($_SESSION['submitsearch']);
    }

    if($conn)
    { 

      if (isset($_POST['getData'])) {
        $start = $_POST['start'];
         $limit = $_POST['limit'];
          

         $sql = "SELECT recipe_id, recipe_name, recipe_description, recipe_img, recipe_time, recipe_owner FROM recipe WHERE recipe_owner != '".$current_user."' ORDER BY recipe_datetime DESC LIMIT ".$start.",".$limit." ";
         $result = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result))
                        {
                            
                          $response="";
                     
                          while($row = mysqli_fetch_array($result))
                          { 
                            
                            $sql2 = "SELECT * FROM followuser WHERE userfollowed = '".$row['recipe_owner']."' AND userfollowing ='".$current_user."' ";
                            $result2 = mysqli_query($conn,$sql2);
                            if(mysqli_num_rows($result2) == 1)
                            { 
                             
                            $row2 = mysqli_fetch_array($result2);

                            $sql3 = "SELECT * FROM user WHERE username='".$row['recipe_owner']."' ";
                            $result3 = mysqli_query($conn,$sql3);
                            if(mysqli_num_rows($result3) > 0)
                            { 
                             
                            while($row3 = mysqli_fetch_array($result3))
                            {
                                $response .= "<div class='wrapper-box'>";
                                $response .= "<div class='acc-box2'>";
                                $response .= "<div class='acc-box'>";
                                $response .= "<div class='acc-img'><a href='user_view.php?username=".$row3['username']."'><img src='".$row3['user_img']."'></a></div>";
                                $response .= "<div class='usrnm'><strong>".$row3['username']."</strong> </div>";
                                
                           
                                $response .= "<form method='post' action='follow.php'>";
                                 
                                $response .=  "<input type='hidden' name='followinguser' value='".$current_user."'>";
                                $response .= "<input type='hidden' name='followeduser' value='".$row3['username']."'>";
                                $response .= "<br><div class='kambing'><button type='submit' name='follow_home' class='unfollowuser' ><a class='fol'> Unfollow</a></button></div>";
                                $response .= "</div>";
                                $response .= "</form>";
                                
                                
                                $response .= "</div>";
                                $response .= "<div class='box2-left'>";
                                $response .= "<div class='food-img'><img src='".$row['recipe_img']."'></div>";
                                $response .= "<div class='rname' style='margin-top: 10px; text-align=left; '><h2>".$row['recipe_name']."</h2></div>";
                                 $response .= "<br>";
                                 $response .= "<div class='rdes' style='margin-top: 10px; text-align=left; '>".$row['recipe_description']."</div>";
                                 $response .= "<br>";
                                
                                $response .= "<div class='rtime'><i class='fa fa-clock-o' style='padding: 0; margin: 0;'></i> ".$row['recipe_time']." Minutes</div>";
                                 $response .= "";
                                $response .= "<div class='rtag'>";

                                  $sql4 = "SELECT category_id FROM recipe_category_branch WHERE rec_id = '".$row['recipe_id']."' ";
                                  $result4 = mysqli_query($conn,$sql4);
                                  if(mysqli_num_rows($result4))
                                    {
                                      while($row4 = mysqli_fetch_array($result4))
                                        {   
                                          $category = $row4['category_id'];
                                          $sql5 = "SELECT catname FROM foodcategory WHERE catid = '".$category."' ";
                                          $result5 = mysqli_query($conn,$sql5);
                                        if(mysqli_num_rows($result5))
                                          {
                                            while($row5 = mysqli_fetch_array($result5))
                                              {
                                               $response .= "<div class='tag'>".$row5['catname']."</div>&nbsp;&nbsp;";
                                                
                                              }
                                          }
                                        }
                                      }
                                      $response .= "</div>";
                                      $response .= "<br>";

                               
                                
                                $response .= "</div>";
                                $response .= "<form method='POST' action='viewrecipe.php'>";
                                $response .= "<input type='hidden' name='view' value='".$row['recipe_id']."'>";
                                $response .= "<button class='vdetail' type='submit'><strong>View recipe</strong><i style='font-size:16px; padding: 0; margin: 0; margin-left: 5px;' class='fa'>&#xf101;</i></button>";
                                $response .= "</form><br>";
                                $response .= "</div>";

                                $response .= "<br>";

                               
                              }
                            }

                              
                              
                            }
                           else
                            {
                            
                              
                              
                             
                              
                              
                            }
                          }

                          exit($response);
                        }
                        else
                          
                          exit();

      }
   
  
    }
}
else 
{

?>
<center><h2>Error 404</h2></center>
<?php

}


?>

