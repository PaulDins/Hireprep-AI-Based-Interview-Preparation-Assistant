<?php
session_start();
include('connection.php');

// Connect to server and select databse.


// username and password sent from form 
$myusername=$_POST['email']; 
$mypassword=$_POST['password']; 


if(isset($_POST['login']))
{

if($myusername=="admin@gmail.com" and $mypassword=="admin")
{
		$_SESSION['user']="admin";
		$_SESSION['name']="admin";
		header("location:admin/dashboard/dashboard.php");
}
else{

	$sel="SELECT * FROM user WHERE email='$myusername' and password='$mypassword'";
	echo $sel;
	$result = mysqli_query($con,$sel) or die(mysql_error());
	$rows = mysqli_num_rows($result);
	$row=mysqli_fetch_array($result);
	
	if($rows>0)
	{	
		//save user_id
		$myfile = fopen("user_id.txt", "w") or die("Unable to open file!");
		$txt = $row['id'];
		fwrite($myfile, $txt);
		fclose($myfile);
		
		$_SESSION['user']='user';
		$_SESSION['uid']=$row['id'];
		$_SESSION['name']=$row['name'];
		header("location:index1.php");
		
	}
	else{
		header("location:login.php?st=fail");
	}

}

}

?>
 
 



