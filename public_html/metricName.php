<?php
session_start();
if( !isset($_SESSION['auth']) || $_SESSION['auth'] != true ){
	header('Location: /login.php');
	exit();
} ?>

<html>
<head><title> Reporting</title>

<script src="https://cdn.zinggrid.com/zinggrid.min.js" defer></script>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
<style>
body {
    font-family: 'Roboto', sans-serif; 
}
<style> p.err { color: red; }</style>
</head>
<body>

<p>Welcome, <?php echo $_SESSION['username'] ?>!</p>

<form action="reporting.php">
    <input type="submit" value="home" />
</form>
<form action="logout.php">
    <input type="submit" value="logout" />
</form>
<hr>

<h1>Detailed Report</h1>

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
cookiesNo = 0;
phone = 0;
tab = 0;
comp = 0;
async function getData() {
        try {
            var res = await fetch('http://146.190.15.250/api/browser');
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
	if(innerWidths[i] < 500){
	    phone++;
	} 
	else if ( innerWidths[i] < 1300){
		tab++;
	} else {
		comp++;
	}
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
        text: "Browser Dimensions"
      },
      series: [{values: dimensions}]
  },
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
        {
        text: "Computer",
	"font-size": "20", 
	x: "30%",
	y: "70%",
        },
        {
        text: "Tablet",
        "font-size": "20",
	x: "63%",
	y: "73%",
        },
        {
        text: "Phone",
        "font-size": "20",
	x: "65%",
	y: "48%",
        }
      ],
      title: {
        text: "Type of User's Machine"
      },
      series: [
        { 
          text: 'Computer',
	  values: [comp] },
        { 
          text: 'Tablet',
          values: [tab] },
        { 
          text: 'Phone',
          values: [phone] },
      ]
    }
  });
})
</script>

<br>

<h3>What devices are my users visiting from?</h3>
<div>
<p> Making sure that a website is accessible to as many users as possible, and the easiest way to know what devices your website is being accessed from is by looking at the size of your user's browser, specifically inner width and inner height of the browser window. From here, we found the average width (in pixels) of phones(less than 500px) tablets(less than 1000 px) and computers(everything above 1000px). We then used this to measure how many users visit our site on these various devices, of which the pie chart is the result. By seeing that the average size is larger (indicating a laptop) we can worry less about delays in loading times due to stronger processors, and focus on exporting visuals and a smooth scrolling layout. This assumption about the average device used is further confirmed by looking at the 'data' portion of the table and noticing that the website is mostly visited from Linux, Mac OS, and Windows, operating systems associated with computers.If the screen size is smaller it is more likely our users are browsing on their phones, so a faster response from the website is a must, and the client side technology must be able to adapt to rotation. We must remember that small web mistakes can seem like huge inconviences to users, so knowing our user a little better helps to create a more streamline webpage for their needs. </p>
</div>

<br>
<zing-grid caption="Initial Browser Data" src="http://146.190.15.250/api/browser" ></zing-grid>

</body>
</html>

