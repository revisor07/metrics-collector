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

server.get('/api/browsers', function (req, res, body) { res.json({ test })
  var data = JSON.parse(test);
  var responseJson = JSON.stringify(data.response);
  console.log('TEST');
  var query = connection.query('INSERT INTO metricName SET column=?', [responseJson], function(err, result) {
    if(err) throw err;
    console.log('data inserted');
  });
})

// Returns an Express router
var router = jsonServer.router('db.json');

server.use(router);

server.listen(3000);
