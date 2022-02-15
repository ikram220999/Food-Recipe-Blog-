<?php

include("dbconnect.php");

if(isset($_SESSION['username']))
{
    $current_user = $_SESSION['username'];

    if($conn)
    {
        if(isset($_SESSION['submitsearch2']))
        {
            if (isset($_GET['category'])) 
            {
                switch ($_GET['category']) {
                    case 1:
                        $category = "Breakfast";
                        break;

                        case 2:
                        $category = "Lunch";
                        break;

                        case 3:
                        $category = "Dinner";
                        break;

                        case 4:
                        $category = "Main-course";
                        break;

                        case 5:
                        $category = "Side-dish";
                        break;

                        case 6:
                        $category = "Baked-goods";
                        break;

                        case 7:
                        $category = "Others";
                        break;
                    
                    
                }
               
                ?>


                <?php
                echo "<h4 style='font-size='15px;''><i>Category: </i>".$category."</h4>";
                echo "<h4><i>Search result for : </i>".$_SESSION['submitsearch2']."</h4>";
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

                    $result_per_page = 5;
                            #$string = $row['recipe_description'];
                    $sql10 = "SELECT recipe.recipe_id AS recipe_id, recipe.recipe_name AS recipe_name, recipe.recipe_description AS recipe_description, recipe.recipe_img AS recipe_img, recipe.recipe_time AS recipe_time, recipe_category_branch.rec_id AS rec_id, recipe_category_branch.category_id AS cat_id FROM recipe,recipe_category_branch WHERE (recipe.recipe_id = recipe_category_branch.rec_id AND recipe_category_branch.category_id = ".$_GET['category']." ) AND recipe.recipe_name LIKE '%".$_SESSION['submitsearch2']."%' ";
                    $result10 = mysqli_query($conn, $sql10);
                    $number_of_result = mysqli_num_rows($result10);

                   
                    $number_of_pages = ceil($number_of_result/$result_per_page);

                      if(!isset($_GET['page'])){
                            $page = 1;
                        } else {
                            $page = $_GET['page'];
                        }

                        $this_page_first_result = ($page-1)*$result_per_page;

                     $sql= "SELECT recipe.recipe_id AS recipe_id, recipe.recipe_name AS recipe_name, recipe.recipe_description AS recipe_description, recipe.recipe_img AS recipe_img, recipe.recipe_time AS recipe_time, recipe_category_branch.rec_id AS rec_id, recipe_category_branch.category_id AS cat_id FROM recipe,recipe_category_branch WHERE (recipe.recipe_id = recipe_category_branch.rec_id AND recipe_category_branch.category_id = ".$_GET['category']." ) AND recipe.recipe_name LIKE '%".$_SESSION['submitsearch2']."%'  LIMIT ".$this_page_first_result.",".$result_per_page." ";

                        $result = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result))
                        {
                            
                          while($row = mysqli_fetch_array($result))
                          { 

                            ?>
                             <div class='box2'>

                             <div class='box2-grid'> 

                             <div class='box2-left'>
                             <img class='food_img' src='<?php echo "".$row['recipe_img'].""; ?>' alt='Image'>  
                             </div> <!--box2-left-->

                             <?php  $recipe_id = $row['recipe_id'];   ?>

                             <div class='box2-right-wrapper'>

                             <div class='box2-title'>
                                <h3><?php echo "".$row['recipe_name'].""; ?></h3>
                             </div> <!--box2-title-->

                             <div class='box2-desc'>
                                <i> <?php shorten($string=$row['recipe_description'], 200); ?></i>
                             </div> <!--box2-title-->

                             <div class='box2-right'>

                            <div class='recipe-time'>
                                <i class='fa fa-clock-o' style="padding: 0px; margin-top: 0px; margin-bottom: 0px;"></i> <?php echo "".$row['recipe_time'].""; ?> minute
                             </div> <!--recipe-time-->
                       
                        <?php

                                        $sql2 = "SELECT category_id FROM recipe_category_branch WHERE rec_id = '".$row['recipe_id']."' ";
                                        $result2 = mysqli_query($conn,$sql2);
                                        if(mysqli_num_rows($result2))
                                            {
                                            while($row2 = mysqli_fetch_array($result2))
                                                {   
                                                    $category = $row2['category_id'];
                                                    $sql3 = "SELECT catname FROM foodcategory WHERE catid = '".$category."' ";
                                                    $result3 = mysqli_query($conn,$sql3);
                                                    if(mysqli_num_rows($result3))
                                                        {
                                                        while($row3 = mysqli_fetch_array($result3))
                                                            {
                                                                echo "<div class='tag'>".$row3['catname']."</div>";
                                                               
                                                            }
                                                        }
                                                }
                                            }
                                        ?>

                                        </div> <!--box2-right-->

                             </div> <!--box2-right-wrapper-->
                             <div class="recipe-saveview">
                                 <form method='post' action='viewrecipe.php'>
                                     <button class='save-btn' type='submit' name='save' id='save' value='<?php echo "".$recipe_id.""; ?>'>Save</button><br><br>
                                     <button class='view-btn' type='submit' name='view' id='view' value='<?php echo "".$recipe_id.""; ?>'>View</button>
                                 </form>
                             </div> <!--recipe-save and view-->
                             </div> <!--box2-grid-->
                            
                         

                             </div> <!--box2-->
                             <?php
                          }#while result

                        }#if result

                        ?>

                        <div class="pages">
                        <?php
                        for ($page=1; $page<=$number_of_pages; $page++) {
                            echo "<a href='search_result.php?category=".$_GET['category']."&page=".$page." ' >".$page."</a>";
                        }

                        
                          
                        
                        ?>
                        </div>
                        <?php
                        }#isset category
                        else
                        {
                            
                            echo "<h4><i>Search result for : </i>".$_SESSION['submitsearch2']."</h4>";
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

                             $result_per_page = 5;
                            #$string = $row['recipe_description'];
                            $sql10 = "SELECT * FROM recipe WHERE recipe_name LIKE '%".$_SESSION['submitsearch2']."%' ";
                            $result10 = mysqli_query($conn, $sql10);
                            $number_of_result = mysqli_num_rows($result10);

                           
                            $number_of_pages = ceil($number_of_result/$result_per_page);

                            if(!isset($_GET['page'])){
                            $page = 1;
                            } else {
                                $page = $_GET['page'];
                            }

                            $this_page_first_result = ($page-1)*$result_per_page;

                             $sql= "SELECT * FROM recipe WHERE recipe_name LIKE '%".$_SESSION['submitsearch2']."%' LIMIT ".$this_page_first_result.",".$result_per_page."";

                            $result = mysqli_query($conn,$sql);
                            if(mysqli_num_rows($result))
                            {
                                
                              while($row = mysqli_fetch_array($result))
                              { 
                                ?>

                                <div class='box2'>

                             <div class='box2-grid'> 

                             <div class='box2-left'>
                             <img class='food_img' src='<?php echo "".$row['recipe_img'].""; ?>' alt='Image'>  
                             </div> <!--box2-left-->

                             <?php  $recipe_id = $row['recipe_id'];   ?>

                             <div class='box2-right-wrapper'>

                             <div class='box2-title'>
                                <h3><?php echo "".$row['recipe_name'].""; ?></h3>
                             </div> <!--box2-title-->

                             <div class='box2-desc'>
                                <i> <?php shorten($string=$row['recipe_description'], 200); ?></i>
                             </div> <!--box2-title-->

                             <div class='box2-right'>

                            <div class='recipe-time'>
                                <i class='fa fa-clock-o' style="padding: 0px; margin-top: 0px; margin-bottom: 0px;"></i> <?php echo "".$row['recipe_time'].""; ?> minute
                             </div> <!--recipe-time-->
                       
                        <?php

                                        $sql2 = "SELECT category_id FROM recipe_category_branch WHERE rec_id = '".$row['recipe_id']."' ";
                                        $result2 = mysqli_query($conn,$sql2);
                                        if(mysqli_num_rows($result2))
                                            {
                                            while($row2 = mysqli_fetch_array($result2))
                                                {   
                                                    $category = $row2['category_id'];
                                                    $sql3 = "SELECT catname FROM foodcategory WHERE catid = '".$category."' ";
                                                    $result3 = mysqli_query($conn,$sql3);
                                                    if(mysqli_num_rows($result3))
                                                        {
                                                        while($row3 = mysqli_fetch_array($result3))
                                                            {
                                                                echo "<div class='tag'>".$row3['catname']."</div>";
                                                               
                                                            }
                                                        }
                                                }
                                            }
                                        ?>

                                        </div> <!--box2-right-->

                             </div> <!--box2-right-wrapper-->
                             <div class="recipe-saveview">
                                 <form method='post' action='viewrecipe.php'>
                                     <button class='save-btn' type='submit' name='save' id='save' value='<?php echo "".$recipe_id.""; ?>'>Save</button><br><br>
                                     <button class='view-btn' type='submit' name='view' id='view' value='<?php echo "".$recipe_id.""; ?>'>View</button>
                                 </form>
                             </div> <!--recipe-save and view-->
                             </div> <!--box2-grid-->
                            
                         

                             </div> <!--box2-->

                                      <?php
                          }

                        }

                        ?>

                        <div class="pages">
                        <?php
                        for ($page=1; $page<=$number_of_pages; $page++) {
                            echo "<a href='search_result.php?page=".$page." ' >".$page."</a>";
                        }

                        
                          
                        
                        ?>
                        </div>
                        <?php
                        }

       


        }
                else
                {
                if(!isset($_GET['category']))
                {
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
                    $result_per_page = 5;
                            #$string = $row['recipe_description'];
                    $sql10 = "SELECT * FROM recipe";
                    $result10 = mysqli_query($conn, $sql10);
                    $number_of_result = mysqli_num_rows($result10);

                   
                    $number_of_pages = ceil($number_of_result/$result_per_page);

                      if(!isset($_GET['page'])){
                            $page = 1;
                        } else {
                            $page = $_GET['page'];
                        }

                        $this_page_first_result = ($page-1)*$result_per_page;


                      $sql= "SELECT * FROM recipe ORDER BY recipe_time DESC LIMIT ".$this_page_first_result.",".$result_per_page."";

                        $result = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result))
                        {
                            
                          while($row = mysqli_fetch_array($result))
                          { 
                            ?>

                             <div class='box2'>

                             <div class='box2-grid'> 

                             <div class='box2-left'>
                             <img class='food_img' src='<?php echo "".$row['recipe_img'].""; ?>' alt='Image'>  
                             </div> <!--box2-left-->

                             <?php $recipe_id = $row['recipe_id']; 



                             ?>


                             <div class='box2-right-wrapper'>

                             <div class='box2-title'>
                                <h3><?php echo "".$row['recipe_name'].""; ?></h3>
                             </div> <!--box2-title-->

                             <div class='box2-desc'>
                                <i> <?php shorten($string=$row['recipe_description'], 200); ?></i>
                             </div> <!--box2-title-->

                             <div class='box2-right'>
                

                             <div class='recipe-time'>
                                <i class='fa fa-clock-o' style="padding: 0px; margin-top: 0px; margin-bottom: 0px;"></i> <?php echo "".$row['recipe_time'].""; ?> minute
                             </div> <!--recipe-time-->

                             <?php

                                        $sql2 = "SELECT category_id FROM recipe_category_branch WHERE rec_id = '".$row['recipe_id']."' ";
                                        $result2 = mysqli_query($conn,$sql2);
                                        if(mysqli_num_rows($result2))
                                            {
                                            while($row2 = mysqli_fetch_array($result2))
                                                {   
                                                    $category = $row2['category_id'];
                                                    $sql3 = "SELECT catname FROM foodcategory WHERE catid = '".$category."' ";
                                                    $result3 = mysqli_query($conn,$sql3);
                                                    if(mysqli_num_rows($result3))
                                                        {
                                                        while($row3 = mysqli_fetch_array($result3))
                                                            {
                                                                echo "<div class='tag'>".$row3['catname']."</div>";
                                                               
                                                            }
                                                        }
                                                }
                                            }
                                        ?>
                             <!--<div class='rec-creator'>
                                <i><?php echo "".$row['recipe_owner'].""; ?></i>
                             </div>--> <!--rec-creator-->
                             
                             </div> <!--box2-right-->

                             </div> <!--box2-right-wrapper-->
                             <div class="recipe-saveview">
                                 <form method='post' action='viewrecipe.php'>
                                     <button class='save-btn' type='submit' name='save' id='save' value='<?php echo "".$recipe_id.""; ?>'>Save</button><br><br>
                                     <button class='view-btn' type='submit' name='view' id='view' value='<?php echo "".$recipe_id.""; ?>'>View</button>
                                 </form>
                             </div> <!--recipe-save and view-->
                             </div> <!--box2-grid-->
                            
                         

                             </div> <!--box2-->

                            <?php
                           

                          }

                        }

                        ?>

                        <div class="pages">
                        <?php
                        for ($page=1; $page<=$number_of_pages; $page++) {
                            echo "<a href='search_result.php?page=".$page." ' >".$page."</a>";
                        }
                        ?>

                        </div>





