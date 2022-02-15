<?php
session_start();
include("dbconnect.php");

if(isset($_SESSION['username']))
{
    $current_user = $_SESSION['username'];
    if(isset($_SESSION['submitsearch'])){
      unset($_SESSION['submitsearch']);
    }
    
    if(isset($_SESSION['submitsearch2'])){
      unset($_SESSION['submitsearch2']);
    }
    
    if(isset($_SESSION['userview'])){
        unset($_SESSION['userview']);
      }

    if($conn)
    {
      if (isset($_GET['tipsid'])) {

        $sql = "DELETE FROM tips WHERE id = '".$_GET['tipsid']."' ";
        if (mysqli_query($conn, $sql)) 
        {
            echo "<script>window.alert('Tips deleted !')</script>";
              echo ("<script type='text/javascript'>window.location.href = 'tips.php'</script>"); 
        
        }
        else
          header('tips.php');
      }
      
    }
}
else 
{

?>

<?php

}


?>

