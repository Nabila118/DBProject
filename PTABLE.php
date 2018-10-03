<?php 
include('server3.php');
if(!isset($_SESSION['userName']))
	header("Location: Sign-In.php");

	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM PRODUCT WHERE id='$id'");
	if (count($record) == 1 ) {
		$n = mysqli_fetch_array($record);
		$id = $n['id'];
		$BRAND = $n['BRAND'];
		$TYPE = $n['TYPE'];
		$SHADE = $n['SHADE'];
		$SIZE = $n['SIZE'];
		$SALES_PRICE = $n['SALES_PRICE'];
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>PRODUCT TABLE</title>
</head>
<body>
<?php 
	if (isset($_SESSION['message'])): ?>
		<div class="msg">
<?php 
	echo $_SESSION['message']; 
	unset($_SESSION['message']);
?>
		</div>
<?php endif ?>

<?php $results = mysqli_query($db, "SELECT * FROM PRODUCT"); ?>

<table>
	<thead>
		<tr>
			<h3 align="center"> PRODUCT TABLE</h3>
			
			<th>PRODUCT CODE</th>
			<th>BRAND</th>
			<th>TYPE</th>
			<th>SHADE</th>
			<th>SIZE</th>
			<th>SALES PRICE</th>
			
	
<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['id']; ?></td>
			<td><?php echo $row['BRAND']; ?></td>
			<td><?php echo $row['TYPE']; ?></td>
			<td><?php echo $row['SHADE']; ?></td>
			<td><?php echo $row['SIZE']; ?></td>
			<td><?php echo $row['SALES_PRICE']; ?></td>
			
			<td>
				<a href="PTABLE.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
			
				<a href="server3.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>
	


<form method="post" action="server3.php" >

	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<div class="input-group">

	<div class="input-group">
		<label> PRODUCT NAME</label>
		<input type="text" name="id" value="<?php echo $id; ?>">
	</div>	

	<div class="input-group">
		<label>BRAND</label>
		<input type="text" name="BRAND" value="<?php echo $BRAND; ?>">
	</div>

	<div class="input-group">
		<label>TYPE</label>
		<input type="text" name="TYPE" value="<?php echo $TYPE; ?>">
	</div>
	<div class="input-group">
		<label>SHADE</label>
		<input type="text" name="SHADE" value="<?php echo $SHADE; ?>">
	</div>
	<div class="input-group">
		<label>SIZE</label>
		<input type="text" name="SIZE" value="<?php echo $SIZE; ?>">
	</div>

	<div class="input-group">
		<label>SALES_PRICE</label>
		<input type="number" name="SALES_PRICE" value="<?php echo $SALES_PRICE; ?>">
	</div>



	<div class="input-group">

		<?php if ($update == true): ?>
			<button class="btn" type="submit" name="update" style="background: #556B2F;" >Update</button>
		<?php else: ?>
			<button class="btn" type="submit" name="save" >Save</button>
		<?php endif ?>
	</div>
</form>
</body>

<style type="text/css">
	body {
   		 font-size: 12px;
	}
	table{
    		width: 80%;
    		margin: 30px auto;
    		border-collapse: collapse;
    		text-align: center;
	}
	tr {
    		border-bottom: 1px solid purple;
	}
	th, td{
    		border: none;
    		height: 30px;
    		padding: 5px;
	}
	tr:hover {
    		background: #F5F5F5;
	}

	form {
    		width: 20%;
    		margin: 50px auto;
   		    text-align: left;
    		padding: 20px; 
    		border: 1px solid purple; 
    		border-radius: 5px;
	}

	.input-group {
    		margin: 10px 0px 10px 0px;
	}
	.input-group label {
    		display: block;
    		text-align: left;
    		margin: 3px;
	}
	.input-group input {
   		height: 30px;
    		width: 93%;
    		padding: 5px 10px;
    		font-size: 16px;
    		border-radius: 5px;
    		border: 1px solid gray;
	}
	.btn {
   		    padding: 10px;
    		font-size: 15px;
    		color: white;
    		background: #5F9EA0;
    		border: none;
    		border-radius: 5px;
	}
	.edit_btn {

    		padding: 2px 5px;
    		background: #2E8B57;
    		color: white;
    		border-radius: 3px;
	}

	.del_btn {
    
   		    padding: 2px 5px;
    		color: white;
    		border-radius: 3px;
    		background: #800000;
	}
	.msg {
   		 		margin: 30px auto; 
   		 	padding: 10px; 
    	         border-radius: 5px; 
		 color: #3c763d; 
    		 background: #dff0d8; 
    		 border: 1px solid #3c763d;
         	 width: 50%;
     		 text-align: center;
	}
</html>