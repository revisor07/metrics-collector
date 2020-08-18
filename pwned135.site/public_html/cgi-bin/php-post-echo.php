<!DOCTYPE html>
<html><head><title>POST Request Echo</title>
</head><body><h1 align="center">POST Request Echo</h1>
<hr>

<?php
$body = stream_get_contents(STDIN);
print(body)

$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$parts = parse_url($url);
parse_str($parts['query'], $query);
echo "<b>Query String: </b>" . parse_url($url, PHP_URL_QUERY) . "<br>"; 
foreach($query as $key => $value) {
    echo "$key  = $value <br>";
}

?>
</body>
</html>