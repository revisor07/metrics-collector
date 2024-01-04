var mysql = require('mysql');
var jsonServer = require('json-server');
const bodyparser = require('body-parser');
var server = jsonServer.create();
var md5 = require('md5');
server.use(bodyparser.json());
server.use(jsonServer.defaults());

let connection_data;
fetch('connections.json')
.then(response => response.json())
.then(data => {
	connection_data = data;
})
.catch(error => console.error('Error loading connections.json:', error));

var connection = mysql.createConnection({
    host : connection_data.server,
    //port: "3306",
    user : connection_data.db_user,
    password : connection_data.db_password,
    database : connection_data.db_name,
});

connection.connect(function(err) {
  if(err) throw err;
  console.log('Mysql Connected...');
});


server.get('/users', function(req, res) {
  connection.query('SELECT id, username, email, password, admin FROM users', function(err, rows, fields) {
    if (err) throw err;
    res.send(rows);
  });
});

server.post('/users', (req, res, next) => {
  if (connection.query('INSERT INTO users VALUES (?,?,?,?,?) ', [req.body["id"], req.body["username"], 
    req.body["email"], md5(req.body["password"]), req.body["admin"]]) ){
     res.status(200).json(
      req.body
     )
  }
  else
    throw error;
});

server.put('/users/:id', (req, res, next) => {
  if (connection.query('UPDATE users SET id = ?, username = ?, email = ?, password = ?, admin = ? WHERE id = ?;', 
    [req.body["id"], req.body["username"], req.body["email"], md5(req.body["password"]), req.body["admin"], req.body["id"]]) ){
     res.status(200).json({
     message: req.body
    })
  }
  else
    throw error;
});
server.delete('/users/:id', (req, res, next) => {
  if (connection.query('DELETE FROM users WHERE id = ?;', req.params.id )){
     res.status(200).json({
     message: "entry deleted"
    })
  }
  else
    throw error;
});




server.get('/logs', function(req, res) {
  connection.query('SELECT * FROM initialBrowserData', function(err, rows, fields) {
    if (err) throw err;
    res.send(rows);
  });
});

// BROWSER
server.get('/browser', function(req, res, next) {
	connection.query('SELECT * from initialBrowserData', function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(results);
	  	}
  	});
});
server.get('/browser/:id', function(req, res, next) {
	connection.query('SELECT * from initialBrowserData WHERE id=?', req.params.id, function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(results);
	  	}
  	});
});
server.post('/browser', (req, res, next) => {
  if (connection.query('INSERT INTO initialBrowserData(data, vitalsScore) VALUES (?, ?);', 
  	[JSON.stringify(req.body["data"]), JSON.stringify(req.body["vitalsScore"])]) ){
  	 res.status(200).json({
     message: req.body
    })
  }
  else
  	throw error;
});
server.put('/browser/:id', (req, res, next) => {
  if (connection.query('UPDATE initialBrowserData SET data = ?, vitalsScore = ? WHERE id = ?;', 
  	[JSON.stringify(req.body["data"]), JSON.stringify(req.body["vitalsScore"]), req.params.id]) ){
  	 res.status(200).json({
     message: req.body
    })
  }
  else
  	throw error;
});
server.delete('/browser/:id', (req, res, next) => {
  if (connection.query('DELETE FROM initialBrowserData WHERE id = ?;', req.params.id )){
  	 res.status(200).json({
     message: "entry deleted"
    })
  }
  else
  	throw error;
});

// NAVIGATION
server.get('/navigation', function(req, res, next) {
	connection.query('SELECT * from navigationTiming', function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(results);
	  	}
  	});
});
server.get('/navigation/:id', function(req, res, next) {
	connection.query('SELECT * from navigationTiming WHERE id=?', req.params.id, function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(results);
	  	}
  	});
});
server.post('/navigation', (req, res, next) => {
  if (connection.query('INSERT INTO navigationTiming(data, vitalsScore) VALUES (?, ?);', 
  	[JSON.stringify(req.body["data"]), JSON.stringify(req.body["vitalsScore"])]) ){
  	 res.status(200).json({
     message: req.body
    })
  }
  else
  	throw error;
});
server.put('/navigation/:id', (req, res, next) => {
  if (connection.query('UPDATE navigationTiming SET data = ?, vitalsScore = ? WHERE id = ?;', 
  	[JSON.stringify(req.body["data"]), JSON.stringify(req.body["vitalsScore"]), req.params.id]) ){
  	 res.status(200).json({
     message: req.body
    })
  }
  else
  	throw error;
});
server.delete('/navigation/:id', (req, res, next) => {
  if (connection.query('DELETE FROM navigationTiming WHERE id = ?;', req.params.id )){
  	 res.status(200).json({
     message: "entry deleted"
    })
  }
  else
  	throw error;
});

