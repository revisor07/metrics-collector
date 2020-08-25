// app.js file
var mysql = require('mysql');
var jsonServer = require('json-server');

// Returns an Express server
var server = jsonServer.create();

// Set default middlewares (logger, static, cors and no-cache)
server.use(jsonServer.defaults());

// Add custom routes
server.get('/custom', function (req, res) { res.json({ msg: 'hello' }) })




var code = {
	"warhead_id" : "95683",
	"access_code" : "FRTS45W1"
}
var test = {
  "data": {
    cookieEnabled: true,
    innerHeight: "798",
    innerWidth: "881",
    language: "en-US",
    outerHeight: "883",
    outerWidth: "1392",
    userAgent: "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537"
    }
}

var connection = mysql.createConnection({
    host : "localhost",
    port: "3306",
    user : "root",
    password : "",
    database : "logs",
    multipleStatements: true
});

server.get('/browsers', function(req, res, next) {
	res.locals.connection.query('SELECT * from initialBrowserData', function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  		//If there is error, we send the error in the error section with 500 status
	  	} else {
  			res.send(JSON.stringify({"status": 200, "error": null, "response": results}));
  			//If there is no error, all is good and response is 200OK.
	  	}
  	});
});
/*
server.get('/api/browsers', function (req, res) { 
  res.json({ test })
  var data = JSON.parse(test["data"]);
  var responseJson = JSON.stringify(data.response);
  console.log('TEST');
  //var query = connection.query('INSERT INTO metricName SET column=?', [responseJson], function(err, result) {
  var query = connection.query('INSERT INTO metricName SET column=?', [responseJson], function(err, result) {
    if(err) throw err;
    console.log('data inserted');
  });
})
*/
// Returns an Express router
var router = jsonServer.router('db.json');

server.use(router);

server.listen(3000);
