<html>
  <head>
    <title>Logout</title>
		<link rel="stylesheet" href="stylesheet.css">

  </head>
  <body>
    <div class = info_block_wrapper>
    <div class = info_block>
    <h2>You have been successfully logged out</h2>

    <form action="index.html">
        <input type="submit" value="exit" />
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