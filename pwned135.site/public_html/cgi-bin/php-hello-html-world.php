<!DOCTYPE html>
<html>
<body>
<?php
date_default_timezone_set('America/Los_Angeles');
$date = date('m/d/Y h:i:s a', time());
$ip = $_SERVER['REMOTE_ADDR'];

print "This page was generated with the PHP programming langauge"
print "<h1> Hello Team Pwned </h1>";
print "Current time: " . $date . "<br>";
print "Your current ip address is: " . $ip . "<br>";

?>

</body>
</html>
