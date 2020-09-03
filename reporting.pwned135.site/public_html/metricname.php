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

<p>Welcome, <?php echo $_SESSION['username'] ?>!</p>

<form action="home.php">
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

<h3>What devices are my users visiting from?</h3>
<p> Making sure that a website is accessible to as many users as possible, and the easiest way to know what devices your website is being accessed from is by looking at the size of your user's browser, specifically inner width and inner height of the browser window. By seeing that the average size is larger (indicating a laptop) we can worry less about delays in loading times due to stronger processors, and focus on exporting visuals and a smooth scrolling layout. If the screen size is smaller it is more likely our users are browsing on their phones, so a faster response from the website is a must, and the client side technology must be able to adapt to rotation. We must remember that small web mistakes can seem like huge inconviences to users, so knowing our user a little better helps to create a more streamline webpage for their needs. </p>
<zing-grid caption="Initial Browser Data" src="https://pwned135.site/api/browser" ></zing-grid>



</body>
</html>

