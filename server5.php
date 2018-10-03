<?php
	session_start();	
	$db=mysqli_connect('localhost', 'root', '','mysql');
		
		$id="";
		$userName="";
		$pass="";
		$Active="";
		$SALES_PERSON="";
		$update= false;	

	if (isset($_POST['save'])){
		$id = $_POST['id'];
		$userName= $_POST['userName'];
		$pass = $_POST['pass'];
		$Active= $_POST['Active'];
		$SALES_PERSON= $_POST['SALES_PERSON'];
		
		
	
	
	$query= "INSERT INTO UserName 
	VALUES ('$id' ,'$userName', '$pass', '$Active', '$SALES_PERSON')";
	mysqli_query($db, $query);
	$_SESSION['message']="SAVED!";
	header('location: UTABLE.php');
		}

	if (isset($_POST['update'])){
		$id = $_POST['id'];
		$userName = $_POST['userName'];
		$pass = $_POST['pass'];
		$Active = $_POST['Active'];
		$SALES_PERSON = $_POST['SALES_PERSON'];
		
	
	
	mysqli_query($db, "UPDATE UserName 
	SET userName = '$userName', pass = '$pass', Active = '$Active',SALES_PERSON = '$SALES_PERSON' WHERE id = '$id'");
	$_SESSION['message']="SAVED!";
	header('location: UTABLE.php');
		}

	if (isset($_GET['del'])){
	$id = $_GET['del'];
	mysqli_query($db, "DELETE FROM UserName WHERE id='$id'");
	$_SESSION['message']="SAVED!";
	header('location: UTABLE.php');
	}

	$results = mysqli_query($db,"SELECT * FROM UserName");
 ?>