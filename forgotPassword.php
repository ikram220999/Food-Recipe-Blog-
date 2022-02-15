
<!DOCTYPE html>
<html lang="en">
<head>
<title>Login</title>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="img/cookbook.png" type="image/gif">
<link rel="stylesheet" href="css/login.css" type="text/css" media="screen">





</head>
<body>

  <!--==============================header=================================-->
    
 <div class="main">
      

      <div class="content">
        <div class="cont-login">
          <div class="login">

            <center>
                <br><br><br>
              <form action="" method="post">
                <input class="input" type="email" name="email2" placeholder="Email"><br><br>
             
              
              
              <button class="btn-login" type="submit" name="submit">Reset</button><br><br>
              </form>
              <p style="color: grey; padding-bottom: 5px;">Already remember password?</p><a class="fgt-pass" href="login.html">Login</a>
            </center>
              <br>
            <center>
              <p class="sign-up">Do not have account yet ?&nbsp;&nbsp; <a class="fgt-pass" href="signup.php">Sign Up</a></p>
              <br>

             <p class="foot">Developed by Ikram , 2021</p>
            </center>
          </div>
        </div>

        <div class="picture">
          <div class="image">
              <img src="img/cookbook.png">

          </div>
             <center>
                  <p class="contact">
                    <a class="contact" href="###">FAQ</a> &nbsp;&nbsp;
                    <a class="contact" href="###">Privacy & Terms</a> &nbsp;&nbsp;
                    <a class="contact" href="contact.html">Contact</a> &nbsp;&nbsp;
                  </p>
              </center>
        </div>


        

        
      </div>

      
</div>

 
    




    


<!--==============================footer=================================-->
<footer>
  
</footer>
</body>
<?php
    include('dbconnect.php');
    ini_set('display_errors',1);
    error_reporting(E_ALL);
    
    function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
        return $randomString;
    }
    
    if(isset($_POST['email2'])){
        
    
    $sql2 = "SELECT * FROM user WHERE user_email = '".$_POST['email2']."' ";
    $result2 = mysqli_query($conn,$sql2);
                              if(mysqli_num_rows($result2))
                              {
                                while ($row2 = mysqli_fetch_array($result2)) 
                                {
                                    $newpass = generateRandomString();
                                        
                                    $from = "support@cookbook22.com";
                                    $to = $row2['user_email'];
                                    
                                    
                                    $subject = "Password Reset";
                                    
                                    $message = "Hi there".PHP_EOL."We successfuly reset your password :)".PHP_EOL."Below is your new password"
                                    .PHP_EOL."Username : ".$row2['username'].PHP_EOL."New password : ".$newpass."";
                                    
                                    $sql = "UPDATE user SET password='".$newpass."' WHERE username='".$row2['username']."' ";
                                     if (mysqli_query($conn, $sql))   
                                    {
                                        $headers = "From:".$from;
                                    
                                        mail($to,$subject,$message,$headers);
                                    
                                   
                                      echo "<script>window.alert('New password sent to email !')</script>";
                                      echo ("<script type='text/javascript'>window.location.href = 'login.html'</script>");
                                    }
                                    
                                   
                                }
                              }
    }


?>

