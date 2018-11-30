<?php
if(isset($_SESSION['userName']))
	header("Location: home.php");
?>
<html>
<head>
<title>Sign-In</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

  <div class="wrapper">
	<div class="container">
		<h1>Welcome</h1>
<form method="POST" action="connectivity.php">
User <br><input type="text" name="user" size="40"><br>
Password <br><input type="password" name="pass" size="40"><br>
<input id="login-button" type="submit" name="submit" value="Log-In">
</form>
</div>
<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>
</body>


<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script type="text/javascript">
	 $("#login-button").click(function(event){
		 
	 
	 $('form').fadeOut(500);
	 $('.wrapper').addClass('form-success');
});
</script>
</html> 







