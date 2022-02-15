<?php
session_start();
include("dbconnect.php");

if(isset($_SESSION['username']))
{
    $current_user = $_SESSION['username'];

    if($conn)
    {

          $catrec = $_POST['catrec'];
          $ingr = preg_replace("/[\n\r]/","<br />", $_POST['rec-mats']);
          $steps = preg_replace("/[\n\r]/","<br />", $_POST['rec-step']);
               
        

          $target_dir = "uploads/";
          $target_file = $target_dir . basename($_FILES["uimage"]["name"]);
          $uploadOk = 1;
          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


          // Check if image file is a actual image or fake image
          if(isset($_POST['submit']))
          {
            $check = getimagesize($_FILES["uimage"]["tmp_name"]);
                      if($check !== false) {
                        echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                      } else {
                        echo "File is not an image.";
                        $uploadOk = 0;
                      }

          }
        

          // Check if file already exists
          if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
          }

          // Check file size
          if ($_FILES["uimage"]["size"] > 50000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
          }

          // Allow certain file formats
          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
          && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
          }

          // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
          // if everything is ok, try to upload file
          } else {
            if (move_uploaded_file($_FILES["uimage"]["tmp_name"], $target_file)) {
              echo "The file ".htmlspecialchars( basename( $_FILES["uimage"]["name"]))." has been uploaded.";

              
               $sql2 = "SELECT CURRENT_TIMESTAMP AS `datetime` ";
                $result2 = mysqli_query($conn,$sql2); 
                $row2 = mysqli_fetch_array($result2);
                               

                              

              $sql = "INSERT INTO recipe(recipe_name,recipe_description,recipe_img,recipe_time,recipe_owner,recipe_ingredient,recipe_step,recipe_datetime) VALUES('".$_POST['rec-title']."','".$_POST['rec-des']."','".$target_file."','".$_POST['rec-time']."','".$current_user."','".$ingr."','".$steps."','".$row2['datetime']."')";

              if (mysqli_query($conn, $sql))
              {
                  $sql2 = "SELECT recipe_id FROM recipe WHERE recipe_name = '".$_POST['rec-title']."' ";
                  $result = mysqli_query($conn,$sql2);
                  if(mysqli_num_rows($result))
                  {
                    while($row = mysqli_fetch_array($result))
                    { 
                      $recipe_id = $row['recipe_id'];
                      foreach ($catrec as $catrec2) {
                          $sql3 = "INSERT INTO recipe_category_branch (rec_id,category_id) VALUES('".$recipe_id."','".$catrec2."')";
                          $result3 = mysqli_query($conn,$sql3);
                        }
                        if($result3){
                              echo "<script>window.alert('Succesfully registered !')</script>";
                              echo ("<script type='text/javascript'>window.location.href = 'collection.php'</script>");
                        }
                        else{
                              echo "<script>window.alert('Failed registered (category)!')</script>";
                              echo ("<script type='text/javascript'>window.location.href = 'collection.php'</script>");
                        }
                    }
                  }

                  
                  

                
              }
              else
              {
                  echo "<script>window.alert('Failed registered (new recipe)!')</script>";
                  echo ("<script type='text/javascript'>window.location.href = 'collection.php'</script>");
              }







            } else {
              echo "Sorry, there was an error uploading your file.";
              echo ("<script type='text/javascript'>window.location.href = 'rcollection.php'</script>");
            }
          }
    }
      
    
}
else 
{





}


?>

