<!DOCTYPE html>
<html><head><title>GET Request Echo</title>
</head><body><h1 align="center">Get Request Echo</h1>

<?php
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$parts = parse_url($url);
parse_str($parts['query'], $query);
echo parse_url($url, PHP_URL_QUERY); 
foreach($query as $key => $value) {
    echo "$key  = $value <br>";
}

?>

</html>
