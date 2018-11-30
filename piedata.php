<?php
header('Content-Type: application/json');
	session_start();	
	$db=mysqli_connect('localhost', 'nabila', 'nabila118','Nabila');

	$result = mysqli_query($db, "SELECT I.Item_ID, SUM(I.QUANTITY*P.SALES_PRICE) FROM INVOICE_13113 I, PRODUCT P WHERE I.Item_ID=P.id group by Item_ID");
	while ($row = mysqli_fetch_array($result)) {
			$orders[] = array(
			'ITEM_ID' => $row['Item_ID'],
			'AMOUNT' => $row['SUM(I.QUANTITY*P.SALES_PRICE)']
		  );
	}

	echo json_encode($orders);
	?>
	