<?php
            }#if !isset $_GET['category']
            else
            {
                switch ($_GET['category']) {
                    case 1:
                        $category = "Breakfast";
                        break;

                        case 2:
                        $category = "Lunch";
                        break;

                        case 3:
                        $category = "Dinner";
                        break;

                        case 4:
                        $category = "Main-course";
                        break;

                        case 5:
                        $category = "Side-dish";
                        break;

                        case 6:
                        $category = "Baked-goods";
                        break;

                        case 7:
                        $category = "Others";
                        break;
                    
                    
                }
                echo "<h4 style='font-size='15px;''><i>Category: </i>".$category."</h4>";
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
                $result_per_page = 5;
                            #$string = $row['recipe_description'];
                    $sql10 = "SELECT * FROM recipe";
                    $result10 = mysqli_query($conn, $sql10);
                    $number_of_result = mysqli_num_rows($result10);

                   
                    $number_of_pages = ceil($number_of_result/$result_per_page);

                    if(!isset($_GET['page'])){
                            $page = 1;
                        } else {
                            $page = $_GET['page'];
                        }

                        $this_page_first_result = ($page-1)*$result_per_page;


                        $sql30 = "SELECT * FROM recipe_category_branch WHERE category_id = '".$_GET['category']."' LIMIT ".$this_page_first_result.",".$result_per_page."";
                        $result30 = mysqli_query($conn,$sql30);
                        if(mysqli_num_rows($result30))
                        { 
                            while($row30 = mysqli_fetch_array($result30))
                            {
                                $sql= "SELECT * FROM recipe WHERE recipe_id = '".$row30['rec_id']."' ORDER BY recipe_time DESC ";

                                $result = mysqli_query($conn,$sql);
                                if(mysqli_num_rows($result))
                                {
                                    
                                  while($row = mysqli_fetch_array($result))
                                  {

                                          ?>
                                          <div class='box2'>

                             <div class='box2-grid'> 

                             <div class='box2-left'>
                             <img class='food_img' src='<?php echo "".$row['recipe_img'].""; ?>' alt='Image'>  
                             </div> <!--box2-left-->

                             <?php $recipe_id = $row['recipe_id']; 



                             ?>


                             <div class='box2-right-wrapper'>

                             <div class='box2-title'>
                                <h3><?php echo "".$row['recipe_name'].""; ?></h3>
                             </div> <!--box2-title-->

                             <div class='box2-desc'>
                                <i> <?php shorten($string=$row['recipe_description'], 200); ?></i>
                             </div> <!--box2-title-->

                             <div class='box2-right'>
                

                             <div class='recipe-time'>
                                <i class='fa fa-clock-o' style="padding: 0px; margin-top: 0px; margin-bottom: 0px;"></i> <?php echo "".$row['recipe_time'].""; ?> minute
                             </div> <!--recipe-time-->

                             <?php

                                        $sql2 = "SELECT category_id FROM recipe_category_branch WHERE rec_id = '".$row['recipe_id']."' ";
                                        $result2 = mysqli_query($conn,$sql2);
                                        if(mysqli_num_rows($result2))
                                            {
                                            while($row2 = mysqli_fetch_array($result2))
                                                {   
                                                    $category = $row2['category_id'];
                                                    $sql3 = "SELECT catname FROM foodcategory WHERE catid = '".$category."' ";
                                                    $result3 = mysqli_query($conn,$sql3);
                                                    if(mysqli_num_rows($result3))
                                                        {
                                                        while($row3 = mysqli_fetch_array($result3))
                                                            {
                                                                echo "<div class='tag'>".$row3['catname']."</div>";
                                                               
                                                            }
                                                        }
                                                }
                                            }
                                        ?>
                             <!--<div class='rec-creator'>
                                <i><?php echo "".$row['recipe_owner'].""; ?></i>
                             </div>--> <!--rec-creator-->
                             
                             </div> <!--box2-right-->

                             </div> <!--box2-right-wrapper-->
                             <div class="recipe-saveview">
                                 <form method='post' action='viewrecipe.php'>
                                     <button class='save-btn' type='submit' name='save' id='save' value='<?php echo "".$recipe_id.""; ?>'>Save</button><br><br>
                                     <button class='view-btn' type='submit' name='view' id='view' value='<?php echo "".$recipe_id.""; ?>'>View</button>
                                 </form>
                             </div> <!--recipe-save and view-->
                             </div> <!--box2-grid-->
                            
                         

                             </div> <!--box2-->



                                          <?php          
                                   }
                                }
                            }
                        }

                        ?>
                                    <div class="pages">
                        <?php
                        for ($page=1; $page<=$number_of_pages; $page++) {
                            echo "<a href='search_result.php?category=".$_GET['category']."&page=".$page." ' >".$page."</a>";
                        }
                        ?>

                        </div>





<?php





            } #else $_GET['category']

          }      
        }
}

?>





                  