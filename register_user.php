<?php
session_start();
include("dbconnect.php");

if($conn)
{
	 if(isset($_POST['submit']))
   {

    $sql2  = "SELECT * FROM user WHERE username = '".$_POST['username']."' LIMIT 1";
    $result2 = mysqli_query($conn,$sql2);
    if (mysqli_num_rows($result2)==1) {

          echo "<script>window.alert('Username already taken !')</script>";
          echo ("<script type='text/javascript'>window.location.href = 'signup.php'</script>");
  

    }
    else
    {

      if($_POST['password'] == $_POST['conpassword'])
      {
         $fullname = "default";
         $phone = "default";
         $desc = "default";
         $addr = "default";
         $img = "img/imagesdefault.png";
         $tele = "0";

        $sql = "INSERT INTO user(`username`,`password`,`user_fullname`,`user_email`,`user_phone`,`user_address`,`user_desc`,`user_img`,`user_teleid`) VALUES ('".$_POST['username']."','".$_POST['password']."','".$fullname."','".$_POST['email']."','".$phone."','".$addr."','".$desc."','".$img."','".$tele."')";

        if (mysqli_query($conn, $sql))
                {
                    $sql2 = "INSERT INTO user_online(username,online_status) VALUES ('".$_POST['username']."',0)";

                    if (mysqli_query($conn, $sql2))
                    {
                        echo "<script>window.alert('Succesfully registered !')</script>";
                        echo ("<script type='text/javascript'>window.location.href = 'login.html'</script>");
                    }
                }
                else
                {
                    echo "<script>window.alert('Failed registered user !')</script>";
                    echo ("<script type='text/javascript'>window.location.href = 'signup.php'</script>");
                }
      }
      else
      {
        echo "<script>window.alert('Please match password and confirm password !')</script>";
          echo ("<script type='text/javascript'>window.location.href = 'signup.php'</script>");
      }

    
   }
}
 else
      {
          echo "<script>window.alert('Failed connect !')</script>";
          echo ("<script type='text/javascript'>window.location.href = 'signup.php'</script>");
      }
}


?>

