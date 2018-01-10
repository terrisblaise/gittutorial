var Service = require('node-windows').Service;

// Create a new service object
var svc = new Service({
  name:'qaqcinterface',
  description: 'Air Quality web interface',
  script: 'C:\\WebApps\\qaqcinterface\\app.js'
});

// Listen for the "install" event, which indicates the
// process is available as a service.
svc.on('install',function(){
  svc.start();
});

svc.install();