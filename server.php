<?php
	$db=mysqli_connect('localhost', 'root', '','mysql');
		$id="";
		$sname="";
		$cname="";
		$cno="";
		$address="";
		$area="";
		$gc="";
		$id = 0;
		$update= false;

	if (isset($_POST['save'])){
		$id = $_POST['id'];
		$sname = $_POST['sname'];
		$cname = $_POST['cname'];
		$cno = $_POST['cno'];
		$address = $_POST['address'];
		$area = $_POST['area'];
		$gc = $_POST['gc'];
	
	}
	$query= "INSERT INTO CUSTOMERTABLE (id, sname, cname, cno, address, area, gc) 
	values ('$id' ,'$sname', '$cname', '$cno', '$address', '$area', '$gc')";
	mysqli_query($db, $query);
	$_SESSION['message']="SAVED!";
	header('location: penguin.php');
	$results = mysqli_query($db,"SELECT * FROM CUSTOMERTABLE"); ?>
