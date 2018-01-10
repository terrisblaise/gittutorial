var express = require('express');
var app = express();
var path = require('path');
var sql = require("mssql");

const bodyParser = require('body-parser');

var dbConfig = {
        user: 'sa',
        password: '$Systems.',
        //server: 'NBTSSSQL01\\ENVIRO', 
		server: 'localhost',
        database: 'AirQuality' 
    };
    
	
var connection = sql.connect(dbConfig, function (err) {
    if (err)
        throw err; 
});

var lastLocation = {"nId":1,"vcLocation":"Brooksbank"};
var lastStartDate = '20170101';
var lastEndDate = '20170103';

app.get('/', function(req, res) {
    res.sendFile(path.join(__dirname + '/index.html'));
});

app.get('/css', function(req, res) {
    res.sendFile(path.join(__dirname + '/styles.css'));
});

app.get('/neptune-m', function(req, res) {
    res.sendFile(path.join(__dirname + '/styles.css'));
});

app.get('/angular', function(req, res) {
    res.sendFile(path.join(__dirname + '/angular.min.js'));
});

app.get('/gcharts', function(req, res) {
    res.sendFile(path.join(__dirname + '/gcharts.js'));
});



/*
app.get('/chartjs', function(req, res) {
    res.sendFile(path.join(__dirname + '/Chart.bundle.js'));
});
*/

app.get('/jQDateRangeSlider-min.js', function(req, res) {
    res.sendFile(path.join(__dirname + '/jQDateRangeSlider-min.js'));
});

app.get('/chartjs', function(req, res) {
    res.sendFile(path.join(__dirname + '/Chart.js'));
});

app.get('/qa', function(req, res) {
    res.sendFile(path.join(__dirname + '/qa.html'));
});

app.get('/home', function(req, res) {
    res.sendFile(path.join(__dirname + '/home.html'));
});

app.get('/neptune-navigation', function(req, res) {
    res.sendFile(path.join(__dirname + '/navigation.html'));
});


app.get('/aq-map', function(req, res) {
    res.sendFile(path.join(__dirname + '/startbootstrap-simple-sidebar-gh-pages/aqmap.html'));
});

app.get('/brooksbank', function(req, res) {
    res.sendFile(path.join(__dirname + '/startbootstrap-simple-sidebar-gh-pages/brooksbank.html'));
});

app.get('/electrical-substation', function(req, res) {
    res.sendFile(path.join(__dirname + '/startbootstrap-simple-sidebar-gh-pages/electrical-substation.html'));
});

app.get('/neighbourhood-pool', function(req, res) {
    res.sendFile(path.join(__dirname + '/startbootstrap-simple-sidebar-gh-pages/neighbourhood-pool.html'));
});

app.get('/bulldozing', function(req, res) {
    res.sendFile(path.join(__dirname + '/bulldozing.html'));
});

app.get('/ssrs', function(req, res) {
    res.sendFile(path.join(__dirname + '/ssrs.html'));
});

app.get('/getJson', function (req, res) {
     // create Request object
    var request = new sql.Request();
    // query to the database and get the records
    request.query('SELECT TOP 200 * FROM ProdAqWind', function (err, recordset) {
        if (err) console.log(err)
        // send records as a response
        res.send(recordset);
    });
	//sql.close();
});

app.get('/getLocations', function (req, res) {
     // create Request object
    var request = new sql.Request();
    // query to the database and get the records
    request.query('SELECT * FROM LULocations', function (err, recordset) {
        if (err) console.log(err)
        // send records as a response
        res.send(recordset);
    });
	//sql.close();
});

app.get('/getOptions', function (req, res) {
     // create Request object
    var request = new sql.Request();
    // query to the database and get the records
    request.query('SELECT * FROM LUDataVerificationOptions', function (err, recordset) {
        if (err) console.log(err)
        // send records as a response
        res.send(recordset);
    });
	//sql.close();
});

app.get('/gchartsJSON', function (req, res) {
    // create Request object
    var request = new sql.Request();
    // query to the database and get the records
    request.query('SELECT TOP 200 nId, fWindspeed FROM ProdAqWind ORDER BY nId', function (err, recordset) {
        if (err) console.log(err)
        // send records as a response
        res.send(recordset);
    });
	//sql.close();
});

app.get('/EBAM', function (req, res) {
    // create Request object
    var request = new sql.Request();
    // query to the database and get the records
    //request.query('EXEC spGetQC 1, "20170101","20170110"', function (err, recordset) {
    request.query('EXEC spGetQC ' + lastLocation.nId + ',"' + lastStartDate + '","' + lastEndDate + '"', function (err, recordset) {
        if (err) console.log(err)
        // send records as a response
		console.log(recordset);
        res.send(recordset);
    });
	
	//sql.close();
});

