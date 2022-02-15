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
        $_SESSION['submitsearch2']=$_POST['submitsearch'];
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
                    $sql10 = "SELECT * FROM tips WHERE title LIKE '%".$_POST['submitsearch']."%' ";
                    $result10 = mysqli_query($conn, $sql10);
                    $number_of_result = mysqli_num_rows($result10);

                   
                    $number_of_pages = ceil($number_of_result/$result_per_page);

                      if(!isset($_GET['page'])){
                            $page = 1;
                        } else {
                            $page = $_GET['page'];
                        }

                        $this_page_first_result = ($page-1)*$result_per_page;


                      $sql= "SELECT * FROM tips WHERE title LIKE '%".$_POST['submitsearch']."%' LIMIT ".$this_page_first_result.",".$result_per_page."";

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
                        <br>
                        <?php
                        }#if isset submit
                        else
                            echo "kambing goreng";
    }
}

?>





                  