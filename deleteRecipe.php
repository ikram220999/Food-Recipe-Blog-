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
      if (isset($_GET['recipeid'])) {

        $sql = "DELETE FROM recipe WHERE recipe_id = '".$_GET['recipeid']."' ";
        if (mysqli_query($conn, $sql)) 
        {
          $sql2 = "DELETE FROM recipe_comment WHERE recipeid = '".$_GET['recipeid']."' ";
          if (mysqli_query($conn, $sql2)) 
          {
            $sql3 = "DELETE FROM recipe_category_branch WHERE rec_id = '".$_GET['recipeid']."' ";
            if (mysqli_query($conn, $sql3)) 
            {
              echo "<script>window.alert('Recipe deleted !')</script>";
              echo ("<script type='text/javascript'>window.location.href = 'collection.php'</script>"); 
            }
            else
              header('collection.php');
          }
          else
            header('collection.php');
        }
        else
          header('collection.php');
      }
      
    }
}
else 
{

?>

<?php

}


?>

