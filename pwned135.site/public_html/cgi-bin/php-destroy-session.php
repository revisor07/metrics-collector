<!DOCTYPE html>
<html>
  <title>Perl Session Destroyed</title>
<body>

<?php
// remove all session variables
session_unset();

// destroy the session
session_destroy();
?>

<h1>Session Destroyed</h1>
<a href=/cgi-bin/php-cgiform.php>Back to the PHP CGI Form</a><br />
<a href=/cgi-bin/php-sessions-1.php>Back to Page 1</a><br />
<a href=/cgi-bin/php-sessions-2.php>Back to Page 2</a>
</body>
</html>