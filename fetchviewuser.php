<?php

session_start();
include("dbconnect.php");


if(isset($_SESSION['username']))
{
    $current_user = $_SESSION['username'];

    if($conn)
    {
      if(isset($_SESSION['userview'])){
        $userview = $_SESSION['userview'];
      }

      if(isset($_SESSION['username-temp']))
      {
        $userview = $_SESSION['username-temp'];
      }

      if(isset($_POST["request"]))
      {

        $request = $_POST["request"];

        $sql = "SELECT * FROM recipe WHERE recipe_owner='".$userview."' ORDER BY ".$request." ";
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
                             
                             echo "<form method='post' action='viewrecipe.php'>";
                             
                             echo "<button class='view-btn' type='submit' name='view' id='view' value='".$recipe_id."'>View</button>";
                             echo "</div>"; #recipe-save and view
                             echo "</form>";
                           
                             
                             echo "</div>"; #box2-right

                             echo "</div>"; #box2-grid
                            
                         

                             echo "</div>"; #box2

                          }

                        }


        

          
          
      }
      if(isset($_POST["request2"]))
      {

        $request2 = $_POST["request2"];

        $sql = "SELECT * FROM recipe WHERE recipe_owner='".$userview."' AND recipe_name LIKE '%".$request2."%'";
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
                             
                             echo "<form method='post' action='viewrecipe.php'>";
                             
                             echo "<button class='view-btn' type='submit' name='view' id='view' value='".$recipe_id."'>View</button>";
                             echo "</div>"; #recipe-save and view
                             echo "</form>";
                           
                             
                             echo "</div>"; #box2-right

                             echo "</div>"; #box2-grid
                            
                         

                             echo "</div>"; #box2

                          }

                        }


        

          
          
      }
    }

}


?>