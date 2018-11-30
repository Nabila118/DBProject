<?php
header('Content-Type: application/json');
	session_start();	
	$db=mysqli_connect('localhost', 'nabila', 'nabila118','Nabila');

	$result = mysqli_query($db, "SELECT Item_ID, SUM(QUANTITY) FROM INVOICE_13113 group by Item_ID");
	while ($row = mysqli_fetch_array($result)) {
			$orders[] = array(
			'ITEM_ID' => $row['Item_ID'],
			'Quantity' => $row['SUM(QUANTITY)']
		  );
	}

	echo json_encode($orders);
	?>
	