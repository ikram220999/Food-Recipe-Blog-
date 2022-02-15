<?php
include("dbconnect.php");
$uname=$_POST['username'];
$pass=$_POST['password'];

session_start();




if(isset($_REQUEST['submit'])){

	$_SESSION['username'] = $uname;

	$sql="select * from user where username='".$uname."' and password= '".$pass."' limit 1"; 

	$result=mysqli_query($conn,$sql);

	if (mysqli_num_rows($result)==1) {
		
				$online  = true;
				$sql2 = "UPDATE `user_online` SET `online_status`= '".$online."' WHERE username = '".$_SESSION['username']."'";
				if (mysqli_query($conn, $sql2))   
					{
						echo "<script>window.alert('Welcome ".$_SESSION['username']." ')</script>";
						echo "<script> window.location.href='homeuser.php' </script>";
						die;
					}
					else
					{
								echo "<script>window.alert('Sorry , online status invalid ')</script>";
								echo "<script> window.location.href='login.html' </script>";
					}	

	}
	else{
		echo "<script>window.alert('Sorry , username or password you entered is wrong ')</script>";
		echo "<script> window.location.href='login.html' </script>";
				die;

	}
}
?>

