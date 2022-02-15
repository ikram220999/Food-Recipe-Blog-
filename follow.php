<?php
session_start();
include("dbconnect.php");
if(isset($_SESSION['username']))
{
    $current_user = $_SESSION['username'];

    if($conn)
    {
        $sql2 = "SELECT CURRENT_TIMESTAMP AS `datetime` ";
                $result2 = mysqli_query($conn,$sql2); 
                $row2 = mysqli_fetch_array($result2);




      if(isset($_POST['follow']))
      {
   
      $sql = "INSERT INTO followuser(userfollowing,userfollowed,follow_datetime) VALUES('".$current_user."','".$_POST['followeduser']."','".$row2['datetime']."')";
      if (mysqli_query($conn, $sql))
              {
                echo ("<script type='text/javascript'>window.location.href = 'viewrecipe.php'</script>");
              }
              else
              {
              
               echo ("<script type='text/javascript'>window.location.href = 'viewrecipe.php'</script>");
              }
      }
      elseif(isset($_POST['unfollow']))
      {
   
      $sql = "DELETE FROM followuser WHERE userfollowing = '".$current_user."' AND userfollowed = '".$_POST['followeduser']."'";
      if (mysqli_query($conn, $sql))
              {
                echo ("<script type='text/javascript'>window.location.href = 'viewrecipe.php'</script>");
              }
              else
              {
              
               echo ("<script type='text/javascript'>window.location.href = 'viewrecipe.php'</script>");
              }
      }
      elseif(isset($_POST['follow_home']))
      {
   
      $sql = "DELETE FROM followuser WHERE userfollowing = '".$current_user."' AND userfollowed = '".$_POST['followeduser']."'";
      if (mysqli_query($conn, $sql))
              {
                echo ("<script type='text/javascript'>window.location.href = 'homeuser.php'</script>");
              }
              else
              {
              
               echo ("<script type='text/javascript'>window.location.href = 'homeuser.php'</script>");
              }
      }
      elseif(isset($_POST['unfollowview']))
      {
      $_SESSION['username-temp'] = $_POST['followeduser'];
      $sql = "DELETE FROM followuser WHERE userfollowing = '".$current_user."' AND userfollowed = '".$_POST['followeduser']."'";
      if (mysqli_query($conn, $sql))
              {
                echo ("<script type='text/javascript'>window.location.href = 'user_view.php'</script>");
              }
              else
              {
              
               echo ("<script type='text/javascript'>window.location.href = 'user_view.php'</script>");
              }
      }
      elseif(isset($_POST['followview']))
      {
        $_SESSION['username-temp'] = $_POST['followeduser'];
  
      $sql = "INSERT INTO followuser(userfollowing,userfollowed,follow_datetime) VALUES('".$current_user."','".$_POST['followeduser']."','".$row2['datetime']."')";
      if (mysqli_query($conn, $sql))
              {
                echo ("<script type='text/javascript'>window.location.href = 'user_view.php'</script>");
              }
              else
              {
              
               echo ("<script type='text/javascript'>window.location.href = 'user_view.php'</script>");
              }
      }
      else 
      {
        echo ("<script type='text/javascript'>window.location.href = 'homeuser.php'</script>");
      }
    }
    
}
else 
{
  


}


?>


