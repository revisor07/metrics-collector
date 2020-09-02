<?php
session_start();
if( !isset($_SESSION['auth']) || $_SESSION['auth'] != true ){
	header('Location: /login.php');
	exit();
} ?>

<html>
<head><title> Reporting</title></head>
<body>
<h1>Reporting</h1>
<p>Welcome, <?php echo $_SESSION['username'] ?>!</p>
<p><a href="reports.php">Reports</a></p>
<p><a href="logout.php">Logout</a></p>
</body>
</html>

