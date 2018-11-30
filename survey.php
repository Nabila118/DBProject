<!DOCTYPE html>
<html>
<head>
	<title>SURVEY</title><head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
   <title>CSS MenuMaker</title>
</head>
<body>

<div id='cssmenu'>
<ul>
   <li ><a href='home.php'>Home</a></li>
   <li><a href='STABLE.php'>Sales Person</a></li>
   <li><a href='index2.php'>Customer Table</a></li>
   <li><a href='PTABLE.php'>Product Table</a></li>
   <li><a href='UTABLE.php'>User Table</a></li>
   <li><a href='InvoiceHeader.php'>Invoice</a></li>
   <li class='active'><a href='survey.php'>Survey</a></li>
</ul>
</div>
<?php 
	//require_once('conn.php');
	require_once('vendor/autoload.php');
	include('auth.php'); 
	
    
/*	if(!isset($_SESSION['user_session']))
	{
	header("Location: index.php");
	}
*/
	$client = new MongoDB\Client;
	$database = $client->selectDatabase('nabiladb');
	$collection = $database->selectCollection('surveyforms');
	if (isset($_POST['create']))
	{
		$target_dir = "./upload/";
		$target_file = $target_dir.$_FILES["image"]["name"]; //Image:<input type="file" id="pic" name="pic">
		if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)){
		$data = [
			'coordinates' => $_POST['coordinates'],
			'shopName' => $_POST['shopName'],
			'available' => $_POST['available'],
			'front' => $_POST['front'],
			'competitor' => $_POST['competitor'],
			'timestamp' => new MongoDB\BSON\UTCDateTime,
			'image' => $_FILES['image']['name']
		];
		//$tag = $_REQUEST['username'];
			}
			else
			{
				echo 'FILE NOT MOVED!';
				echo '<br>';
				echo $_FILES['image']['tmp_name'];
				echo '<br>';
			    echo $_FILES['image']['name'];
			    echo '<br>';
			    echo $target_file;
			    echo '<br>';
			}
				
		$result = $collection->insertOne($data);
		if($result->getInsertedCount() > 0)
		{
			$_SESSION['success_msg'] = "Form submitted";
			header('location: survey.php');
		}
		else {
			$_SESSION['error_msg'] = "Failed to submit";
			header('location: survey.php');
		}
	}
	if (isset($_GET['delete']))
	{
		$filter = ['_id' => new MongoDB\BSON\ObjectId($_GET['delete'])];
		$form = $collection->findOne($filter);
		if (!$form)
		{
			$_SESSION['error_msg'] = "Form not found";
			header('location: survey.php');
		}
		$filename = 'upload/'.$form['image'];
		if (file_exists($filename))
		{
			if (!unlink($filename))
			{
				//$_SESSION['error_msg'] = "Unable to delete file";
				//header('location: survey.php');
			}
		}
		$result = $collection->deleteOne($filter);
		if ($result->getDeletedCount() > 0)
		{
			$_SESSION['success_msg'] = "Form Deleted";
			header('location: survey.php');
		}
		else
		{
			$_SESSION['error_msg'] = "An error occurred";
			header('location: survey.php');
		}
	}
	if (isset($_SESSION['success_msg']))
    {
        echo '<br><br><div class="bg bg-success">';
        echo '<b>'; echo $_SESSION['success_msg']; echo '</b>';
        unset($_SESSION['success_msg']);
        echo '
        </div>';
    }
	if (isset($_SESSION['error_msg']))
	{
        echo '<br><br><div class="bg bg-danger">';
        echo '<b>'; echo $_SESSION['error_msg']; echo '</b>';
        unset($_SESSION['error_msg']);
        echo '
        </div>';
	}
	?>

