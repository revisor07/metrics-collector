<html>
  <head>
    <title>Logout</title>
		<link rel="stylesheet" href="stylesheet.css">

  </head>
  <body>
    <div class = info_block_wrapper>
    <div class = info_block>
    <h3>You have been successfully logged out</h3>

    <form action="login.php">
        <input type="submit" value="back to login" />
    </form>
  </div>
  </div>

  </body>
</html>
<?php
session_start();
$_SESSION["admin"] = 0;
$_SESSION = array();
session_destroy();

exit();
?>