<?php

$connection_data = json_decode(file_get_contents('connections.json'), true);
$conn = new mysqli("localhost",$connection_data["db_user"],$connection_data["db_password"],$connection_data["db_name"], 3306);
//$conn = new mysqli("localhost","root","","metrics_data", 3306);

// Check connection
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}


session_start();
if ( isset($_SESSION['auth']) && $_SESSION['auth'] == true ){
	header("Location: /report.php");
	exit();
}


$error = "";
$username = "";
$password = "";
$admin;

if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
	if ( empty(trim($_POST["username"])) ) {
		$error = "Enter your username.";
	} else {
		$username = trim($_POST["username"]);
		$sql = "SELECT password, admin FROM users WHERE '$username' IN (username, email)";
		if ($result=mysqli_query($conn,$sql))
 		{
  		// Fetch one and one row
  			while ($row=mysqli_fetch_row($result))
    		{
  
    		  $password= $row[0];
    		  $admin = $row[1];
   			}
		}
		if ( !isset($username) || $password != md5($_POST["password"] )) {
			$error = "Username or password incorrect";
		} else {
			$_SESSION["auth"] = true;
			$_SESSION["username"] = $username;
			if($admin == 1){
				$_SESSION["admin"] = true;
			}

			header("Location: /report.php");
			exit();
		}
	}
} 
$conn->close();
?>

<html>
	<head>
		<title> Log In </title>
		<link rel="stylesheet" href="stylesheet.css">
	</head>
	<body>
	<div class = info_block_wrapper>
    <div class = info_block>
		<h2> Reporting Console Login</h2>
		<p class="err"><?php echo $error; ?></p>
		<form action="/login.php" method="POST">
		<label> Username
			<input type="text" name="username" value="<?php echo $username; ?>">
		</label><br>
		<label> Password
			<input type="password" name="password">
		</label><br>
		<input type="submit" value="log in">
		</form>
	</div>
	</div>
	</body>
</html>
