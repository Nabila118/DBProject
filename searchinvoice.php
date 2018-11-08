<?php
	include('serverIH.php');
	$cid = $_POST['searchid'];
	$sql = "SELECT * FROM INVOICE_HEADER_13113 WHERE CUSTOMER_ID = '$cid'";
	$result = mysqli_query($db, $sql);
	echo "<label>INVOICE ID</label>";
	echo "<select type = 'text' id = 'searchinvid' class = 'form-control' name='CUSTOMER ID'>";
	echo "<option value= ''>SELECT INVOICE</option>";
	while ($row = mysqli_fetch_array($result)) {
	echo "<option value='" . $row['id'] ."'>" . $row['id'] ."</option>";
	}
	echo "</select>";
?>


