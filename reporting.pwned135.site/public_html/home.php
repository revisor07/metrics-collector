<?php
session_start();
if( !isset($_SESSION['auth']) || $_SESSION['auth'] != true ){
	header('Location: /login.php');
	exit();
} ?>

<html>
<head><title> Reporting</title></head>
<body>
<p><a href="logout.php">Logout</a></p>
{% if $_SESSION["admin"] == true %}
  <p><a href="users.php">User Managment</a></p>
{% endif %}
<p>Welcome, <?php echo $_SESSION['username'] ?>!</p>
<hr>
<h1>Your Report</h1>



<script src="https://cdn.zingchart.com/zingchart.min.js"></script>


<div id="threeSeries"></div>
<script>
db = {};
ids = [];
innerHeights = [];
innerWidths = [];
cookiesYes = 0;
//just to make the pie chart look pretty since everyone has them enabled, 100% doesnt look pretty
cookiesNo = 20;
async function getData() {
        try {
            var res = await fetch('https://pwned135.site/api/browser');
            var data = await res.json();
            db = data;
        } catch (err) {
            console.error(err.message);
        }
}
getData().then(() => {
  for (x in db){
    ids.push(db[x].id)
    if(db[x].data != null){
    innerHeights.push(JSON.parse(db[x].data).innerHeight)
    innerWidths.push(JSON.parse(db[x].data).innerWidth)
    
    if(JSON.parse(JSON.parse(db[x].data).cookieEnabled == true))
      cookiesYes ++;
    else if(JSON.parse(JSON.parse(db[x].data).cookieEnabled == false))
      cookiesNo ++;
  }
  }
})

getData().then(() => {
  zingchart.render({
    id: 'threeSeries',
    data: {
      type: 'line',
      'scale-x': {
        label: { 
          text: "id",
        }
      },
      'scale-y': {
        label: { 
          text: "inner Height",
        }
      },
      title: {
        text: "Line Graph"
      },
      series: [
        { values: ids },
        { values: innerHeights }
      ]
    }
  });
})
</script>

<div id="twoSeries"></div>
<script>
getData().then(() => {
  zingchart.render({
    id: 'twoSeries',
    data: {
      type: 'bar',
      'scale-x': {
        label: { 
          text: "Innert Width vs Inner Height",
        }
      },
      title: {
        text: "Bar Graph"
      },
      series: [
        { values: innerHeights },
        { values: innerWidths }
      ]
    }
  });
})
</script>


<div id="pie"></div>
<script>
getData().then(() => {
  zingchart.render({
    id: 'pie',
    data: {
      type: 'pie',
      labels: [
    // Label 1
        {
        text: "cookies enabled",
        "font-family": "Georgia",
        "font-size": "30",
        x: "20%",
        y: "60%",
        },
        {
        text: "cookies disabled",
        "font-family": "Georgia",
        "font-size": "30",
        x: "60%",
        y: "20%",
        }
      ],
      title: {
        text: "Pie Chart"
      },
      series: [
        { 
          text: 'Cookies Enabled',
          values: [cookiesYes] },
        { 
          text: 'Cookies Disabled',
          values: [cookiesNo] },
      ]
    }
  });
})
</script>






<p><a href="reports.php">Reports</a></p>

</body>
</html>

