<?php
$date = date('m/d/Y h:i:s a', time());
$ip = getenv("REMOTE_ADDR"); 

print "<h1> Hello Team Pwned </h1>";
print "Current time: " . $date . ;
print "Your current ip address is: " . $ip . ;

?>