<?php
session_start();
include("dbconnect.php");
echo "pak abu";

if(isset($_SESSION['username']))
{
  echo "pak samat";
    $current_user = $_SESSION['username'];
    if($conn)
    {
      echo "pak arab";
       if(isset($_POST['submit'])){
        echo "pak arab";
          $sql = "UPDATE user SET user_teleid ='".$_POST['telechatid']."' WHERE username ='".$current_user."' ";

          if (mysqli_query($conn, $sql))
                  {
                      echo "<script>window.alert('Succesfully update telegram chat_id !')</script>";
                      echo ("<script type='text/javascript'>window.location.href = 'account.php'</script>");
                  }
                  else
                  {
                      echo "<script>window.alert('Failed update telegram chat_id  !')</script>";
                      echo ("<script type='text/javascript'>window.location.href = 'account.php'</script>");
                  }
        
       
       }
    }
     else
          {
              echo "<script>window.alert('Failed connect DB!')</script>";
              echo ("<script type='text/javascript'>window.location.href = 'account.php'</script>");
          }
}



?>

