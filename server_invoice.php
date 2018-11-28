<?php
	//session_start();	
	$db=mysqli_connect("localhost","nabila", "nabila118", "Nabila");
		
		$id="";
		$Item_ID="";
		$QUANTITY=0;
		$update= false;	
			

	if (isset($_POST['save'])){
		$invid=$_POST['INVID'];
		$Item_ID = $_POST['Item_ID'];
		$QUANTITY = $_POST['QUANTITY'];
		
	
	$query= "INSERT INTO INVOICE_13113
	(InvoiceID, Item_ID, QUANTITY) VALUES ( '$invid','$Item_ID', $QUANTITY)";
	if(mysqli_query($db, $query))
	$_SESSION['message']="SAVED!";
	else
		$_SESSION['message']=mysqli_error($db);
	header('location: InvoiceHeader.php');
		}

	if (isset($_POST['update'])){
		$id = $_POST['id'];
		$Item_ID = $_POST['Item_ID'];
		$QUANTITY = $_POST['QUANTITY'];
		
	
	mysqli_query($db, "UPDATE INVOICE_13113 
	SET Item_ID = '$Item_ID', QUANTITY= $QUANTITY, WHERE id = '$id'");
	$_SESSION['message']="UPDATED!";
	header('location: InvoiceHeader.php');
	}

	if (isset($_GET['del'])){
	$id = $_GET['del'];
	mysqli_query($db, "DELETE FROM INVOICE_13113 WHERE id='$id'");
	$_SESSION['message']="DELETED!";
    header('location: InvoiceHeader.php');
	}

	//$results = mysqli_query($db,"SELECT I.id,P.id, P.BRAND, I.QUANTITY, P.SALES_PRICE, P.SALES_PRICE*I.QUANTITY AS I.TOTAL FROM INVOICE_13113 I, PRODUCT P WHERE I.Item_ID = P.id");
 ?>
