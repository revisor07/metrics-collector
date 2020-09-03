<?php

$conn = new mysqli("localhost","root","","logs");

// Check connection
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}


session_start();
if ( isset($_SESSION['auth']) && $_SESSION['auth'] == true ){
	header("Location: /home.php");
	exit();
}

//hook up to database and hash pwds before storage
//$creds = [
//	"admin" => "admin",
//	"snake" => "snake"
//];

$error = "";
$username = "";

if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
	if ( empty(trim($_POST["username"])) ) {
		$error = "Enter your username.";
	} else {
		$username = trim($_POST["username"]);
		$sql = "select password from users where ' $username ' in (username, email)";
		$password = $conn->query($sql);
		echo $password;


		if ( !isset($user) || $password != $_POST["password"] ) {
			$error = "Username or password incorrect";
		} else {
			$_SESSION["auth"] = true;
			$_SESSION["username"] = $username;

			header("Location: /home.php");
			exit();
		}
	}
} 
$conn->close();
?>

<html>
<head><title> Reporting </title>
<style> p.err { color: red; }</style>
</head>
<body>
<h1> Reporting </h1>
<h2> Please log in </h2>
<p class="err"><?php echo $error; ?></p>
<form action="/login.php" method="POST">
<label> Username
	<input type="text" name="username" value="<?php echo $username; ?>">
</label><br>
<label> Password
	<input type="password" name="password">
</label><br>
<input type="submit" value="Log In">
</form>
</body>
</html>
