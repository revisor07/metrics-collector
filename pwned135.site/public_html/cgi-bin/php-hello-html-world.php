<!DOCTYPE html>
<html>
<body>
<?php
$date = date('m/d/Y h:i:s a', time());
$ip = $_SERVER['REMOTE_ADDR'];

print "<h1> Hello Team Pwned </h1>";
print "Current time: " . $date . "<br>";
print "Your current ip address is: " . $ip . "<br>";

?>

<!DOCTYPE html>
<html>
<body>