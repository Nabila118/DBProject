<?php
	session_start();	
	$db=mysqli_connect("localhost","nabila", "nabila118", "Nabila");
		
		$id="";
		$BRAND="";
		$TYPE="";
		$SHADE="";
		$SIZE="";
		$SALES_PRICE = 0;
		$update= false;	

	if (isset($_POST['save'])){
		$id = $_POST['id'];
		$BRAND = $_POST['BRAND'];
		$TYPE = $_POST['TYPE'];
		$SHADE = $_POST['SHADE'];
		$SIZE = $_POST['SIZE'];
		$SALES_PRICE = $_POST['SALES_PRICE'];
		
	
	
	$query= "INSERT INTO PRODUCT 
	VALUES ('$id' ,'$BRAND', '$TYPE', '$SHADE','$SIZE', $SALES_PRICE)";
	mysqli_query($db, $query);
	$_SESSION['message']="SAVED!";
	header('location: PTABLE.php');
		}

	if (isset($_POST['update'])){
		$id = $_POST['id'];
		$BRAND = $_POST['BRAND'];
		$TYPE = $_POST['TYPE'];
		$SHADE = $_POST['SHADE'];
		$SIZE = $_POST['SIZE'];
		$SALES_PRICE = $_POST['SALES_PRICE'];
		
	
	
	
	mysqli_query($db, "UPDATE PRODUCT 
	SET BRAND = '$BRAND', TYPE = '$TYPE', SIZE = '$SIZE', SALES_PRICE = $SALES_PRICE WHERE id = '$id'");
	$_SESSION['message']="SAVED!";
	header('location: PTABLE.php');
		}

	if (isset($_GET['del'])){
	$id = $_GET['del'];
	mysqli_query($db, "DELETE FROM PRODUCT WHERE id='$id'");
	$_SESSION['message']="SAVED!";
	header('location: PTABLE.php');
	}

	$results = mysqli_query($db,"SELECT * FROM PRODUCT");
 ?>