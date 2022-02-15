<?php
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
//session_cache_limiter('public'); // works too
session_start();
include("dbconnect.php");

if(isset($_SESSION['username']))
{
    $current_user = $_SESSION['username'];
    if(isset($_POST['view']))
    {
    $_SESSION['recipeid'] = $_POST['view'];
    $recipeid = $_SESSION['recipeid'];
    }

    if (isset($_SESSION['recipeid2'])) {
      $recipeid =  $_SESSION['recipeid2'];
    }

    if($conn)
    {
    ?>
        <html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style> 
      *{
        font-family: Helvetica;
      }
  
 
    @media print{
      #print {
        font-family: Helvetica;
        display:none;
      }
    }
    @media print {
      #PrintButton {
        display: none;
      }
    }
 
    @page {
      size: auto;   /* auto is the initial value */
      margin: 0;
      margin-left: 10px;
      margin-right: 10px; /* this affects the margin in the printer settings */
    }

    .line{
      width: 100%;
      border: 1px dashed #dd7230;
    }

    table td{
      width: 400px;
    }

    .prnt{
      position: fixed;
      right: 30px;
      bottom: 50px;
      font-size: 17px;
      padding-left: 20px;
      padding-right: 20px;
      padding-top: 5px;
      padding-bottom: 5px;
      background-color: #73b504;
      color: white;
      border: 2px solid #73b504;
      border-radius: 10px;
      cursor: pointer;
    }

    .prnt:hover{
      color: black;
      border:2px solid black;
      opacity: 0.8;
    }

    .kambing img{
      border-radius: 20px;
    }
  </style>
  </head>
<body>
  <center><img src="img/logo.png" width="200" height="70">
    <div class="line"></div>

  <?php

  $sql = "SELECT * FROM recipe WHERE recipe_id = '".$_POST['recipeid']."' ";
  $result = mysqli_query($conn,$sql);
  if(mysqli_num_rows($result))
  {
    while($row = mysqli_fetch_array($result))
    {
      


      ?>
      <br>
      <table class="kambing">
        <tr>
          <td rowspan="3" style="width: 150px; justify-content: center; align-items: center;" ><img src="<?php echo $row['recipe_img']; ?>" width='250' height='200'>
            <td style="font-size: 20px; height: 30px; text-align: center; padding-left: 20px;"><strong><?php echo $row['recipe_name']; ?></strong></td>

        </tr>
        <tr>
          <td style="text-align: center; padding-left: 20px; font-size: 13px;"><i><?php echo $row['recipe_description']; ?></i>/td>
        </tr>
        <tr>
          <td style="text-align: center; padding-left: 20px;"><strong><?php echo $row['recipe_time']; ?> Minutes</strong></td>
        </tr>
      </table>
      <br>

      <table>
        <center>
        <tr>
          <td style="font-weight: 600; border-bottom: 1px dashed #dd7230; text-align: center; padding-bottom: 20px;">Ingredients</td>
          <td style="font-weight: 600; border-bottom: 1px dashed #dd7230; text-align: center;">Steps</td>
        </tr></center>
        <tr>
          <td style="font-size: 15px;"><?php echo nl2br($row['recipe_ingredient']); ?></td>
          <td style="font-size: 13px;"><?php  echo nl2br($row['recipe_step']); ?></td>
        </tr>

      </table>



      <?php
    }

  } 




  ?>








  </center>

  
  <b style="color: grey; position: fixed; bottom: 10px; right: 10px; font-size: 12px;">Date Prepared: 
  <?php
    $date = date("Y-m-d", strtotime("+6 HOURS"));
    echo $date;
  ?>
  </b><br /><br />
  
  <center><button id="PrintButton" class="prnt" onclick="PrintPage()"><i style="font-size:20px" class="fa">&#xf02f;</i> Print</button></center>
</body>
<script type="text/javascript">
  function PrintPage() {
    window.print();
  }
</script>
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


