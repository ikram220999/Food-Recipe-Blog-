<?php
session_start();
include("dbconnect.php");
require_once __DIR__ . '/vendor/autoload.php';

//grab variable from post
$recipeid = $_POST['recipeid'];
//create new PDF instance
		$mpdf = new \Mpdf\Mpdf();


if(isset($_SESSION['username']))
{		
	$sql = "SELECT * FROM recipe WHERE recipe_id = '".$recipeid."' ";
	$result = mysqli_query($conn,$sql);
	if(mysqli_num_rows($result))
	{
		while($row = mysqli_fetch_array($result))
		{ 
			$rec_name = $row['recipe_name'];
			$rec_desc = $row['recipe_description'];
			$rec_time = $row['recipe_time'];
			$rec_ingredient = $row['recipe_ingredient'];
			$rec_step = $row['recipe_step'];
			$sql2 = "SELECT CURRENT_TIMESTAMP AS `datetime` ";
	      	$result2 = mysqli_query($conn,$sql2);
	                              if(mysqli_num_rows($result2))
	                              {
	                                while ($row2 = mysqli_fetch_array($result2)) 
	                                {
	                                	$date_download = $row2['datetime'];
	                                }
	                              }
			

		}
	}
										//create out PDF
										$data = '';

										$data .= '<strong><h1>'.$rec_name.'</h1></strong><br><br>';
										$data .= ''.$rec_desc.'<br><br>';
										$data .= '<h3>'.$rec_time.' Minutes</h3><br><br>';
										$data .= '<h3>Ingredient</h3><br>';
										$data .= ''.nl2br($rec_ingredient).'<br><br>';
										$data .= '<h3>Step</h3><br>';
										$data .= ''.nl2br($rec_step).'<br><br>';
										$data .= '<br><br><br><br><br>';
										$data .= ''.$date_download.'<br><br>';

										$data = mb_convert_encoding($data, 'UTF-8', 'UTF-8');
										//white pdf
										$mpdf->WriteHTML($data);

										//output to browser
										$mpdf->Output('myfile.pdf', 'D');
}
		
?>