<?php

include("dbconnect.php");

if(isset($_SESSION['username']))
{
    $current_user = $_SESSION['username'];

    if($conn)
    {
      ?>
          <!DOCTYPE html>
          <html lang="en">
          <head>
          <title>Cookhouse</title>
          <meta charset="utf-8">

          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="icon" href="img/cookbook.png" type="image/gif">
          <link rel="stylesheet" href="css/followuser.css" type="text/css" media="screen">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
          <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

          
          <i style='font-size:13px' class='fas'>&#xf234;</i><a class="fol"> Follow</a>



      <?php         
    }
}
else 
{

?>

<?php

}


?>