// NETWORK
server.get('/network', function(req, res, next) {
	connection.query('SELECT * from networkInformation', function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(results);
	  	}
  	});
});
server.get('/network/:id', function(req, res, next) {
	connection.query('SELECT * from networkInformation WHERE id=?', req.params.id, function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(results);
	  	}
  	});
});
server.post('/network', (req, res, next) => {
  if (connection.query('INSERT INTO networkInformation(data, vitalsScore) VALUES (?, ?);', 
  	[JSON.stringify(req.body["data"]), JSON.stringify(req.body["vitalsScore"])]) ){
  	 res.status(200).json({
     message: req.body
    })
  }
  else
  	throw error;
});
server.put('/network/:id', (req, res, next) => {
  if (connection.query('UPDATE networkInformation SET data = ?, vitalsScore = ? WHERE id = ?;', 
  	[JSON.stringify(req.body["data"]), JSON.stringify(req.body["vitalsScore"]), req.params.id]) ){
  	 res.status(200).json({
     message: req.body
    })
  }
  else
  	throw error;
});
server.delete('/network/:id', (req, res, next) => {
  if (connection.query('DELETE FROM networkInformation WHERE id = ?;', req.params.id )){
  	 res.status(200).json({
     message: "entry deleted"
    })
  }
  else
  	throw error;
});

// STORAGE
server.get('/storage', function(req, res, next) {
	connection.query('SELECT * from storageEstimate', function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(results);
	  	}
  	});
});
server.get('/storage/:id', function(req, res, next) {
	connection.query('SELECT * from storageEstimate WHERE id=?', req.params.id, function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(results);
	  	}
  	});
});
server.post('/storage', (req, res, next) => {
  if (connection.query('INSERT INTO storageEstimate(data, vitalsScore) VALUES (?, ?);', 
  	[JSON.stringify(req.body["data"]), JSON.stringify(req.body["vitalsScore"])]) ){
  	 res.status(200).json({
     message: req.body
    })
  }
  else
  	throw error;
});
server.put('/storage/:id', (req, res, next) => {
  if (connection.query('UPDATE storageEstimate SET data = ?, vitalsScore = ? WHERE id = ?;', 
  	[JSON.stringify(req.body["data"]), JSON.stringify(req.body["vitalsScore"]), req.params.id]) ){
  	 res.status(200).json({
     message: req.body
    })
  }
  else
  	throw error;
});
server.delete('/storage/:id', (req, res, next) => {
  if (connection.query('DELETE FROM storageEstimate WHERE id = ?;', req.params.id )){
  	 res.status(200).json({
     message: "entry deleted"
    })
  }
  else
  	throw error;
});


// FP
server.get('/fp', function(req, res, next) {
	connection.query('SELECT * from fp', function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(results);
	  	}
  	});
});
server.get('/fp/:id', function(req, res, next) {
	connection.query('SELECT * from fp WHERE id=?', req.params.id, function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(results);
	  	}
  	});
});
server.post('/fp', (req, res, next) => {
  if (connection.query('INSERT INTO fp(data, vitalsScore) VALUES (?, ?);', 
  	[JSON.stringify(req.body["data"]), JSON.stringify(req.body["vitalsScore"])]) ){
  	 res.status(200).json({
     message: req.body
    })
  }
  else
  	throw error;
});
server.put('/fp/:id', (req, res, next) => {
  if (connection.query('UPDATE fp SET data = ?, vitalsScore = ? WHERE id = ?;', 
  	[JSON.stringify(req.body["data"]), JSON.stringify(req.body["vitalsScore"]), req.params.id]) ){
  	 res.status(200).json({
     message: req.body
    })
  }
  else
  	throw error;
});
server.delete('/fp/:id', (req, res, next) => {
  if (connection.query('DELETE FROM fp WHERE id = ?;', req.params.id )){
  	 res.status(200).json({
     message: "entry deleted"
    })
  }
  else
  	throw error;
});


