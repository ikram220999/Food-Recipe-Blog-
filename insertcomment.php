<?php
session_start();
include("dbconnect.php");

if(isset($_SESSION['username']))
{
    $current_user = $_SESSION['username'];
    if(isset($_POST['view']))
    {
    $_SESSION['recipeid'] = $_POST['view'];
    $recipeid = $_SESSION['recipeid'];
    }

    if($conn)
    {
      echo $_POST['commentinput'];
      echo $_SESSION['recipeid'];
      echo $current_user;
      $sql2 = "SELECT CURRENT_TIMESTAMP AS `datetime` ";
      $result2 = mysqli_query($conn,$sql2);
                              if(mysqli_num_rows($result2))
                              {
                                while ($row2 = mysqli_fetch_array($result2)) 
                                {
                                  $sql = "INSERT INTO `recipe_comment`(`comment_input`, `recipeid`, `usercomment`, `datetime_comment`) VALUES('".$_POST['commentinput']."','".$_SESSION['recipeid']."', '".$current_user."', '".$row2['datetime']."') ";
                                      mysqli_query($conn, $sql);
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


