<?php
	session_start();	
	$db=mysqli_connect('localhost', 'root', '','mysql');
		
		$id="";
		$sname="";
		$cname="";
		$cno="";
		$address="";
		$area="";
		$gc="";
		$update= false;	

	if (isset($_POST['save'])){
		$id = $_POST['id'];
		$sname = $_POST['sname'];
		$cname = $_POST['cname'];
		$cno = $_POST['cno'];
		$address = $_POST['address'];
		$area = $_POST['area'];
		$gc = $_POST['gc'];
	
	
	$query= "INSERT INTO CUSTOMERTABLE 
	VALUES ('$id' ,'$sname', '$cname', '$cno', '$address', '$area', '$gc')";
	mysqli_query($db, $query);
	$_SESSION['message']="SAVED!";
	header('location: index2.php');
		}

	if (isset($_POST['update'])){
		$id = $_POST['id'];
		$sname = $_POST['sname'];
		$cname = $_POST['cname'];
		$cno = $_POST['cno'];
		$address = $_POST['address'];
		$area = $_POST['area'];
		$gc = $_POST['gc'];
	
	
	
	mysqli_query($db, "UPDATE CUSTOMERTABLE 
	SET sname = '$sname', cname = '$cname', cno = '$cno', address = '$address', area = '$area', gc = '$gc' WHERE id = $id");
	$_SESSION['message']="SAVED!";
	header('location: index2.php');
		}

	if (isset($_GET['del'])){
	$id = $_GET['del'];
	mysqli_query($db, "DELETE FROM CUSTOMERTABLE WHERE id=$id");
	$_SESSION['message']="SAVED!";
	header('location: index2.php');
	}

	$results = mysqli_query($db,"SELECT * FROM CUSTOMERTABLE");
 ?>
