<?php
session_start();
include("dbconnect.php");

if(isset($_SESSION['username']))
{
    $current_user = $_SESSION['username'];
    if($conn)
    {
      if(isset($_POST['submit']))
      {
        $fname = $_POST['user-name'];
        $email = $_POST['user-email'];
        $phone = $_POST['user-phone'];
        $addr = $_POST['user-addr'];
        $desc = $_POST['user-desc'];
        $pass = $_POST['user-pass'];

        $sql = "UPDATE user SET  user_fullname ='".$fname."' , password ='".$pass."' , user_phone = '".$phone."' , user_email = '".$email."' , user_address = '".$addr."' , user_desc = '".$desc."', password = '".$pass."' WHERE username ='".$current_user."' ";

        if (mysqli_query($conn, $sql))   
            {
              echo "<script>window.alert('Succesfully update profile !')</script>";
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
?>

