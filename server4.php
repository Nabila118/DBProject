<?php
	session_start();	
	$db=mysqli_connect("localhost","nabila", "nabila118", "Nabila");
		
		$id="";
		$NAME="";
		$CONTACT_NUMBER="";
		$LIST_OF_CUSTOMER_ASSIGNED="";
		$update= false;	

	if (isset($_POST['save'])){
		$id = $_POST['id'];
		$NAME = $_POST['NAME'];
		$CONTACT_NUMBER = $_POST['CONTACT_NUMBER'];
		$LIST_OF_CUSTOMER_ASSIGNED = $_POST['LIST_OF_CUSTOMER_ASSIGNED'];
		
		
	
	if($LIST_OF_CUSTOMER_ASSIGNED == "")
		$query= "INSERT INTO SALESPERSON 
	VALUES ('$id' ,'$NAME', '$CONTACT_NUMBER', NULL)";
	else
		$query= "INSERT INTO SALESPERSON 
		VALUES ('$id' ,'$NAME', '$CONTACT_NUMBER', '$LIST_OF_CUSTOMER_ASSIGNED')";
	mysqli_query($db, $query);
	$_SESSION['message']="SAVED!";
	header('location: STABLE.php');
		}

	if (isset($_POST['update'])){
		$id = $_POST['id'];
		$NAME = $_POST['NAME'];
		$CONTACT_NUMBER = $_POST['CONTACT_NUMBER'];
		$LIST_OF_CUSTOMER_ASSIGNED = $_POST['LIST_OF_CUSTOMER_ASSIGNED'];
		
	
	
	mysqli_query($db, "UPDATE SALESPERSON 
	SET NAME = '$NAME', CONTACT_NUMBER = '$CONTACT_NUMBER', LIST_OF_CUSTOMER_ASSIGNED = '$LIST_OF_CUSTOMER_ASSIGNED' WHERE id = '$id'");
	$_SESSION['message']="SAVED!";
	header('location: STABLE.php');
		}

	if (isset($_GET['del'])){
	$id = $_GET['del'];
	mysqli_query($db, "DELETE FROM SALESPERSON WHERE id='$id'");
	$_SESSION['message']="SAVED!";
	header('location: STABLE.php');
	}

	$results = mysqli_query($db,"SELECT * FROM SALESPERSON");
 ?>