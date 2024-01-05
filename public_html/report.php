<?php
session_start();
if( !isset($_SESSION['auth']) || $_SESSION['auth'] != true ){
  header('Location: /login.php');
  exit();
} ?>

<html>
  <head>
    <title> Report</title>
      <link rel="stylesheet" href="stylesheet.css">
    <style>
    body {
        font-family: 'Roboto', sans-serif; 
    }
    <style> p.err { color: red; }</style>
    <script src="https://cdn.zinggrid.com/zinggrid.min.js" defer></script>
  </head>
  <body>
    <p>Welcome, <?php echo $_SESSION['username'] ?>!</p>

    <ul class = nav>
      <li>
      <form action="index.html">
          <input class = "nav_btn" type="submit" value="home" />
      </form>
      </li>

      <li>
      <form action="report.php">
          <input class = "nav_btn" type="submit" value="report" />
      </form>
      </li>

      <li>
      <?php if($_SESSION["admin"] == true) : ?>
      <form action="users.php">
          <input class = "nav_btn" type="submit" value="user management" />
      </form>
      <?php endif; ?>
      </li>

      <li>
      <form action="logout.php">
          <input class = "nav_btn" type="submit" value="logout" />
      </form>
      </li>
    </ul>

    <hr>

    <h1>Your Reports</h1>



    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>

    <div id="threeSeries"></div>
    <script>

      let connection_data;
      ibd = {}; 
      cls = {};
      id = [];
      cls_data = [];
      innerHeights = [];
      innerWidths = [];
      dimensions = [];
      cookiesYes = 0;
      cookiesNo = 0;

      //metricName
      phone = 0;
      tab = 0;
      comp = 0;
      
      async function getData() {
          try {
            connection_data_raw = await fetch('connections.json');
            connection_data = await connection_data_raw.json();
            let resUrl = `${connection_data.protocol}://${connection_data.server}/api/browser`;
            let res2Url = `${connection_data.protocol}://${connection_data.server}/api/cls`;
            var res = await fetch(resUrl);
            var res2 = await fetch(res2Url);
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
        /*
        for (i=0; i < innerHeights.length; i++){
          coord = [parseFloat(innerHeights[i]), parseFloat(innerWidths[i])]
          dimensions.push(coord)
        }*/

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
      });

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
      });
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


    <div id="pie2"></div>
    <script>
      getData().then(() => {
        zingchart.render({
          id: 'pie2',
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
      });
    </script>

    <br>
    <zing-grid id = "browsingTable" caption="initialBrowserData Table Preview"></zing-grid>

    <script>
      getData().then(() => {
      let apiUrl = `${connection_data.protocol}://${connection_data.server}/api/browser`;
      let zingGridElement = document.getElementById("browsingTable");
      zingGridElement.setAttribute("src", apiUrl);
      });

    </script>


    </body>

  
  </body>
</html>
