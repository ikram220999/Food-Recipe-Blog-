<?php

session_start();
include("dbconnect.php");
use Telegram\Bot\Api;
if(isset($_SESSION['username']))
{
    $current_user = $_SESSION['username'];
    if(isset($_POST['view']))
    {
    $_SESSION['recipeid'] = $_POST['view'];
    $recipeid = $_SESSION['recipeid'];
    }

    if($conn)
    {
      $sql2 = "SELECT user_teleid FROM user WHERE username = '".$current_user."'";
      $result2 = mysqli_query($conn,$sql2);
        if(mysqli_num_rows($result2))
        {
          while($row2 = mysqli_fetch_array($result2))
          {
            if(!empty($row2['user_teleid']))
            {
              ?>
              <script type="text/javascript">
                console.log('adasdas');
              </script>
              <?php

            $userteleid = $row2['user_teleid'];


            $sql3 = "  SELECT * FROM recipe WHERE recipe_id = '".$_SESSION['recipeid']."' ";
          $result3 = mysqli_query($conn,$sql3);
        if(mysqli_num_rows($result3))
        {
          while($row3 = mysqli_fetch_array($result3))
          { 
              $ingre = nl2br($row3['recipe_ingredient']);
              $step = nl2br($row3['recipe_step']);

              $user_chatid = $userteleid;
              $photo = "http://localhost/recipe/uploads/".$row3['recipe_img']."";
              $data = '*'.$row3['recipe_name'].'*'."\n\n\n".
                      '*Time to complete : *'.$row3['recipe_time'].' minutes '."\n\n\n".
                      '*Ingredients*'."\n\n".
                      ''.$ingre.''."\n\n\n".
                      '*Steps*'."\n\n".
                      ''.$step.'
                      


                      ';



                $data2 = array(

                  '<br>',
                  '<br/>',
                  '<br />',
                );
                $data = str_replace($data2, PHP_EOL, $data);
                   
                      

                                  

                                  
              $parameters = [
                "chat_id" => $user_chatid,
                "text" => $data
              ];

              $bot_token = "< Telegram bot token >";

   
              $botToken="<MY_DESTINATION_BOT_TOKEN_HERE>";

              $website="https://api.telegram.org/bot".$bot_token;
              $chatId=$user_chatid;  //** ===>>>NOTE: this chatId MUST be the chat_id of a person, NOT another bot chatId !!!**
             
              $ch = curl_init($website . '/sendMessage?parse_mode=MARKDOWN&');
              curl_setopt($ch, CURLOPT_HEADER, false);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
              curl_setopt($ch, CURLOPT_POST, 1);
              curl_setopt($ch, CURLOPT_POSTFIELDS, ($parameters));
              curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

              if($result = curl_exec($ch)){
                echo "<script>window.alert('Recipe sent to telegram')</script>";
                curl_close($ch);
                echo "<script> window.location.href='viewrecipe.php'</script>";
                die;
              }
              else
              {
                 echo "<script>window.alert('Recipe not sent succesfully ! ')</script>";
                echo "<script> window.location.href='viewrecipe.php'</script>";
                die;
              }

              $telegram = new Api('< telegram bot token >');
            }


          }
        }
        else{
          echo "<script>window.alert('Please update telegram chat id  ! ')</script>";
                echo "<script> window.location.href='viewrecipe.php'</script>";
                die;
        }


          } #while result2
        } #if result2

      
    }
}
else 
{

 echo "<script>window.alert('semak pala ')</script>";

}


?>


