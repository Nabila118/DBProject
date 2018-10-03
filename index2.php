<?php 
include('server2.php');
if(!isset($_SESSION['userName']))
	header("Location: Sign-In.php");

	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM CUSTOMERTABLE WHERE id=$id");
	if (count($record) == 1 ) {
		$n = mysqli_fetch_array($record);
		$id = $n['id'];
		$sname = $n['sname'];
		$cname = $n['cname'];
		$cno = $n['cno'];
		$address = $n['address'];
		$area = $n['area'];
		$gc  = $n['gc']; 
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>CRUD IMPLEMENTATION </title>
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

<?php $results = mysqli_query($db, "SELECT * FROM CUSTOMERTABLE"); ?>

<table>
	<thead>
		<tr>
			<h3 align="center"> CUSTOMER TABLE</h3>
			
			<th>ID</th>
			<th>VENDOR NAME</th>
			<th>CUSTOMER NAME</th>
			<th>CUSTOMER NUMBER</th>
			<th>ADDRESS</th>
			<th>AREA</th>
			<th>CO-ORDINATES</th>
			<th>ACTIONS</th>
	
<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['id']; ?></td>
			<td><?php echo $row['sname']; ?></td>
			<td><?php echo $row['cname']; ?></td>
			<td><?php echo $row['cno']; ?></td>
			<td><?php echo $row['address']; ?></td>
			<td><?php echo $row['area']; ?></td>
			<td><?php echo $row['gc']; ?></td>
			<td>
				<a href="index2.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
			
				<a href="server2.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>
	


<form method="post" action="server2.php" >

	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<div class="input-group">

	<div class="input-group">
		<label> ID</label>
		<input type="text" name="id" value="<?php echo $id; ?>">
	</div>	

	<div class="input-group">
		<label>SELLER NAME</label>
		<input type="text" name="sname" value="<?php echo $sname; ?>">
	</div>

	<div class="input-group">
		<label>CUSTOMER NAME</label>
		<input type="text" name="cname" value="<?php echo $cname; ?>">
	</div>

	<div class="input-group">
		<label>CUSTOMER NUMBER</label>
		<input type="text" name="cno" value="<?php echo $cno; ?>">
	</div>

	<div class="input-group">
		<label>ADDRESS</label>
		<input type="text" name="address" value="<?php echo $address; ?>">
	</div>

	<div class="input-group">
		<label>AREA</label>
		<input type="text" name="area" value="<?php echo $area; ?>">
	</div>

	<div class="input-group">
		<label>CO-ORDINATES</label>
		<input type="text" name="gc" value="<?php echo $gc; ?>">
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
