<?php
session_start();
if( !isset($_SESSION['auth']) || $_SESSION['auth'] != true || $_SESSION['admin'] == false){
	header('Location: /login.php');
	exit();
} ?>

<html>


<head>
  <title> User Management</title>
  <!--Script Reference-->
  <script src="https://cdn.zinggrid.com/zinggrid.min.js" defer></script>
</head>
<body>
  
<p>Welcome, <?php echo $_SESSION['username'] ?>!</p>

<form action="home.php">
    <input type="submit" value="home" />
</form>
<form action="logout.php">
    <input type="submit" value="logout" />
</form>

<hr>
<h1>User Management Console</h1>
  <!--Grid Component-->
  <!--
  <zing-grid>
    <zg-data src="https://pwned135.site/api/users"></zg-data>
  </zing-grid>
  -->
  <zing-grid src="https://pwned135.site/api/users/" editor editor-controls></zing-grid>



</body>
</html>

