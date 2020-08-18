<!DOCTYPE html>
<html><head><title>POST Request Echo</title>
</head><body><h1 align="center">POST Request Echo</h1>
<hr>

<?php
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$query = parse_url($url, PHP_URL_QUERY);
$body = stream_get_contents(STDIN);
#print_r(body)

print("<b>HTTP Protocol: </b> $_SERVER[SERVER_PROTOCOL] <br>");

print("<b>HTTP Method: </b> $_SERVER[REQUEST_METHOD] <br>");

print("<b>Query String: </b> $query <br>");

print("<b>Message Body:");
foreach($_POST as $key => $value) {
    echo "$key  = $value <br>";
}




?>
</body>
</html>