<?php
include('connection.php');
session_start();
$res=mysqli_query($con,"update answer set status='closed' where user_id='$_SESSION[uid]'");

if($res)
{
	
	// $myfile = fopen("ML/stop_signal.txt", "w") or die("Unable to open file!");
	// $txt = "a";
	// fwrite($myfile, $txt);
	// fclose($myfile);

	$myfile = fopen("ML/a.txt", "w") or die("Unable to open file!");
	$txt = "1";
	fwrite($myfile, $txt);
	fclose($myfile);


	header('location:exam.php');
}


?>