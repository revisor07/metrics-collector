<?php
session_start();
if( !isset($_SESSION['auth']) || $_SESSION['auth'] != true ){
	header('Location: /login.php');
	exit();
} ?>

<html>
<head><title> Reporting</title>

<script src="https://cdn.zinggrid.com/zinggrid.min.js" defer></script>

</head>
<body>
<h1>Reporting</h1>
<p>Welcome, <?php echo $_SESSION['username'] ?>!</p>
<p><a href="home.php">Home</a></p>
<p><a href="logout.php">Logout</a></p>

<h1>Your Report</h1>

<script src="https://cdn.zingchart.com/zingchart.min.js"></script>


<div id="myChart" class="chart--container"></div>
<script>
ibd = {}; //initialBrowserData
nt = {}; //navigationTiming
ids = [];
innerHeights = [];
innerWidths = [];
dimensions = [];
cookiesYes = 0;
//just to make the pie chart look pretty since everyone has them enabled, 100% doesnt look pretty
cookiesNo = 0;
async function getData() {
        try {
            var res = await fetch('https://pwned135.site/api/browser');
            var data = await res.json();
            ibd = data;         
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
  for (i=0; i < innerHeights.length; i++){
        coord = [innerHeights[i], innerWidths[i]]
    dimensions.push(coord)
  }


})

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
        text: "Scatter Plot"
      },
      series: [{values: dimensions}]
  },
  });
})
</script>

<zing-grid src="https://pwned135.site/api/browser" ></zing-grid>

<h3>What devices are my users visiting from?</h3>
<p></p>

</body>
</html>

