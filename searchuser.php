<?php

session_start();
include("dbconnect.php");


if(isset($_SESSION['username']))
{
    $current_user = $_SESSION['username'];

    if($conn)
    {
      
      if(isset($_POST["request"]))
      {

        $request = $_POST["request"];

        $sql = "SELECT user.username,user.user_img, user_online.online_status FROM user,user_online WHERE user.username LIKE '%".$request."%' AND user.username = user_online.username AND user.username NOT LIKE '".$current_user."' ";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) >= 1)
                        {
                          while($row = mysqli_fetch_array($result))
                          { 
                            echo "<br>";
                            echo "<div class='usrh'>";
                            echo "<table>";
                            echo "<tr>";
                            echo "<td><img class='uprof' src='".$row['user_img']."' width='40' height='40' </td>";
                            echo "<td><div style='margin: auto; padding-left: 3px; font-size: 14px;'>".$row['username']." </div> </td>";
                            if ($row['online_status'] == 0) {
                                echo "<td><i class='fa fa-circle' style='font-size:11px; color:grey; padding: 0px;'></i></td>";
                            }
                            else{
                                echo "<td><i class='fa fa-circle' style='font-size:11px; color:green; padding: 0px;'></i></td>";
                            }
                            
                            echo "</tr>";

                            echo "</table>";
                            echo "<table>";
                            echo "<tr>";
                            echo "<td style='font-size: 12px; font-weight: 600; padding-left: 5px; padding-top: 5px;'>Recipe</td>";
                            echo "<td style='font-size: 12px; font-weight: 600; padding-left: 5px; padding-top: 5px;'>Follower</td>";

                            ?>
                            
                            <td rowspan=2>
                            
                                
                                <a href="user_view.php?username=<?php echo $row['username']; ?>"><button name="post_username" class="view-btn2">View</button></a>
                           
                            </td>

                            <?php
                            echo "</tr>";
                            echo "<tr>";
                            
                            $sql6 = "SELECT COUNT(*) AS recipecount FROM recipe WHERE recipe_owner = '".$row['username']."' ";
                              $result6 = mysqli_query($conn,$sql6);
                              if(mysqli_num_rows($result6))
                              {
                                while ($row6 = mysqli_fetch_array($result6)) 
                                {
                                    
                                    echo "<td style='font-size: 13px; font-weight: 600; '>".$row6['recipecount']."</td>";
                                }
                                  
                              }
                              else
                              {
                                  echo "<td style='font-size: 13px; font-weight: 600;'>0</td>";
                              }

                              $sql100 = "SELECT COUNT(*) AS follower FROM followuser WHERE userfollowed = '".$row['username']."' ";
                              $result100 = mysqli_query($conn,$sql100);
                              if(mysqli_num_rows($result100))
                              {
                                while ($row100 = mysqli_fetch_array($result100)) 
                                {
                                  
                                    echo "<td style='font-size: 13px; font-weight: 600;'>".$row100['follower']."</td>";
                                }
                                  
                              }
                              else
                              {
                                  echo "<td style='font-size: 13px; font-weight: 600;'>0</td>";
                              }
                            echo "</tr>";
                            echo "</table>";

                          
                             echo "</div>";
                             echo "";


                             

                          }

                        }
                        else
                        {
                        echo "<br>";
                       
                        echo "<i style='font-size:24px; color:grey;' class='fa'>&#xf071;</i>";
                        echo "<div class='user-srh-div'>Cannot find user !</div>";
                        }

        

          
          
      }
      else

        echo "kambing";
     
    }

}


?>