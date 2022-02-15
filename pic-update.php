<?php
session_start();
include("dbconnect.php");

if(isset($_SESSION['username']))
{
    $current_user = $_SESSION['username'];

    if($conn)
    {
      if(isset($_POST['save-pic'])){

        $profpic = $_POST['profpic'];
        if($profpic == 1){
          $pic = "img/bavt.png";
        }
        elseif($profpic == 2){
          $pic = "img/avt3.png";
        }
        elseif($profpic == 3){
          $pic = "img/gavt.png";
        }
        elseif($profpic == 4){
          $pic = "img/avt4.png";
        }
      
        $sql = "UPDATE `user` SET `user_img`='".$pic."' WHERE username='".$current_user."' ";
           if (mysqli_query($conn, $sql))   
            {
              echo "<script>window.alert('Succesfully update profile picture !')</script>";
              echo ("<script type='text/javascript'>window.location.href = 'account.php'</script>");
            }
        else
            {
              echo "<script>window.alert('Failed !')</script>";
              echo ("<script type='text/javascript'>window.location.href = 'account.php'</script>");
            }
      }
    }
}
else 
{



}


?>

