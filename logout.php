<?php


  session_start();
  include("dbconnect.php");

  if($conn)
  {

    $online  = 0;
        $sql2 = "UPDATE `user_online` SET `online_status`= '".$online."' WHERE username = '".$_SESSION['username']."'";
        if (mysqli_query($conn, $sql2))   
          {
            // Destroy session
            session_destroy();
            // Redirect back to 'Homepage.php'
            echo "<script>window.alert('Succesfully logout')</script>";
            echo ("<script type='text/javascript'>window.location.href = 'index.php'</script>");
            exit();
            mysqli_close($conn); // MySQLi Procedural close
          }
  }
  else
  {
    echo "Error Connecting to Database.";
  }
?>