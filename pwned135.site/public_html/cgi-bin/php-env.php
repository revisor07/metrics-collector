<!DOCTYPE html>
<html><head><title>Environment Variables</title>
</head><body><h1 align="center">Environment Variables</h1>
<hr>
<?php
$env = getenv();
foreach($env as $var => $value) {
    echo "$var  = $value <br>";
}
?>
</body>
</html>
