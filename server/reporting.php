<?php
session_start();
if( !isset($_SESSION['auth']) || $_SESSION['auth'] != true ){
  header('Location: /login.php');
  exit();
} ?>

<html>
<head>
<title> Reporting</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
<style>
body {
    font-family: 'Roboto', sans-serif; 
}
<style> p.err { color: red; }</style>
</head>
<body>
<p>Welcome, <?php echo $_SESSION['username'] ?>!</p>

<form action="metricName.php">
    <input type="submit" value="generate report" />
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

<h1>Your Reports</h1>


<script src="https://cdn.zingchart.com/zingchart.min.js"></script>

<div id="threeSeries"></div>
<script>
ibd = {}; 
cls = {};
id = [];
cls_data = [];
innerHeights = [];
innerWidths = [];
dimensions = [];
cookiesYes = 0;
cookiesNo = 0;
async function getData() {
        try {
      var res = await fetch('https://146.190.15.250/api/browser');
      var res2 = await fetch('https://146.190.15.250/api/cls');
      var data1 = await res.json();
      var data2= await res2.json();
      ibd = data1;         
      cls = data2;
        } catch (err) {
            console.error(err.message);
        }
}
getData().then(() => {
  for (x in ibd){
    if(ibd[x].data != null){
    innerWidths.push(JSON.parse(ibd[x].data).innerWidth)
    innerHeights.push(JSON.parse(ibd[x].data).innerHeight)
    if(JSON.parse(ibd[x].data).cookieEnabled == true)
      cookiesYes ++;
    else if(JSON.parse(ibd[x].data).cookieEnabled == false)
      cookiesNo ++;
    }
  }

  for (x in cls){
    if(cls[x].data != null){
    id.push(cls[x].id)
  cls_data.push(parseFloat(JSON.parse(cls[x].data)))    
    }
  }

  for (i=0; i < innerHeights.length; i++){
    coord = [parseFloat(innerHeights[i]), parseFloat(innerWidths[i])]
    dimensions.push(coord)
  }
})

getData().then(() => {
  zingchart.render({
    id: 'threeSeries',
    data: {
      type: 'line',
      'scale-x': {
        label: { 
          text: "recorded entries",
        }
      },
      'scale-y': {
        label: { 
          text: "Google Score",
          "height": "8px",
        }
      },
      title: {
        text: "Cumulative Layout Shift/User experience over time"
      },
      series: [
        { values: cls_data}
      ]
    }
  });
})
</script>

<div id="myChart"></div>
<script>
getData().then(() => {
  zingchart.render({
    id: 'myChart',
    data: {
      type: 'scatter',
      clustered: true,
      plot: {
        clusterOffset: 5,
        marker: {
        alpha: 0.5,
        borderWidth: '0px',
        size: '4px'
        }
       },
      'scale-x': {
        label: { 
          text: "Inner Height",
        }
      },
      'scale-y': {
        label: { 
          text: "Inner Width",
    "height": "15px",
        }
      },
      title: {
        text: "Browser Dimensions"
      },
      series: [{values: dimensions}]
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
        "font-size": "20",
        x: "20%",
  y: "70%",
        },
        {
        text: "cookies disabled",
        "font-family": "Georgia",
        "font-size": "20",
        x: "60%",
        y: "20%",
        }
      ],
      title: {
        text: "Cookie Status"
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

</body>
</html>
