<?php
// ini_set('display_errors',1);
// ini_set('display_startup_errors',1);
// error_reporting(-1);

	session_start();
	if ($_GET['logout']==1 AND isset($_SESSION['id'])) {
		session_destroy();
		
		$message="You have been logged out. Have a nice day.";
	
	}

	include("connection.php");

	if ($_POST['submit']=="Log In"){
		

		if (!($_POST['username'])) {
			$error="Enter your username !!";
		}

		else {
		
		$_SESSION['category']="";
		$query="SELECT * FROM master_teacher where username='".mysqli_real_escape_string($link,$_POST['username'])."' AND password='".md5(md5($_POST['username']).$_POST['password'])."' LIMIT 1";
		$result=mysqli_query($link,$query);
		$row=mysqli_fetch_array($result);
		if($row) {	
					$_SESSION['id']=$row['id'];
					$_SESSION['username']=$row['username'];
					$_SESSION['category']="teacher";
					// $_SESSION['email']=$row['email'];
					header("Location:teacher.php");
		}

		
		if($_SESSION['category']=="") {
		$query="SELECT * FROM master_student where username='".mysqli_real_escape_string($link,strtoupper($_POST['username']))."' AND password='".md5(md5(strtoupper($_POST['username'])).$_POST['password'])."' LIMIT 1";
		$result=mysqli_query($link,$query);
		$row=mysqli_fetch_array($result);
		if($row){

				// $_SESSION['entryno']=$row['entryno'];
				$_SESSION['id']=$row['id'];
				$_SESSION['username']=$row['username'];
				$_SESSION['category']="student";
				header("Location:student.php");	
		}
		}

		if($_SESSION['category']=="") {
		$query="SELECT * FROM admin_details where username='".mysqli_real_escape_string($link,$_POST['username'])."' AND password='".md5(md5($_POST['username']).$_POST['password'])."' LIMIT 1";
		$result=mysqli_query($link,$query);
		$row=mysqli_fetch_array($result);
		print_r($row);
		if($row){

				// $_SESSION['entryno']=$row['entryno'];
				$_SESSION['id']=$row['id'];
				$_SESSION['username']=$row['username'];
				$_SESSION['category']="admin";
				header("Location:admin.php");	
		}
		}

		if($_SESSION['category']=="") {
			$error="The username or password is incorrect !!";
		}
		
		}
	
	}
?>