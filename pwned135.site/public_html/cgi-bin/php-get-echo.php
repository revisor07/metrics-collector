<html>
<body>

<?php
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$parts = parse_url($url);
echo "test =" . $_GET['test'];
print_r $parts;

?>

</body>
</html>
