<?php
session_start();
include("dbconnect.php");

if(isset($_SESSION['username']))
{
    $current_user = $_SESSION['username'];

    if($conn)
    {
        //$catrec = $_POST['catrec'];
          $title = $_POST['rec-title'];
          $description = $_POST['rec-des'];
          $time = $_POST['rec-time'];
          $img = $_POST['image'];
          $ingr = $_POST['rec-mats'];
          $steps = $_POST['rec-step'];


          if(isset($_FILES['uimage']['name']) && ($_FILES['uimage']['name'] != ""))
          {
            $size = $_FILES['uimage']['size'];
            $temp = $_FILES['uimage']['tmp_name'];
            $type = $_FILES['uimage']['type'];
            $profile_name = $_FILES['uimage']['name'];

            unlink($_POST['image']);

            move_uploaded_file($temp, "uploads/$profile_name");
            $pic = "uploads/".$profile_name."";
          }
          else
          {
            $pic = $_POST['image'];
          }

          $sql = "UPDATE recipe SET recipe_name='".$title."', recipe_description='".$description."', recipe_img='".$pic."', recipe_time='".$time."', recipe_ingredient='".$ingr."', recipe_step='".$steps."'  WHERE recipe_id = '".$_POST['recid']."' ";
        if (mysqli_query($conn, $sql))   
            {
              echo "<script>window.alert('Succesfully update recipe !')</script>";
              echo ("<script type='text/javascript'>window.location.href = 'collection.php'</script>");
            }
        else
            {
              echo "<script>window.alert('Failed !')</script>";
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

