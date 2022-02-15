<?php
session_start();
include('dbconnect.php');

if(isset($_SESSION['username']))
{
    $current_user = $_SESSION['username'];
    if(isset($_SESSION['submitsearch'])){
      unset($_SESSION['submitsearch']);
    }

    if($conn)
    {
        $cate=$_POST['cate'];
      $title = $_POST['title'];
      $point = $_POST['point'];
      $sql2 = "SELECT CURRENT_TIMESTAMP AS `datetime` ";
      $result2 = mysqli_query($conn,$sql2);
                              if(mysqli_num_rows($result2))
                              {
                                while ($row2 = mysqli_fetch_array($result2)) 
                                {
      $sql = "INSERT INTO tips(title,categoryid,point,owner,tdatetime) VALUES ('".$title."','".$cate."','".$point."','".$current_owner."','".$row2['datetime']."')";
      mysqli_query($conn, $sql);

    



                   
                      

                                  

          
    }
  }


    }
}
else 
{

?>

<?php

}


?>

