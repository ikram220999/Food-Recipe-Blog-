<?php
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
//session_cache_limiter('public'); // works too
session_start();
include("dbconnect.php");



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
          <link rel="stylesheet" href="css/viewrecipe.css" type="text/css" media="screen">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          <style type="text/css">
            
            input{
              width: 200px;
              padding-top: 8px;
              padding-bottom: 8px;
              padding-left: 15px;
              padding-right: 15px;
              margin-top: 10px;
              border-radius: 10px;
              border: 1px solid grey;
            }

            button{
              margin-top: 20px;
              width: 230px;
              padding-top: 10px;
              padding-bottom: 10px;
               border-radius: 10px;
              border: 0px;
              background-color: orange;
              cursor: pointer;
            }
            button:hover{
              opacity: 0.9;
            }

            table{
              margin: auto;
              border: 1px solid grey;
              margin-bottom: 50px;
            }

           tr,td{
            border: 1px solid lightgrey;
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 20px;
            padding-right: 20px;
           }

          </style>

          <body>
            
          
            <div style="width: 300px; margin: auto; margin-top: 50px; justify-content: center; text-align: center; padding-top: 20px; padding-bottom: 50px; border: 1px solid lightgrey; border-radius: 10px;">
              <img src="img/logo.png" width="300">
             
            
              <form method="post">
                <input type="text" name="password" placeholder="keyword">
                <button type="submit" name="login" >Enter</button>
              </form>
            </div>

          </body>
          <br><br>
       


          <?php
          if(isset($_POST['login']) && ($_POST['password']) == 'ikramhensem'){
            ?>
            <table>
                                <tr style="font-weight: 600; padding-bottom: 5px; padding-top: 5px;">
                                      
                                      <td>Bil. </td>
                                      <td>User </td>
                                      <td>Feedback</td>
                                      <td>Date time</td>

                                    </tr>

            <?php

            $sql = "SELECT * FROM feedback ORDER BY fdatetime DESC";
            $result = mysqli_query($conn,$sql);
                              if(mysqli_num_rows($result))
                              {
                                $count = 1;
                                while ($row = mysqli_fetch_array($result)) 
                                {
                                  ?>
                                  
                                    <tr>
                                      <td><?php echo $count; ?></td>
                                      <td style="width: 100px;"><?php echo $row['username']; ?></td>
                                      <td style="max-width: 400px; min-width: 200px; "><?php echo $row['feedback_input']; ?></td>
                                      <td><?php echo $row['fdatetime']; ?></td>
                                    </tr>

                                  


                                  <?php
                                  $count++;
                                }
                              }

                              ?>
                              </table>
                              <?php
          }





    }



?>


