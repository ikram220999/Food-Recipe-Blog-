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
                        $category = "cooking";
                        break;

                        case 2:
                        $category = "equipment";
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
                    $sql10 = "SELECT tips.id,tips.title,tips.categoryid,tips.owner,tips.point,tips.tdatetime,tips_category.id,tips_category.name FROM tips,tips_category WHERE (tips.categoryid=tips_category.id AND tips.title LIKE '%".$_SESSION['submitsearch2']."%') ";
                    $result10 = mysqli_query($conn, $sql10);
                    $number_of_result = mysqli_num_rows($result10);

                   
                    $number_of_pages = ceil($number_of_result/$result_per_page);

                      if(!isset($_GET['page'])){
                            $page = 1;
                        } else {
                            $page = $_GET['page'];
                        }

                        $this_page_first_result = ($page-1)*$result_per_page;

                     $sql= "SELECT tips.id,tips.title,tips.categoryid,tips.point,tips.owner,tips.tdatetime,tips_category.id,tips_category.name FROM tips,tips_category WHERE tips.categoryid=tips_category.id AND tips.title LIKE '".$_SESSION['submitsearch2']."%'  LIMIT ".$this_page_first_result.",".$result_per_page." ";

                        $result = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result))
                        {
                            
                          while($row = mysqli_fetch_array($result))
                          { 

                            ?>
                         <div class='box2'>


                            

                             <?php  $tips_id = $row['id'];   ?>


                             <div class='box2-right-wrapper'>

                             <div class='box2-title'>
                                <h3><?php echo "".$row['title'].""; ?></h3>
                             </div> <!--box2-title-->

                             <div class='box2-desc'>
                                <i> <?php shorten($string=$row['point'], 200); ?></i>
                             </div> <!--box2-title-->

                             <div style="font-size: 13px; color: grey; margin-left: 750px;">
                                 <i> <?php echo "".$row['tdatetime'].""; ?></i>
                             </div>

                             <div class='box2-right'>
                

                    
                             <!--<div class='rec-creator'>
                                <i><?php echo "".$row['recipe_owner'].""; ?></i>
                             </div>--> <!--rec-creator-->
                             
                             </div> <!--box2-right-->

                             </div> <!--box2-right-wrapper-->
                          
                             
                            
                         

                             </div> <!--box2-->

                             <?php
                          }#while result

                        }#if result

                        ?>

                        <div class="pages">
                        <?php
                        for ($page=1; $page<=$number_of_pages; $page++) {
                            echo "<a href='tips.php?category=".$_GET['category']."&page=".$page." ' >".$page."</a>";
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
                            $sql10 = "SELECT * FROM tips WHERE title LIKE '%".$_SESSION['submitsearch2']."%' ";
                            $result10 = mysqli_query($conn, $sql10);
                            $number_of_result = mysqli_num_rows($result10);

                           
                            $number_of_pages = ceil($number_of_result/$result_per_page);

                            if(!isset($_GET['page'])){
                            $page = 1;
                            } else {
                                $page = $_GET['page'];
                            }

                            $this_page_first_result = ($page-1)*$result_per_page;

                             $sql= "SELECT * FROM tips WHERE title LIKE '%".$_SESSION['submitsearch2']."%' LIMIT ".$this_page_first_result.",".$result_per_page."";

                            $result = mysqli_query($conn,$sql);
                            if(mysqli_num_rows($result))
                            {
                                
                              while($row = mysqli_fetch_array($result))
                              { 
                                ?>

                                  <div class='box2'>


                            

                             <?php  $tips_id = $row['id'];   ?>


                             <div class='box2-right-wrapper'>

                             <div class='box2-title'>
                                <h3><?php echo "".$row['title'].""; ?></h3>
                             </div> <!--box2-title-->

                             <div class='box2-desc'>
                                <i> <?php shorten($string=$row['point'], 200); ?></i>
                             </div> <!--box2-title-->

                             <div style="font-size: 13px; color: grey; margin-left: 750px;">
                                 <i> <?php echo "".$row['tdatetime'].""; ?></i>
                             </div>

                             <div class='box2-right'>
                

                    
                             <!--<div class='rec-creator'>
                                <i><?php echo "".$row['recipe_owner'].""; ?></i>
                             </div>--> <!--rec-creator-->
                             
                             </div> <!--box2-right-->

                             </div> <!--box2-right-wrapper-->
                          
                             
                            
                         

                             </div> <!--box2-->


                                      <?php
                          }

                        }

                        ?>

                        <div class="pages">
                        <?php
                        for ($page=1; $page<=$number_of_pages; $page++) {
                            echo "<a href='tips.php?page=".$page." ' >".$page."</a>";
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
                    $sql10 = "SELECT * FROM tips";
                    $result10 = mysqli_query($conn, $sql10);
                    $number_of_result = mysqli_num_rows($result10);

                   
                    $number_of_pages = ceil($number_of_result/$result_per_page);

                      if(!isset($_GET['page'])){
                            $page = 1;
                        } else {
                            $page = $_GET['page'];
                        }

                        $this_page_first_result = ($page-1)*$result_per_page;


                      $sql= "SELECT * FROM tips ORDER BY tdatetime DESC LIMIT ".$this_page_first_result.",".$result_per_page."";

                        $result = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result))
                        {
                            
                          while($row = mysqli_fetch_array($result))
                          { 
                            ?>

                              <div class='box2'>


                            

                             <?php  $tips_id = $row['id'];   ?>


                             <div class='box2-right-wrapper'>

                             <div class='box2-title'>
                                <h3><?php echo "".$row['title'].""; ?></h3>
                             </div> <!--box2-title-->

                             <div class='box2-desc'>
                                <i> <?php shorten($string=$row['point'], 200); ?></i>
                             </div> <!--box2-title-->

                             <div style="font-size: 13px; color: grey; margin-left: 750px;">
                                 <i> <?php echo "".$row['tdatetime'].""; ?></i>
                             </div>

                             <div class='box2-right'>
                

                    
                             <!--<div class='rec-creator'>
                                <i><?php echo "".$row['recipe_owner'].""; ?></i>
                             </div>--> <!--rec-creator-->
                             
                             </div> <!--box2-right-->

                             </div> <!--box2-right-wrapper-->
                          
                             
                            
                         

                             </div> <!--box2-->


                            <?php
                           

                          }

                        }

                        ?>

                        <div class="pages">
                        <?php
                        for ($page=1; $page<=$number_of_pages; $page++) {
                            echo "<a href='tips.php?page=".$page." ' >".$page."</a>";
                        }
                        ?>

                        </div>





