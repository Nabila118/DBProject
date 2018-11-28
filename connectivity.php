<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'mysql');
define('DB_USER','root');
define('DB_PASSWORD','');

$con=mysqli_connect("localhost","nabila", "nabila118", "Nabila");
//$db=mysqli_select_db(DB_NAME) or die("Failed to connect to MySQL: " . mysql_error());
/*
$ID = $_POST['user'];
$Password = $_POST['pass'];
*/
function SignIn($con)
{
session_start();
   
if(!empty($_POST['user']))   //checking the 'user' name which is from Sign-In.html, is it empty or have some text
{
	$query = mysqli_query($con, "SELECT *  FROM UserName where userName = '$_POST[user]' AND pass = '$_POST[pass]'");
	$row = mysqli_fetch_assoc($query);
	//echo $row['pass'];

	if(!empty($row['userName']) AND !empty($row['pass']))
	{
		$_SESSION['userName'] = $row['pass'];
		header('Location: home.php');

	}
	else
		header("Location: Sign-In.php");
	//echo "jgcghvg";
}
}
if(isset($_POST['submit']))
{
	SignIn($con);
}

?>




