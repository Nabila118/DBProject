<?php
	session_start();	
	$db=mysqli_connect("localhost","nabila", "nabila118", "Nabila");
		
		$id="";
		//$DATE_CREATED='SYSDATE';
		$CUSTOMER_ID="";
		$update= false;	

	if (isset($_POST['save'])){
		$id = $_POST['id'];
		//$DATE_CREATED = date('m/d/Y a', time());
		$CUSTOMER_ID = $_POST['CUSTOMER_ID'];
		
		
	
	
	$query= "INSERT INTO INVOICE_HEADER_13113 
	VALUES ('$id', SYSDATE() , '$CUSTOMER_ID')";
	if(!mysqli_query($db, $query))
		$_SESSION['message']=mysqli_error($db);
	else
	$_SESSION['message']="SAVED!";
	header('location: InvoiceHeader.php');
		}

	
	$results = mysqli_query($db,"SELECT IH.id, C.id AS CUSTID, C.cname,IH.DATE_CREATED, S.id AS SPID, S.NAME FROM INVOICE_HEADER_13113 IH, CUSTOMERTABLE C,SALESPERSON S WHERE IH.CUSTOMER_ID=C.id AND IH.CUSTOMER_ID = S.LIST_OF_CUSTOMER_ASSIGNED");
 ?>