<?php
session_start();
include("dbconnect.php");

if(isset($_SESSION['username']))
{
    $current_user = $_SESSION['username'];
    if(isset($_SESSION['submitsearch'])){
      unset($_SESSION['submitsearch']);
    }
    if(isset($_SESSION['userview'])){
        unset($_SESSION['userview']);
      }

    if($conn)
    {
        $sql = "DELETE FROM collection WHERE recipe_id = '".$_GET['recipeid']."' AND save_user='".$current_user."' ";
        if (mysqli_query($conn, $sql)) {
              echo "<script>window.alert('Recipe removed from collection !')</script>";
              echo ("<script type='text/javascript'>window.location.href = 'collection.php'</script>");
        }
        else{
              echo "<script>window.alert('Error !')</script>";
              echo ("<script type='text/javascript'>window.location.href = 'collection.php'</script>");
        }
    }
}
else 
{

?>

<?php

}


?>

