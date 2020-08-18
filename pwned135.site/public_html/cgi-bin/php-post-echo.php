<!DOCTYPE html>
<html><head><title>POST Request Echo</title>
</head><body><h1 align="center">POST Request Echo</h1>
<hr>

<?php
$body = stream_get_contents(STDIN);
print("Message body: $body")


?>
</body>
</html>