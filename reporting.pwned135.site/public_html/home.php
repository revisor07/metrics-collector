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
<p><a href="metricname.php">Detailed Report</a></p>

<?php if($_SESSION["admin"] == true) : ?>
    <p><a href="users.php">User Managment</a></p>
<?php endif; ?>



<p>Welcome, <?php echo $_SESSION['username'] ?>!</p>
<hr>
<h1>Your Report</h1>



<script src="https://cdn.zingchart.com/zingchart.min.js"></script>


<div id="threeSeries"></div>
<script>
ibd = {}; //initialBrowserData
nt = {}; //navigationTiming
ids = [];
innerHeights = [];
innerWidths = [];
dimensions = [];
cookiesYes = 0;
tbtData = [];
exIds = [];
//just to make the pie chart look pretty since everyone has them enabled, 100% doesnt look pretty
cookiesNo = 0;
async function getData() {
        try {
	    var res = await fetch('https://pwned135.site/api/browser');
	    var ex = await fetch('https://pwned135.site/api/tbt');
	    var data = await res.json();
	    var exData = await ex.json();
	    ibd = data;         
	    exIbd = exData;
        } catch (err) {
            console.error(err.message);
        }
}
getData().then(() => {
  for (x in ibd){
    if(ibd[x].data != null){
    ids.push(ibd[x].id)
    innerHeights.push(JSON.parse(ibd[x].data).innerHeight)
    innerWidths.push(JSON.parse(ibd[x].data).innerWidth)

    if(JSON.parse(ibd[x].data).cookieEnabled == true)
      cookiesYes ++;
    else if(JSON.parse(ibd[x].data).cookieEnabled == false)
      cookiesNo ++;
    }
  }

  for (x in exIbd){
    if(exIbd[x].data != null){
	tbtData.push(JSON.parse(exIbd[x].data))	  
    }
  }

  for (i=0; i < innerHeights.length; i++){
  	coord = [innerHeights[i], innerWidths[i]]
    dimensions.push(coord)
  }



})

getData().then(() => {
  zingchart.render({
    id: 'threeSeries',
    data: {
      type: 'bar',
      'scale-y': {
        label: { 
          text: "Data Transmitted",
	  "height": "15px",
        }
      },
      title: {
        text: "Data Transmitted During TBT"
      },
      series: [
        { values: tbtData}
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

