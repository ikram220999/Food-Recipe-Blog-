<?php


if(isset($_SESSION['username']))
{
    $current_user = $_SESSION['username'];
    if(isset($_SESSION['submitsearch'])){
      unset($_SESSION['submitsearch']);
    }

    if($conn)
    {
        ?>
          <!DOCTYPE html>
          <html>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          <head>
            <title></title>
          </head>

          <style type="text/css">
            .chat-bar{
                position: fixed;
                bottom: 100px;
                right: 33px;
                
                border-radius: 50%;
                background-color: orange;
                text-align: center;
                
                border: 0px;
                color: white;
                font-weight: 600;
                cursor: pointer;
              }

              .id01{
                width: 350px;
                height: 400px;
                background-color: white;
                position: fixed;
                border-radius: 10px;
                bottom: 195px;
                right: 34px;
                display: none;
                box-shadow: 1px 4px 5px lightgrey;
              }

              .bawah{
                width: 40px;
                height: 40px;
                background-color: white;
                border-radius: 5px;
                transform: rotate(45deg);
                position: fixed;
                bottom: 180px;
                right: 41px;
                box-shadow: 5px 4px 5px lightgrey;
              }
          </style>


          <body>
          <div class="chat-bar">
            <button class="chat-bar" onclick="document.getElementById('id01').style.display='block'"><i style="font-size:24px; padding: 20px; margin: 0;" class="fa">&#xf040;</i></button> 
          </div>

          <div id="id01" class="id01">
            <div class="bawah"></div>

            <span onclick="document.getElementById('id01').style.display='none'"><i style="font-size:20px; position: absolute; margin-left: 305px; margin-top: -5px; cursor: pointer; color: grey;" class="fa">&#xf00d;</i></span>
            <br>
            <center><h4>Send Feedback</h4></center>
            <div style="width: 90%; border: 1px solid orange; margin: auto; margin-top: 10px;"></div>
            
              <center>
              <input type="text" name="title" id="title" placeholder="Title .." style="font-size: 15px; padding-left: 15px; padding-right: 15px; padding-top: 8px; padding-bottom: 8px; width: 80%; margin: auto; margin-top: 20px; border-radius: 5px; border: 1px solid lightgrey;">
              <br>
              <textarea name="point" id="point" style="height: 180px; max-height: 180px; font-size: 15px; padding-left: 15px; padding-right: 15px; padding-top: 8px; padding-bottom: 8px; width: 80%; max-width: 80%; min-height: 180px; min-width: 80%; margin: auto; margin-top: 20px; border-radius: 5px; border: 1px solid lightgrey;" placeholder="Share your tought here .. "></textarea></center>
              <button type="submit" id="submitbtn" style="padding-right: 15px; padding-left: 15px; padding-bottom: 8px; padding-top: 8px; font-size: 15px; border-radius: 5px; border: 0px; background-color: orange; color: white; cursor: pointer; margin-top: 12px; margin-left: 260px;">Send</button>



           
            

          </div>
          <script type="text/javascript">
            $(document).ready(function(){
                    $('#submitbtn').click(function(){
                      var title = $('#title').val();
                      var point = $('#point').val();
                      if($.trim(point) != '')
                      {
                        $.ajax({
                          url:"submitFeedback.php",
                          method:"POST",
                          data:{title:title,point:point},
                          dataType:"text",
                          success:function(data)
                          {
                            alert("Feedback sent !");
                            $('#title').val("");
                            $('#point').val("");
                            
                          }
                        });
                      }
                    }); 

                   
                  });
          </script>
          </body>
          </html>
          
        <?php
    }
}
else 
{

?>

<?php

}


?>

