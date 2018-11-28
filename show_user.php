<?php
	include('server_invoice.php');
	if(isset($_POST['show'])){
		
		
		

					$cid = $_POST['cid'];
					$invid = $_POST['invid'];
					if($cid != "" || $invid != "" || $invid != 'NOT ASSIGNED'){
						$results = mysqli_query($db, "SELECT IH.id, C.id AS CUSTID, C.cname,IH.DATE_CREATED, S.id AS SPID, S.NAME FROM INVOICE_HEADER_13113 IH, CUSTOMERTABLE C,SALESPERSON S WHERE IH.ID='$invid' AND C.id='$cid' AND IH.CUSTOMER_ID=C.id AND IH.CUSTOMER_ID= S.LIST_OF_CUSTOMER_ASSIGNED");
						?>
					<table>
	<thead>
		
			<h3 align="center"> INVOICE HEADER</h3>
			<tr>
			<th>INVOICE ID</th>
			<th>CUSTOMER ID</th>
			<th>CUSTOMER NAME</th>
			<th>DATE</th>
			<th>SALESPERSON ID</th>
			<th>SALESPERSON NAME</th>
			</tr>
			
	
<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['id']; ?></td>
			<td><?php echo $row['CUSTID']; ?></td>
			<td><?php echo $row['cname']; ?></td>
			<td><?php echo $row['DATE_CREATED']; ?></td>
			<td><?php echo $row['SPID']; ?></td>
			<td><?php echo $row['NAME']; ?></td>
		</tr>
	<?php } ?>
</thead>
</table>

			<center><h2 class = "text-primary">INVOICE</h2></center>
			<hr>

					<table>
  <thead>
    <tr>
      <h3 align="center"> SALES LINE ITEM TABLE</h3>
      
      <th>INVOICE ID</th>
      <th>ITEM ID</th>
      <th>BRAND NAME</th>
      <th>QUANTITY</th>
      <th>SALE PRICE</th>
      <th>AMOUNT</th>
</tr>
					<?php
					$results = mysqli_query($db, "SELECT I.id, I.InvoiceID,P.id AS ITEMNAME, P.BRAND, I.QUANTITY, P.SALES_PRICE, P.SALES_PRICE*I.QUANTITY AS TOTAL FROM INVOICE_13113 I, PRODUCT P WHERE I.InvoiceID='$invid' AND I.Item_ID = P.id");
						
					while ($row = mysqli_fetch_array($results)) { ?>

    <tr>

      <td><?php echo $row['InvoiceID']; ?></td>
      <td><?php echo $row['ITEMNAME']; ?></td>
      <td><?php echo $row['BRAND']; ?></td>
      <td><?php echo $row['QUANTITY']; ?></td>
      <td><?php echo $row['SALES_PRICE']; ?></td>
      <td><?php echo $row['TOTAL']; ?></td>
      
      <td>
        <a href="InvoiceHeader.php?edit=<?php echo $row['id'];?>" class="edit_btn" >Edit</a>
      
        <a href="server_invoice.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
      </td>
    </tr>

  <?php } ?>
</thead>
</table>
		<?php
	}}
?>