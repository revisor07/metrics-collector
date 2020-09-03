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
  <p><a href="logout.php">Logout</a></p>
  <p><a href="home.php">Home</a></p>
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
