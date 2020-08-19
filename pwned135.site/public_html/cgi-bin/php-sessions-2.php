<?php
session_id("session2");
session_start();
?>

<!DOCTYPE html>
<html>
  <head><title>Perl Sessions</title></head>
<body>
  <h1>Perl Sessions Page 2</h1>
  <?php
  $name = $_POST["username"];
  $cookie_name = "username";
  $cookie_value = $name;
  if (isset($_COOKIE[$cookie_name])){
  	print("<p><b>Name:</b> $_COOKIE[$cookie_name]");}
  else{
	print "<p><b>Name:</b> You do not have a name set</p>";
  }
  ?>
  <br>
  <br>
  <a href="/cgi-bin/php-sessions-1.php">Session Page 1</a><br>
  <a href="/cgi-bin/php-state-demo.php">Perl CGI Form</a><br>
  <form style="margin-top:30px" action="/cgi-bin/php-destroy-session.php" method="get">
  <button type="submit">Destroy Session</button></form>

</body>
</html>