app.get('/initSearch', function (req, res) {
    var searchCriteria = {lastLocation: lastLocation, lastStartDate: lastStartDate, lastEndDate: lastEndDate}
	console.log(JSON.stringify(searchCriteria));
    res.send(searchCriteria);
});

/*
app.get("/bulldozingData", function (req, res) {
    var request = new sql.Request();
    // query to the database and get the records
    console.log('EXEC spGetBulldozingHours "' + lastStartDate + '","' + lastEndDate + '"');
    request.query('EXEC spGetBulldozingHours "' + lastStartDate + '","' + lastEndDate + '"', function (err, recordset) {
        if (err) console.log(err)
        // send records as a response
        res.send(recordset);
		//console.log(JSON.stringify(recordset));
    });
	//sql.close();
});
*/


app.get("/bulldozingData", function (req, res) {
    var request = new sql.Request();
   //inputs
   request.input('dtStart',sql.DateTime,new Date("2017-02-01T00:00:00.000Z"))
   request.input('dtEnd',sql.DateTime,new Date("2017-03-01T00:00:00.000Z"))
   // query to the database and get the records	
	request.execute('spGetBulldozingHours',  function (err, recordset) {
        if (err) console.log(err)
		//console.log(recordset.returnValue) // procedure return value
		console.log(recordset.rowsAffected)
        // send records as a response
		res.send(recordset);
    });
});



app.use(bodyParser.urlencoded({
    extended: true
}));

app.use(bodyParser.json());

app.post("/postEbamSearchCriteria", function (req, res) {
    //console.log(req.body.location.nId);
    //console.log(req.body.dtStart);
    //console.log(req.body.dtEnd);

    lastLocation = req.body.location;
    lastStartDate = req.body.dtStart;
    lastEndDate = req.body.dtEnd;

    var request = new sql.Request();
    // query to the database and get the records
    console.log('EXEC spGetQC ' + req.body.location.nId + ',"' + req.body.dtStart + '","' + req.body.dtEnd + '"');
    request.query('EXEC spGetQC ' + req.body.location.nId + ',"' + req.body.dtStart + '","' + req.body.dtEnd + '"', function (err, recordset) {
        if (err) console.log(err)
        // send records as a response
		//console.log(recordset);
        res.send(recordset);
    });
	//sql.close();
});

app.post("/postBulldozingSearchCriteria", function (req, res) {
    console.log(req.body.dtStart);
    console.log(req.body.dtEnd);

    var request = new sql.Request();
    // query to the database and get the records
    console.log('EXEC spGetBulldozingHours "' + req.body.dtStart + '","' + req.body.dtEnd + '"');
    request.query('EXEC spGetBulldozingHours "' + req.body.dtStart + '","' + req.body.dtEnd + '"', function (err, recordset) {
        if (err) console.log(err)
        // send records as a response
        res.send(recordset);
		console.log(JSON.stringify(recordset));
    });
	//sql.close();
});

app.post("/postDataValidation", function (req, res) {
    var dataObj = req.body.update;
    var initials = req.body.initials;
    console.log(initials);
    var request = new sql.Request();
    for(var key in dataObj) {
        //console.log('exec spUpdateDataValidation ' + key + ', "' + dataObj[key].join() + '", "' + initials +'"');
        //console.log(key);
        //console.log(dataObj[key]);
        for(var id in dataObj[key]){
            console.log('exec spUpdateDataValidation ' + key + ', "' + dataObj[key][id] + '", "' + initials +'"');
            request.query('exec spUpdateDataValidation ' + key + ', "' + dataObj[key][id] + '", "' + initials +'"', function (err, recordset) {
            });
        }
        /*
        request.query('exec spUpdateDataValidation ' + key + ', "' + dataObj[key].join() + '", "' + initials +'"', function (err, recordset) {
        //if (err) console.log(err)
        // send records as a response
        //res.send(recordset);
        });
        */
		
    }
	//sql.close();
});

app.post("/bulldozingData", function (req, res) {
	var dataObj = req.body;
	console.log(JSON.stringify(req.body));
	var dt = req.body.dt;
	var totalHours = req.body.th;
	var idleHours = req.body.ih;

    var request = new sql.Request();
	console.log('EXEC spUpdInsBulldozingHours "' + dt + '",' + totalHours + ',' + idleHours)
    request.query('EXEC spUpdInsBulldozingHours "' + dt + '",' + totalHours + ',' + idleHours, function (err, recordset) {
        if (err) console.log(err)
        res.send(recordset);
    });
});

app.get('*', function(req, res) {
    res.send('Permission Denied')
});



var server = app.listen(5000, function () {
    console.log('Server is running..');
});