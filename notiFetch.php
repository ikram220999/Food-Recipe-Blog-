<?php
include("dbconnect.php");

if (isset($_POST['view'])) {
  $sql = "SELECT * FROM notiuser ORDER BY noti_datetime LIMIT 5";
  $result = mysqli_query($conn, $query);
  $output = '';
  if(mysqli_num_rows($result) > 0)
  {
    while ($row = mysqli_fetch_array($result))
    {
      $output .='
        <li>
          <a href="#">
            <strong>'.$row["noti_fromuser"].'asdasdasdasdasdsad</strong><br>
            '.$row['noti_user'].'asdasdasdsads
          </a>
        </li>
      ';
    }
  }
  else
  {
    $output .= '
    <li><a href="#">No notifications</a></li>

    ';
  }
  $sql1 = "SELECT * FROM notiuser WHERE noti_status = 0";
  $result1 = mysqli_query($conn, $sql1);
  $count = mysqli_num_rows($result1);
  $data = array(
    'notification'  => $output,
    'unseen_notification' => $count
  );
  echo json_encode($data);
}



?>