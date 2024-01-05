<?php
session_start();
if( !isset($_SESSION['auth']) || $_SESSION['auth'] != true || $_SESSION['admin'] == false){
	header('Location: /login.php');
	exit();
} ?>

<html>
  <head>
    <title> User Management </title>
    <link rel="stylesheet" href="stylesheet.css">
    <style>
    body {
        font-family: 'Roboto', sans-serif; 
    }
    <style> p.err { color: red; }</style>
      <!--Script Reference-->
    <script src="https://cdn.zinggrid.com/zinggrid.min.js" defer></script>
  </head>
  <body>

    <p>Welcome, <?php echo $_SESSION['username'] ?>!</p>

    <form action="index.html">
        <input type="submit" value="home" />
    </form>

    <form action="report.php">
        <input type="submit" value="report" />
    </form>

    <?php if($_SESSION["admin"] == true) : ?>
    <form action="users.php">
        <input type="submit" value="user management" />
    </form>
    <?php endif; ?>

    <form action="logout.php">
        <input type="submit" value="logout" />
    </form>

    <hr>
    <h1>User Management Console</h1>
      <zing-grid id = "usersDatabase" caption="Users Database" editor editor-controls></zing-grid>
  </body>
  <footer>
    <script>
      let connection_data;
      async function getConnData() {
        connection_data_raw = await fetch('connections.json');
        connection_data = await connection_data_raw.json();
      }
      getConnData().then(() => {
      let apiUrl = `${connection_data.protocol}://${connection_data.server}/api/users`;
      let zingGridElement = document.getElementById("usersDatabase");
      zingGridElement.setAttribute("src", apiUrl);
      });
    </script>
  </footer>

</html>