<style>
table {
    border-collapse: collapse;
    width: 100%;
}
th, td {
    text-align: left;
    padding: 8px;
}
tr:nth-child(even){background-color: #f2f2f2}
th {
    background-color: #4CAF50;
    color: white;
}
tr:hover {background-color: #f5f5f5;}
input[type=text], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
input[type=submit]:hover {
    background-color: #45a049;
}
test {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}
#cssmenu,
#cssmenu ul,
#cssmenu ul li,
#cssmenu ul li a {
  margin: 0;
  padding: 0;
  border: 0;
  list-style: none;
  line-height: 1;
  display: block;
  position: relative;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
#cssmenu:after,
#cssmenu > ul:after {
  content: ".";
  display: block;
  clear: both;
  visibility: hidden;
  line-height: 0;
  height: 0;
}
#cssmenu {
  width: auto;
  border-bottom: 3px solid #47c9af;
  font-family: Raleway, sans-serif;
  line-height: 1;
}
#cssmenu ul {
  background: #ffffff;
}
#cssmenu > ul > li {
  float: left;
}
#cssmenu.align-center > ul {
  font-size: 0;
  text-align: center;
}
#cssmenu.align-center > ul > li {
  display: inline-block;
  float: none;
}
#cssmenu.align-right > ul > li {
  float: right;
}
#cssmenu.align-right > ul > li > a {
  margin-right: 0;
  margin-left: -4px;
}
#cssmenu > ul > li > a {
  z-index: 2;
  padding: 18px 25px 12px 25px;
  font-size: 15px;
  font-weight: 400;
  text-decoration: none;
  color: #444444;
  -webkit-transition: all .2s ease;
  -moz-transition: all .2s ease;
  -ms-transition: all .2s ease;
  -o-transition: all .2s ease;
  transition: all .2s ease;
  margin-right: -4px;
}
#cssmenu > ul > li.active > a,
#cssmenu > ul > li:hover > a,
#cssmenu > ul > li > a:hover {
  color: #ffffff;
}
#cssmenu > ul > li > a:after {
  position: absolute;
  left: 0;
  bottom: 0;
  right: 0;
  z-index: -1;
  width: 100%;
  height: 120%;
  border-top-left-radius: 8px;
  border-top-right-radius: 8px;
  content: "";
  -webkit-transition: all .2s ease;
  -o-transition: all .2s ease;
  transition: all .2s ease;
  -webkit-transform: perspective(5px) rotateX(2deg);
  -webkit-transform-origin: bottom;
  -moz-transform: perspective(5px) rotateX(2deg);
  -moz-transform-origin: bottom;
  transform: perspective(5px) rotateX(2deg);
  transform-origin: bottom;
}
#cssmenu > ul > li.active > a:after,
#cssmenu > ul > li:hover > a:after,
#cssmenu > ul > li > a:hover:after {
  background: #47c9af;
}

</style>


<h1 align = "middle">Shop Survey</h1>
<hr>

	
	<?php
	$forms = $collection->find();
	foreach($forms as $key => $form){
		$UTCDateTime = new MongoDB\BSON\UTCDateTime((string)$form['timestamp']);
		$DateTime = $UTCDateTime->toDateTime();

		echo '<br><br><br><hr>
		<div class = "rows">
				<div class = "col-md-12">'.$DateTime->format('d/m/Y H:i:s').'</div>
				<div class = "rows">
					<div class = "col-md-3"><img src="upload/'.$form['image'].'" width="720">
					</div>
					
					<div class ="col-md-8">
						<strong>'.$form['shopName'].'</strong>
						<p>Coordinates: '.$form['coordinates'].'</p>
						<p>Are my products available in shop? : '.$form['available'].'</p>
						<p>Are my products positioned in front? : '.$form['front'].'</p>
						<p>Are competitor products more prominent? : '.$form['competitor'].'</p>
					</div>
					
					<div class = "col-md-1"><a href ="survey.php?delete='.$form['_id'].'">Delete</a></div>
					</div>
				</div>
				<br><br><br><hr>';
	} 
	?>




<br><br><br><br>

<div class="test">

<form action = "survey.php" method="post" enctype="multipart/form-data">
 	
<hr>
	<h3 align="middle">Fill Shop Survey Form</h3>

	<p><b>Geographical Coordinates</b>: 
	<input type="text" name="coordinates" size="100" value="" >
	</p>

	<p><b>Shop Name</b>: 
	<input type="text" name="shopName" size="50" value="" />
	</p>

	<p><b>Products Available?</b>: <br>
	<input type="radio" name="available" value="Yes">Yes   
	<input type="radio" name="available" value="No"> No
	</p>

	<p><b>Products positioned in front?</b>: <br>
	<input type="radio" name="front" value="Yes">Yes
	<input type="radio" name="front" value="No">No
	</p>

	<p><b>Competitor products more prominent?</b>: <br>
	<input type="radio" name="competitor" value="Yes">Yes
	<input type="radio" name="competitor" value="No">No
	</p>

	<p><b>Picture</b>: 
	<input type="file" name="image" required>
	</p>

	<input type="submit" name="create" value="Insert" />
<?php 
	echo '
	
</form>
</div>
';
?>