// FCP
server.get('/fcp', function(req, res, next) {
	connection.query('SELECT * from fcp', function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(results);
	  	}
  	});
});
server.get('/fcp/:id', function(req, res, next) {
	connection.query('SELECT * from fcp WHERE id=?', req.params.id, function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(results);
	  	}
  	});
});
server.post('/fcp', (req, res, next) => {
  if (connection.query('INSERT INTO fcp(data, vitalsScore) VALUES (?, ?);', 
  	[JSON.stringify(req.body["data"]), JSON.stringify(req.body["vitalsScore"])]) ){
  	 res.status(200).json({
     message: req.body
    })
  }
  else
  	throw error;
});
server.put('/fcp/:id', (req, res, next) => {
  if (connection.query('UPDATE fcp SET data = ?, vitalsScore = ? WHERE id = ?;', 
  	[JSON.stringify(req.body["data"]), JSON.stringify(req.body["vitalsScore"]), req.params.id]) ){
  	 res.status(200).json({
     message: req.body
    })
  }
  else
  	throw error;
});
server.delete('/fcp/:id', (req, res, next) => {
  if (connection.query('DELETE FROM fcp WHERE id = ?;', req.params.id )){
  	 res.status(200).json({
     message: "entry deleted"
    })
  }
  else
  	throw error;
});

// FID
server.get('/fid', function(req, res, next) {
	connection.query('SELECT * from fid', function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(results);
	  	}
  	});
});
server.get('/fid/:id', function(req, res, next) {
	connection.query('SELECT * from fid WHERE id=?', req.params.id, function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(results);
	  	}
  	});
});
server.post('/fid', (req, res, next) => {
  if (connection.query('INSERT INTO fid(data, vitalsScore) VALUES (?, ?);', 
  	[JSON.stringify(req.body["data"]), JSON.stringify(req.body["vitalsScore"])]) ){
  	 res.status(200).json({
     message: req.body
    })
  }
  else
  	throw error;
});
server.put('/fid/:id', (req, res, next) => {
  if (connection.query('UPDATE fid SET data = ?, vitalsScore = ? WHERE id = ?;', 
  	[JSON.stringify(req.body["data"]), JSON.stringify(req.body["vitalsScore"]), req.params.id]) ){
  	 res.status(200).json({
     message: req.body
    })
  }
  else
  	throw error;
});
server.delete('/fid/:id', (req, res, next) => {
  if (connection.query('DELETE FROM fid WHERE id = ?;', req.params.id )){
  	 res.status(200).json({
     message: "entry deleted"
    })
  }
  else
  	throw error;
});

// LCP
server.get('/lcp', function(req, res, next) {
	connection.query('SELECT * from lcp', function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(results);
	  	}
  	});
});
server.get('/lcp/:id', function(req, res, next) {
	connection.query('SELECT * from lcp WHERE id=?', req.params.id, function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(results);
	  	}
  	});
});
server.post('/lcp', (req, res, next) => {
  if (connection.query('INSERT INTO lcp(data, vitalsScore) VALUES (?, ?);', 
  	[JSON.stringify(req.body["data"]), JSON.stringify(req.body["vitalsScore"])]) ){
  	 res.status(200).json({
     message: req.body
    })
  }
  else
  	throw error;
});
server.put('/lcp/:id', (req, res, next) => {
  if (connection.query('UPDATE lcp SET data = ?, vitalsScore = ? WHERE id = ?;', 
  	[JSON.stringify(req.body["data"]), JSON.stringify(req.body["vitalsScore"]), req.params.id]) ){
  	 res.status(200).json({
     message: req.body
    })
  }
  else
  	throw error;
});
server.delete('/lcp/:id', (req, res, next) => {
  if (connection.query('DELETE FROM lcp WHERE id = ?;', req.params.id )){
  	 res.status(200).json({
     message: "entry deleted"
    })
  }
  else
  	throw error;
});


// LCPFINAL
server.get('/lcpfinal', function(req, res, next) {
	connection.query('SELECT * from lcpFinal', function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(results);
	  	}
  	});
});
server.get('/lcpfinal/:id', function(req, res, next) {
	connection.query('SELECT * from lcpFinal WHERE id=?', req.params.id, function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(results);
	  	}
  	});
});
server.post('/lcpfinal', (req, res, next) => {
  if (connection.query('INSERT INTO lcpFinal(data, vitalsScore) VALUES (?, ?);', 
  	[JSON.stringify(req.body["data"]), JSON.stringify(req.body["vitalsScore"])]) ){
  	 res.status(200).json({
     message: req.body
    })
  }
  else
  	throw error;
});
server.put('/lcpfinal/:id', (req, res, next) => {
  if (connection.query('UPDATE lcpFinal SET data = ?, vitalsScore = ? WHERE id = ?;', 
  	[JSON.stringify(req.body["data"]), JSON.stringify(req.body["vitalsScore"]), req.params.id]) ){
  	 res.status(200).json({
     message: req.body
    })
  }
  else
  	throw error;
});
server.delete('/lcpfinal/:id', (req, res, next) => {
  if (connection.query('DELETE FROM lcpFinal WHERE id = ?;', req.params.id )){
  	 res.status(200).json({
     message: "entry deleted"
    })
  }
  else
  	throw error;
});

