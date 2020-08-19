<!DOCTYPE html>
<html><head><title>POST Request Echo</title>
</head><body><h1 align="center">POST Request Echo</h1>
<hr>

<?php
#print_r($_POST)
#print_r("Message body: $_POST")
foreach($_POST as $key => $value) {
    echo "$key  = $value <br>";
}

?>
</body>
</html>