<!DOCTYPE html>
<html><head><title>Environment Variables</title>
</head><body><h1 align="center">Environment Variables</h1>
<hr>
<?php

$env = getenv();
print("<h2>Environment Variables:</h2>");

foreach($env as $var => $value) {
    echo "<b>$var</b>  = $value <br>";
}
print("<h2>Server Variables:</h2>");
foreach($_SERVER as $var => $value) {
    echo "<b>$var</b>  = $value <br>";
}
?>
</body>
</html>
