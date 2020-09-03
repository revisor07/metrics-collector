
<?php
session_start();
echo $_SESSION['auth']; 
if( !isset($_SESSION['auth']) ){
	//echo $_SESSION['auth']; 
	header('Location: /login.php');
	exit();
} ?>

<html>
<head><title> Reporting</title></head>
<body>
<h1>Reporting</h1>
<p>Welcome, <?php echo $_SESSION['username'] ?>!</p>
<p><a href="home.php">Home</a></p>
<p><a href="logout.php">Logout</a></p>
</body>
</html>

