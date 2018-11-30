<?php 
include('serverIH.php');
if(!isset($_SESSION['userName']))
	header("Location: Sign-In.php");

?>

<!DOCTYPE html>

<html>
<head>

	<title>INVOICE HEADER</title>
</head>

<body>
	<div id='cssmenu'>
<ul>
   <li ><a href='home.php'>Home</a></li>
   <li ><a href='STABLE.php'>Sales Person</a></li>
   <li><a href='index2.php'>Customer Table</a></li>
   <li><a href='PTABLE.php'>Product Table</a></li>
   <li><a href='UTABLE.php'>User Table</a></li>
   <li class='active'><a href='InvoiceHeader.php'>Invoice</a></li>
   <li><a href='survey.php'>Survey</a></li>
</ul>
</div>
	
	<center><h2 class = "text-primary">SELECT CUSTOMER</h2></center>
					<hr>
					<form  id = "invform" class = "form-horizontal">
						<div class = "form-group">
							<label>CUSTOMER ID</label>
							<?php
									$sql = "SELECT id FROM CUSTOMERTABLE";
									$result = mysqli_query($db, $sql);
									echo "<select type = 'text' id = 'searchid' class = 'form-control'>";
									if(isset($_GET[id]))
										echo "<option value= '".$_GET[id]."'>".$_GET[id]."</option>";
									else
										echo "<option value= ''>SELECT CUSTOMER</option>";
									while ($row = mysqli_fetch_array($result)) {
										echo "<option value='" . $row['id'] ."'>" . $row['id'] ."</option>";
									}
							
								
									echo "</select>";
							?>
						</div>
						<div class = "form-group">
							<div id = "searchinv"></div>
						</div>
					</form>
					<div id = "userTable"></div>


<?php 
	if (isset($_SESSION['message'])): ?>
		<div class="msg">
<?php 
	echo $_SESSION['message']; 
	unset($_SESSION['message']);
?>
		</div>
<?php endif ?>


	
<form method="post" action="serverIH.php" >

	<input type="hidden" name="id" value="<?php echo $id; ?>">
	

	<div class="input-group">
		<label> INVOICE ID</label>
		<input type="text" name="id" value="<?php echo $id; ?>">
	</div>	

	<div class="input-group">
		<label>CUSTOMER ID</label>
		<input type="text" name="CUSTOMER_ID" value="<?php echo $CUSTOMER_ID; ?>">
	</div>

	

	<div class="input-group">

		<?php if ($update == true): ?>
			<button class="btn" type="submit" name="update" style="background: #556B2F;" >Update</button>
		<?php else: ?>
			<button class="btn" type="submit" name="save" >Save</button>
		<?php endif ?>
	</div>
</form>
</div>
</body>

<?php include('invoice2.php') ?>
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
</style>
</html>