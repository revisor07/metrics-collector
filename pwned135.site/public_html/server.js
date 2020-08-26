// app.js file
var mysql = require('mysql');
var jsonServer = require('json-server');

// Returns an Express server
var server = jsonServer.create();

// Set default middlewares (logger, static, cors and no-cache)
server.use(jsonServer.defaults());

// Add custom routes
server.get('/custom', function (req, res) { res.json({ msg: 'hello' }) });



var data = {
	"snake" = "marty"
}
var vitalsScore = {
	"dog" = "bob"
}
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
    //port: "3306",
    user : "root",
    password : "",
    database : "logs",
});

connection.connect(function(err) {
  if(err) throw err;
  console.log('Mysql Connected...');
});

//get whole browser
server.get('/browser', function(req, res, next) {
	connection.query('SELECT * from initialBrowserData', function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(JSON.stringify({results}));
	  	}
  	});
});

//select by id #
server.get('/browser/:id', function(req, res, next) {
	connection.query('SELECT * from initialBrowserData WHERE id=?', req.params.id, function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(JSON.stringify({results}));
	  	}
  	});
});

//rest api to create a new record into mysql database
server.post('/browser', function (req, res, next) {

	//var postData  = req.body;
	console.log(req.body);
	//connection.query('INSERT INTO initialBrowserData SET ?', postData, function (error, results, fields) {
	connection.query('INSERT INTO initialBrowserData(data, vitalsScore) VALUES ? ?', [data, vitalsScore], function (error, results, fields) {
	  if (error) throw error;
	  res.end(JSON.stringify(results));
	});
});




//select all of navigationTiming
server.get('/navigation', function(req, res, next) {
	connection.query('SELECT * from navigationTiming', function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(JSON.stringify({results}));
	  	}
  	});
});


//get navigationTiming by id #
server.get('/navigation/:id', function(req, res, next) {
	connection.query('SELECT * from navigationTiming WHERE id=?', req.params.id, function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(JSON.stringify({results}));
	  	}
  	});
});


//get all of networkInformation
server.get('/network', function(req, res, next) {
	connection.query('SELECT * from networkInformation', function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(JSON.stringify({results}));
	  	}
  	});
});


server.get('/network/:id', function(req, res, next) {
	connection.query('SELECT * from networkInformation  WHERE id=?', req.params.id, function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(JSON.stringify({results}));
	  	}
  	});
});


//get all of storage
server.get('/storage', function(req, res, next) {
	connection.query('SELECT * from storageEstimate', function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(JSON.stringify({results}));
	  	}
  	});
});

//get storage by id
server.get('/storage/:id', function(req, res, next) {
	connection.query('SELECT * from storageEstimate WHERE id=?', req.params.id, function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(JSON.stringify({results}));
	  	}
  	});
});


//get all of fp
server.get('/fp', function(req, res, next) {
	connection.query('SELECT * from fp', function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(JSON.stringify({results}));
	  	}
  	});
});

//get fp by id
server.get('/fp/:id', function(req, res, next) {
	connection.query('SELECT * from fp WHERE id=?', req.params.id, function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(JSON.stringify({results}));
	  	}
  	});
});


//get all of fcp
server.get('/fcp', function(req, res, next) {
	connection.query('SELECT * from fcp', function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(JSON.stringify({results}));
	  	}
  	});
});

//get fcp by id
server.get('/fcp/:id', function(req, res, next) {
	connection.query('SELECT * from fcp WHERE id=?', req.params.id, function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(JSON.stringify({results}));
	  	}
  	});
});


//get all of fid
server.get('/fid', function(req, res, next) {
	connection.query('SELECT * from fid', function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(JSON.stringify({results}));
	  	}
  	});
});

//get fid by id
server.get('/fid/:id', function(req, res, next) {
	connection.query('SELECT * from fid WHERE id=?', req.params.id, function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(JSON.stringify({results}));
	  	}
  	});
});



//get all of lcp
server.get('/lcp', function(req, res, next) {
	connection.query('SELECT * from lcp', function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(JSON.stringify({results}));
	  	}
  	});
});

//get lcp by id
server.get('/lcp/:id', function(req, res, next) {
	connection.query('SELECT * from lcp WHERE id=?', req.params.id, function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(JSON.stringify({results}));
	  	}
  	});
});


//get all of lcpFinal
server.get('/lcpfinal', function(req, res, next) {
	connection.query('SELECT * from lcpFinal', function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(JSON.stringify({results}));
	  	}
  	});
});

//get lcpFinal by id
server.get('/lcpfinal/:id', function(req, res, next) {
	connection.query('SELECT * from lcpfinal WHERE id=?', req.params.id, function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(JSON.stringify({results}));
	  	}
  	});
});



//get all of cls
server.get('/cls', function(req, res, next) {
	connection.query('SELECT * from cls', function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(JSON.stringify({results}));
	  	}
  	});
});

//get cls by id
server.get('/cls/:id', function(req, res, next) {
	connection.query('SELECT * from cls WHERE id=?', req.params.id, function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(JSON.stringify({results}));
	  	}
  	});
});


//get all of clsFinal
server.get('/clsfinal', function(req, res, next) {
	connection.query('SELECT * from clsFinal', function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(JSON.stringify({results}));
	  	}
  	});
});

//get clsFinal by id
server.get('/clsfinal/:id', function(req, res, next) {
	connection.query('SELECT * from clsFinal WHERE id=?', req.params.id, function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(JSON.stringify({results}));
	  	}
  	});
});


//get all of tbt
server.get('/tbt', function(req, res, next) {
	connection.query('SELECT * from tbt', function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(JSON.stringify({results}));
	  	}
  	});
});

//get tbt by id
server.get('/tbt/:id', function(req, res, next) {
	connection.query('SELECT * from tbt WHERE id=?', req.params.id, function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(JSON.stringify({results}));
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
