<?php
session_start();
include('dbconnect.php');
use Telegram\Bot\Api;

if(isset($_SESSION['username']))
{
    $current_user = $_SESSION['username'];
    if(isset($_SESSION['submitsearch'])){
      unset($_SESSION['submitsearch']);
    }

    if($conn)
    {
      $title = $_POST['title'];
      $point = $_POST['point'];
      $sql2 = "SELECT CURRENT_TIMESTAMP AS `datetime` ";
      $result2 = mysqli_query($conn,$sql2);
                              if(mysqli_num_rows($result2))
                              {
                                while ($row2 = mysqli_fetch_array($result2)) 
                                {
      $sql = "INSERT INTO feedback(username,title,feedback_input,fdatetime) VALUES ('".$current_user."','".$title."','".$point."','".$row2['datetime']."')";
      mysqli_query($conn, $sql);

      $user_chatid = "2129360099";
              
              $data = '*From  : *'.$current_user.''."\n\n".
                      '*Title : *'.$title.''."\n\n".
                      '*Feedback :*'."\n\n".
                      ''.$point.''."\n\n\n".
                      '
                      


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

              $bot_token = "5011382049:AAH3kaCy8GM8QIAreOMlQGSaGSJFBQ94aV8";

   
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
                
                curl_close($ch);
                
                die;
              }
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

