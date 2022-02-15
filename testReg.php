<?php

include("dbconnect.php");
?>
<html lang="en">
<head>
<title>Sign up</title>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="img/cookbook.png" type="image/gif">
<link rel="stylesheet" href="css/signup.css" type="text/css" media="screen">

</head>
    <body>
        <form method="post">
            <input type="text" name="username" placeholder="username">
            <input type="password" name="password" placeholder="pass">
            <input type="email" name="email" placeholder="email">
            <button type="submit" name="submit">submit</button>
            
        </form>
    </body>





<?php

if($conn)
{
	 if(isset($_POST['submit']))
   {
         $sql = "INSERT INTO kambing(`username`,`password`,`user_email`,`user_fullname`) VALUES ('".$_POST['username']."','".$_POST['password']."','".$_POST['email']."','default')";

        if (mysqli_query($conn, $sql))
                {
                    echo "<script>window.alert('Succesfully registered !')</script>";
                    echo ("<script type='text/javascript'>window.location.href = 'login.html'</script>");
                }
                else
                {
                    echo "<script>window.alert('Failed registered user !')</script>";
                    echo ("<script type='text/javascript'>window.location.href = 'signup.php'</script>");
                }
      

    }
    else
    {

   

       
    

    
   }
}
 else
      {
          echo "<script>window.alert('Failed connect !')</script>";
          echo ("<script type='text/javascript'>window.location.href = 'signup.php'</script>");
      }



?>