// CLS
server.get('/cls', function(req, res, next) {
	connection.query('SELECT * from lcpFinal', function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(results);
	  	}
  	});
});
server.get('/cls/:id', function(req, res, next) {
	connection.query('SELECT * from cls WHERE id=?', req.params.id, function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(results);
	  	}
  	});
});
server.post('/cls', (req, res, next) => {
  if (connection.query('INSERT INTO cls(data, vitalsScore) VALUES (?, ?);', 
  	[JSON.stringify(req.body["data"]), JSON.stringify(req.body["vitalsScore"])]) ){
  	 res.status(200).json({
     message: req.body
    })
  }
  else
  	throw error;
});
server.put('/cls/:id', (req, res, next) => {
  if (connection.query('UPDATE cls SET data = ?, vitalsScore = ? WHERE id = ?;', 
  	[JSON.stringify(req.body["data"]), JSON.stringify(req.body["vitalsScore"]), req.params.id]) ){
  	 res.status(200).json({
     message: req.body
    })
  }
  else
  	throw error;
});
server.delete('/cls/:id', (req, res, next) => {
  if (connection.query('DELETE FROM cls WHERE id = ?;', req.params.id )){
  	 res.status(200).json({
     message: "entry deleted"
    })
  }
  else
  	throw error;
});


// CLSfinal
server.get('/clsfinal', function(req, res, next) {
	connection.query('SELECT * from clsFinal', function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(results);
	  	}
  	});
});
server.get('/clsfinal/:id', function(req, res, next) {
	connection.query('SELECT * from clsFinal WHERE id=?', req.params.id, function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(results);
	  	}
  	});
});
server.post('/clsfinal', (req, res, next) => {
  if (connection.query('INSERT INTO clsFinal(data, vitalsScore) VALUES (?, ?);', 
  	[JSON.stringify(req.body["data"]), JSON.stringify(req.body["vitalsScore"])]) ){
  	 res.status(200).json({
     message: req.body
    })
  }
  else
  	throw error;
});
server.put('/clsfinal/:id', (req, res, next) => {
  if (connection.query('UPDATE clsFinal SET data = ?, vitalsScore = ? WHERE id = ?;', 
  	[JSON.stringify(req.body["data"]), JSON.stringify(req.body["vitalsScore"]), req.params.id]) ){
  	 res.status(200).json({
     message: req.body
    })
  }
  else
  	throw error;
});
server.delete('/clsfinal/:id', (req, res, next) => {
  if (connection.query('DELETE FROM clsFinal WHERE id = ?;', req.params.id )){
  	 res.status(200).json({
     message: "entry deleted"
    })
  }
  else
  	throw error;
});

// TBT
server.get('/tbt', function(req, res, next) {
	connection.query('SELECT * from tbt', function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(results);
	  	}
  	});
});
server.get('/tbt/:id', function(req, res, next) {
	connection.query('SELECT * from tbt WHERE id=?', req.params.id, function (error, results, fields) {
	  	if(error){
	  		res.send(JSON.stringify({"status": 500, "error": error, "response": null})); 
	  	} else {
  			res.send(results);
	  	}
  	});
});
server.post('/tbt', (req, res, next) => {
  if (connection.query('INSERT INTO tbt(data, vitalsScore) VALUES (?, ?);', 
  	[JSON.stringify(req.body["data"]), JSON.stringify(req.body["vitalsScore"])]) ){
  	 res.status(200).json({
     message: req.body
    })
  }
  else
  	throw error;
});
server.put('/tbt/:id', (req, res, next) => {
  if (connection.query('UPDATE tbt SET data = ?, vitalsScore = ? WHERE id = ?;', 
  	[JSON.stringify(req.body["data"]), JSON.stringify(req.body["vitalsScore"]), req.params.id]) ){
  	 res.status(200).json({
     message: req.body
    })
  }
  else
  	throw error;
});
server.delete('/tbt/:id', (req, res, next) => {
  if (connection.query('DELETE FROM tbt WHERE id = ?;', req.params.id )){
  	 res.status(200).json({
     message: "entry deleted"
    })
  }
  else
  	throw error;
});






// Returns an Express router

server.listen(3000);
