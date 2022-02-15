<?php
session_start();
include("dbconnect.php");

if(isset($_SESSION['username']))
{
    $current_user = $_SESSION['username'];

    if($conn)
    {
        
        if(isset($_POST['submitsearch']))
        {
            if(isset($_GET['category'])){
            echo "kambing";
        }
        $_SESSION['submitsearch']=$_POST['submitsearch'];
        echo "<h4><i>Search result for : </i>".$_SESSION['submitsearch']."</h4>";

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
                    $sql10 = "SELECT * FROM recipe WHERE recipe_name LIKE '".$_POST['submitsearch']."%' ";
                    $result10 = mysqli_query($conn, $sql10);
                    $number_of_result = mysqli_num_rows($result10);

                   
                    $number_of_pages = ceil($number_of_result/$result_per_page);

                      if(!isset($_GET['page'])){
                            $page = 1;
                        } else {
                            $page = $_GET['page'];
                        }

                        $this_page_first_result = ($page-1)*$result_per_page;


                      $sql= "SELECT * FROM recipe WHERE recipe_name LIKE '".$_POST['submitsearch']."%' LIMIT ".$this_page_first_result.",".$result_per_page."";

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
                        <br>
                        <?php
                        }#if isset submit
                        else
                            echo "kambing goreng";
    }
}

?>





                  