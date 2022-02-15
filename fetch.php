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
        $count1 = 0;
        $request = $_POST["request"];

        $sql = "SELECT * FROM recipe WHERE recipe_owner='".$current_user."' ORDER BY ".$request." ";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0)
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
                             $count1++;

                          }

                        }
                        else
                        {
                          if($count1 == 0 ){
                          ?>
                          <div style="color: grey; text-align: center; border: 2px dashed lightgrey; width: 90%; margin: auto;"><br><br><p>No recipe found :(</p><br><br></div>

                          <?php
                          }
                        }


        

          
          
      }
      if(isset($_POST["request2"]))
      {

        $request2 = $_POST["request2"];
        $count2 = 0;
        $sql = "SELECT * FROM recipe WHERE recipe_owner='".$current_user."' AND recipe_name LIKE '%".$request2."%'";
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
                             $count2++;

                          }

                        }
                        {
                          if($count2 == 0){
                          ?>
                          <div style="color: grey; text-align: center; border: 2px dashed lightgrey; width: 90%; margin: auto;"><br><br><p>No recipe found :(</p><br><br></div>

                          <?php
                          }
                        }


        

          
          
      }
    }

}


?>