<?php
            }#if !isset $_GET['category']
            else
            {
                switch ($_GET['category']) {
                    case 1:
                        $category = "Cooking";
                        break;

                        case 2:
                        $category = "Equipment";
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
                    $sql10 = "SELECT * FROM tips";
                    $result10 = mysqli_query($conn, $sql10);
                    $number_of_result = mysqli_num_rows($result10);

                   
                    $number_of_pages = ceil($number_of_result/$result_per_page);

                    if(!isset($_GET['page'])){
                            $page = 1;
                        } else {
                            $page = $_GET['page'];
                        }

                        $this_page_first_result = ($page-1)*$result_per_page;


                        $sql30 = "SELECT * FROM tips,tips_category WHERE (tips.categoryid=tips_category.id AND tips.categoryid = '".$_GET['category']."') LIMIT ".$this_page_first_result.",".$result_per_page."";
                        $result30 = mysqli_query($conn,$sql30);
                        if(mysqli_num_rows($result30))
                        { 
                            while($row30 = mysqli_fetch_array($result30))
                            {
                                

                                          ?>
                                            <div class='box2'>


                            

                   


                             <div class='box2-right-wrapper'>

                             <div class='box2-title'>
                                <h3><?php echo "".$row30['title'].""; ?></h3>
                             </div> <!--box2-title-->

                             <div class='box2-desc'>
                                <i> <?php shorten($string=$row30['point'], 200); ?></i>
                             </div> <!--box2-title-->

                             <div style="font-size: 13px; color: grey; margin-left: 750px;">
                                 <i> <?php echo "".$row30['tdatetime'].""; ?></i>
                             </div>

                             <div class='box2-right'>
                

                    
                             <!--<div class='rec-creator'>
                                <i><?php echo "".$row['recipe_owner'].""; ?></i>
                             </div>--> <!--rec-creator-->
                             
                             </div> <!--box2-right-->

                             </div> <!--box2-right-wrapper-->
                          
                             
                            
                         

                             </div> <!--box2-->




                                          <?php          
                             
                            }
                        }

                        ?>
                                    <div class="pages">
                        <?php
                        for ($page=1; $page<=$number_of_pages; $page++) {
                            echo "<a href='tips.php?category=".$_GET['category']."&page=".$page." ' >".$page."</a>";
                        }
                        ?>

                        </div>





<?php





            } #else $_GET['category']

          }      
        }
}

?>





                  