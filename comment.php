<?php
session_start();
include("dbconnect.php");

if(isset($_SESSION['username']))
{
    ?>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="icon" href="img/cookbook.png" type="image/gif">
          <link rel="stylesheet" href="css/viewrecipe.css" type="text/css" media="screen">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>




    <?php
    $current_user = $_SESSION['username'];
    if(isset($_POST['view']))
    {
    $_SESSION['recipeid'] = $_POST['view'];
    $recipeid = $_SESSION['recipeid'];
    }

    if($conn)
    {
      $sql = "SELECT * FROM recipe_comment WHERE recipeid = '".$_SESSION['recipeid']."' ORDER BY datetime_comment DESC ";
      $result = mysqli_query($conn,$sql);
                              if(mysqli_num_rows($result))
                              {
                                while ($row = mysqli_fetch_array($result)) 
                                {
                                  $sql2 = "SELECT * FROM user WHERE username = '".$row['usercomment']."'";
                                  $result2 = mysqli_query($conn,$sql2);
                                  if(mysqli_num_rows($result2))
                                  {
                                    while ($row2 = mysqli_fetch_array($result2)) 
                                    {
                                      ?>
                                      
                                      <div class="grid-profpic-comm">
                                        <div class="profpic-box">
                                          <br>
                                          <div class="profpic-comment">
                                            <?php echo "<img class='profpic-small' src='".$row2['user_img']."'>"; ?>

                                          </div><br><br><br>
                                        </div>
                                        <div class="comment-box">
                                          <p><h4><?php echo $row['usercomment']; ?></h4></p>
                                          <br>
                                          <p class="comm-text"><?php echo $row['comment_input'];  ?></p>
                                          <br><br>
                                          <p class="date-comm"><?php echo "<i>".$row['datetime_comment']."</i><br>"?></p>
                                        </div>
                                      </div>
                                      <br>
                                      <?php
                                    }
                                  }
                                }
                              }
    }
}
else 
{

?>

<?php

}


?>


