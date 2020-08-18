<html>
<body>

<?php
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$parts = parse_url($url);
parse_str($parts['query'], $query);
#echo "test =" . $_GET['test'];
foreach($query as $key => $value) {
    echo "$key  = $value <br>";
}

?>

</body>
</html>
