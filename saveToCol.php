<?php
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
//session_cache_limiter('public'); // works too
session_start();
include("dbconnect.php");

if(isset($_SESSION['username']))
{
    $current_user = $_SESSION['username'];
 

    if($conn)
    {

      $sql = "INSERT INTO collection(recipe_id,recipe_owner,save_user) VALUES('".$_POST['recipeid']."','".$_POST['recowner']."','".$current_user."') ";
      mysqli_query($conn, $sql);
    }
}
else 
{

?>

<?php

}


?>


