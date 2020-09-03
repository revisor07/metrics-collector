
<html>


<head>
  <title>Logout</title>

</head>
<body>
<h1>You have been successfully logged out</h1>

<form action="login.php">
    <input type="submit" value="back to login" />
</form>

</body>
</html>
<?php
session_start();
$_SESSION["admin"] = 0;
$_SESSION = array();
session_destroy();


exit();
?>