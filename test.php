<!DOCTYPE html>
<html lang="en-US">
<meta name="viewport" content="width=device-width, initial-scale=1">

<head>



</head>
<body>

<?php include "navigation.php"; ?>



	<link rel="stylesheet" href="/css">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		
	  <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>  
 
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



<!--  <script type="text/javascript">
  
  cntreed
       $(function() {
             
			   $("#startdatepicker").datepicker({ dateFormat: "yymmdd" }).val()
			    $("#enddatepicker").datepicker({ dateFormat: "yymmdd" }).val()
       });
   </script> -->
   
  <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.js"></script>-->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  
  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

 <script>
  $( function() {
    $( "#startdatepicker" ).datepicker({ dateFormat: "yymmdd" }).val();
	$( "#enddatepicker" ).datepicker({ dateFormat: "yymmdd" }).val()
  } );
  
  
  </script>

   
   
   

 
   
</head>

<script src="/angular"></script>
<script type="text/javascript" src="/gcharts"></script>
<script src="/chartjs"></script>


<body style="background-color:#F8F8F8; color:#118D99">

<script>
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>

<div id="main">

    
    <div class="col-sm-9">
     <div style="margin:auto"> 
    <!-- JSON Data -->
    <div ng-app="myApp" ng-controller="qualityControl">
		<!--
		<canvas id="test" width="1000" height="400"></canvas>
		-->
		
		<table class="tg" cellspacing="0" cellpadding="0">
		
		
			<tr>
				<td style="background-color:#118D99;" align= "center" >
					<font color="white">LOCATION:</font><br><select style="margin-bottom: 10px;"  
 class="selectOption" ng-model="selectedLocation.location" ng-options="option.vcLocation for option in selectedLocation.options track by option.nId" ></select><br>
					
				    <font color="white">START DATE:</font><br><input style="margin-bottom: 10px;"  type="text" ng-model="dtStart"  id="startdatepicker"size="17"><br>
					<font color="white">END DATE:</font><br><input style="margin-bottom: 10px;"  type="text" ng-model="dtEnd" id="enddatepicker"size="17">
					
					
					
					
				<!--	<button style="height:40px;width:200px" class="w3-btn w3-ripple w3-green button1" ng-click="postEbamSearchCriteria()"> Update Search Criteria </button>
					-->
					
					
						<style>
.button {
    background-color: #FFFFFF; 

    color: white;
    
    text-align: center;
   
    font-size: 14px;
    margin: 10px;
    -webkit-transition-duration: 0.4s;
    transition-duration: 0.4s;
    cursor: pointer;
}

.button1 {
    background-color: white; 
    color: #118D99; 
    border: 2px solid #118D99;
}

.button1:hover {
    background-color: #228B22;
    color: white;
}


</style>

						
			
						
						<button style="height:auto;width:155px" class="button button1" ng-click="postEbamSearchCriteria()">UPDATE SEARCH CRITERIA</button>
						
				</td>
				<td class="tg-yw4l" rowspan="3"><canvas id="chartJSContainer" width="100%" height="30%"></canvas></td>
			</tr>			
		</table>

		<br><br>

        <div></div>

		
		<table class="tg" cellspacing="0" cellpadding="0" width="100px">
	
			<tr>
				<td style="background-color:#118D99" align= "center" >
					<font color="white">INITIALS REQUIRED:</font><br><input style="margin-bottom: 10px;"   type="text" ng-model="userInitials" ng-init="" maxlength=3 size="17"><br>
					<font color="white">SELECT OPTION:</font><br>
					<select style="width:155px; margin-bottom: 10px" class="selectOption" ng-model="setAllSelects" ng-options="option.vcOption for option in menuOptions track by option.nId"></select><br>
					<button style="height:auto;width:155px" class="button button1" ng-click="setSelectValues(1)" ng-disabled="!userInitials.length"> SET All PM25 QA</button><br>
					<button style="height:auto;width:155px" class="button button1" ng-click="setSelectValues(2)" ng-disabled="!userInitials.length"> SET All PM10 QA</button>
					<button style="height:auto;width:155px" class="button button1" ng-click="getSelectValues()"> SAVE QA/QC </button>
				</td>
				<td class="tg-yw4l" rowspan="2">
				<div style="overflow-x:auto;">
				<table class="pmData">
					<col width="100%">
						<tr style="background-color:#118D99">
							<th>  <font color = "White">Date </font></th>
							<th>  <font color = "White">PM25 temp </font></th>
							<th>  <font color = "White">PM25 pres </font></th>
							<th>  <font color = "White">PM25 hum </font></th>
							<th>  <font color = "White">PM2.5 ini </font></th>
							<th>  <font color = "White">PM2.5 QA/QC </font></th>
							<th>  <font color = "White">PM2.5 Conc </font></th>
							<th>  <font color = "White">Wind Dir </font></th>
							<th>  <font color = "White">Wind Speed </font></th>
							<th>  <font color = "White">PM10 Conc </font></th>
							<th>  <font color = "White">PM10 QA/QC </font></th>
							<th>  <font color = "White">PM10 ini </font></th>
							<th>  <font color = "White">PM10 hum </font></th>
							<th>  <font color = "White">PM10 pres </font></th>
							<th>  <font color = "White">PM10 temp </font></th>
						</tr>
						<tr ng-class='{rowRegular: record.highlight, rowBright: !record.highlight}'ng-repeat="record in recordset">
						<td style="min-width: 155px; max-width: 155px;"> {{record.dt}} </td>
							<td> {{record.PM25temp}} </td>
							<td> {{record.PM25pres}} </td>
							<td> {{record.PM25hum}} </td>
							<td> {{record.PM25initials}} </td>
							<td> 
								<select class="selectOption" ng-model="record.PM25qa" ng-options="option.vcOption for option in record.qaOptions track by option.nId" ng-change="PM25optionChanged()" ng-disabled="!userInitials.length"></select>
							</td>
							<td> {{record.PM25conc}} </td>
							
							<td> {{record.fWindDir}} </td>
							<td> {{record.fWindspeed}} </td>

							<td> {{record.PM10conc}} </td>
							<td> 
								<select class="selectOption" ng-model="record.PM10qa" ng-options="option.vcOption for option in record.qaOptions track by option.nId" ng-change="PM10optionChanged()" ng-disabled="!userInitials.length"></select>
							</td>
							<td> {{record.PM10initials}} </td>
							<td> {{record.PM10hum}} </td>
							<td> {{record.PM10pres}} </td>
							<td> {{record.PM10temp}} </td>
						</tr>
					</table>
					  </div>
				</td>
			</tr>
		</table>
    </div>

 
    </div>

 
    </div>
  


</body>
</html>



<script>
//scoping JSON data
var app = angular.module('myApp', []);
app.controller('qualityControl', function($scope, $http) {

	$scope.init = function(){
		$scope.selectedLocation = {options: {}, location: {}};

		$http.get("/getLocations").then(function(response) {
			if ($scope.selectedLocation == null){
				$scope.selectedLocation = {};
			}
			$scope.selectedLocation.options = response.data.recordset;
			//$scope.locations = response.data.recordset;
		});

		$http.get("/getOptions").then(function(response) {
			$scope.menuOptions = response.data.recordset;
		});
		
		
		$http.get("/EBAM").then(function(response) {
			$scope.recordset = response.data.recordset;
			angular.forEach($scope.recordset, function(obj){
				obj.PM25qa={"nId":obj.PM25qa};
				obj.PM10qa={"nId":obj.PM10qa};
				//Using dot notation
				obj.qaOptions = $scope.menuOptions;
			});
			
			//$scope.drawChartJS($scope.recordset);
		});

		$http.get("/initSearch").then(function(response) {
			//alert(JSON.stringify(response.data));
			$scope.selectedLocation.location.nId = response.data.lastLocation.nId;
			$scope.selectedLocation.location.vcLocation = response.data.lastLocation.vcLocation;
			$scope.dtStart = response.data.lastStartDate;
			$scope.dtEnd = response.data.lastEndDate;
		});
	}
	

    

    $scope.getData = function(){
        $http.get("/EBAM").then(function(response) {
            $scope.recordset = response.data.recordset;
            angular.forEach($scope.recordset, function(obj){
                obj.PM25qa={"nId":obj.PM25qa};
                obj.PM10qa={"nId":obj.PM10qa};
                //Using dot notation
                obj.qaOptions = $scope.menuOptions;
            });
            
			$scope.drawChartJS($scope.recordset);

        });
    };
	
	$scope.init();
	$scope.getData();

	$scope.lineOptions = {};
	/*
	$scope.lineOptions = {
			type: 'line',
			data: {
				labels: ['A','B'],
				datasets: [
					{
						label: 'PM2.5',
						fill: false,
						lineTension: 0.1,
						backgroundColor: "rgba(75,192,192,0.4)",
						borderColor: "rgba(75,192,192,1)",
						borderCapStyle: 'butt',
						borderDash: [],
						borderDashOffset: 0.0,
						borderJoinStyle: 'miter',
						pointBorderColor: "rgba(75,192,192,1)",
						pointBackgroundColor: "#fff",
						pointBorderWidth: 1,
						pointHoverRadius: 5,
						pointHoverBackgroundColor: "rgba(75,192,192,1)",
						pointHoverBorderColor: "rgba(220,220,220,1)",
						pointHoverBorderWidth: 2,
						pointRadius: 1,
						pointHitRadius: 10,
						data: [1,2],
						spanGaps: false,
					},	
					{
						label: 'PM10',
						fill: false,
						lineTension: 0.1,
						backgroundColor: "rgba(219,29,29,0.4",
						borderColor: "rgba(219,29,29,1)",
						borderCapStyle: 'butt',
						borderDash: [],
						borderDashOffset: 0.0,
						borderJoinStyle: 'miter',
						pointBorderColor: "rgba(219,29,29,1)",
						pointBackgroundColor: "#fff",
						pointBorderWidth: 1,
						pointHoverRadius: 5,
						pointHoverBackgroundColor: "rgba(219,29,29,1)",
						pointHoverBorderColor: "rgba(220,220,220,1)",
						pointHoverBorderWidth: 2,
						pointRadius: 1,
						pointHitRadius: 10,
						data: [3,4],
						spanGaps: false,
					}
				]
			},
			options: {
				scales: {
					yAxes: [{
					ticks: {
								reverse: false
					}
				  }]
				}
			}
		}
		*/
	
	$scope.ctx = document.getElementById('chartJSContainer').getContext('2d');
	$scope.lineChart = new Chart($scope.ctx,$scope.lineOptions);
	
	$scope.drawChartJS = function(jsonDataset){
        //google charts
        //convert JSON to array
        var arr = Object.values(jsonDataset);
        var dataArr = [];
		var timeArr = [];
		var trendA = [];
		var trendB = [];
        for(var i in arr){
            var t = arr[i].dt.split(/[- :]/);
			var tUTC = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
			var time = arr[i].dt;
            //var d = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));
            
            var validPM25Conc = arr[i].PM25conc;
            var validPM10Conc = arr[i].PM10conc;

            if(arr[i].PM25qa.nId == 2 || arr[i].PM25qa.nId == 3){
                //alert('bad data ' + validPM25Conc);
                validPM25Conc = null;
            }
            if(arr[i].PM10qa.nId == 2 || arr[i].PM10qa.nId == 3){
                //alert('bad data ' + validPM25Conc);
                validPM10Conc = null;
            }
        
            dataArr.push(
                [new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]), 
                //arr[i].CH1_ConcRT_ugM3, 
                //arr[i].CH1_ConcRT_ugM3_MA24 
                validPM25Conc, 
                validPM10Conc
                ]
            );
			timeArr[i]=time;
			trendA[i]=validPM25Conc;
			trendB[i]=validPM10Conc;
        }
		
		$scope.lineOptions = {
			type: 'line',
			data: {
				labels: timeArr,
				datasets: [
					{
						label: 'PM2.5',
						fill: false,
						lineTension: 0.1,
						backgroundColor: "rgba(75,192,192,0.4)",
						borderColor: "rgba(75,192,192,1)",
						borderCapStyle: 'butt',
						borderDash: [],
						borderDashOffset: 0.0,
						borderJoinStyle: 'miter',
						pointBorderColor: "rgba(75,192,192,1)",
						pointBackgroundColor: "#fff",
						pointBorderWidth: 1,
						pointHoverRadius: 5,
						pointHoverBackgroundColor: "rgba(75,192,192,1)",
						pointHoverBorderColor: "rgba(220,220,220,1)",
						pointHoverBorderWidth: 2,
						pointRadius: 1,
						pointHitRadius: 10,
						data: trendA,
						spanGaps: false,
					},	
					{
						label: 'PM10',
						fill: false,
						lineTension: 0.1,
						backgroundColor: "rgba(219,29,29,0.4",
						borderColor: "rgba(219,29,29,1)",
						borderCapStyle: 'butt',
						borderDash: [],
						borderDashOffset: 0.0,
						borderJoinStyle: 'miter',
						pointBorderColor: "rgba(219,29,29,1)",
						pointBackgroundColor: "#fff",
						pointBorderWidth: 1,
						pointHoverRadius: 5,
						pointHoverBackgroundColor: "rgba(219,29,29,1)",
						pointHoverBorderColor: "rgba(220,220,220,1)",
						pointHoverBorderWidth: 2,
						pointRadius: 1,
						pointHitRadius: 10,
						data: trendB,
						spanGaps: false,
					}
				]
			},
			options: {
				scales: {
					yAxes: [{
					ticks: {
								reverse: false
					}
				  }]
				}
			}
		}
		
		$scope.ctx = document.getElementById('chartJSContainer').getContext('2d');
		if($scope.lineChart !== undefined || $scope.lineChart !== null){
            $scope.lineChart.destroy();
		}
		$scope.lineChart = new Chart($scope.ctx,$scope.lineOptions);
    };

    
    $scope.postEbamSearchCriteria = function(){
        var dataObj = {
            location: $scope.selectedLocation.location,
			dtStart : $scope.dtStart,
			dtEnd : $scope.dtEnd
		};	
		var res = $http.post('/postEbamSearchCriteria', dataObj);
		res.success(function(data, status, headers, config) {
            //alert(JSON.stringify(data.recordset));
			$scope.recordset = data.recordset;
            angular.forEach($scope.recordset, function(obj){
                obj.PM25qa={"nId":obj.PM25qa};
                obj.PM10qa={"nId":obj.PM10qa};
                //Using dot notation
                obj.qaOptions = $scope.menuOptions;
            });
            
			$scope.drawChartJS($scope.recordset);
            //alert( "message sent");
		});
		res.error(function(data, status, headers, config) {
			//alert( "failure message: " + JSON.stringify({data: data}));
		});	
    };

    $scope.selectBoxesObj = {};

    $scope.getSelectValues = function(){
        $scope.selectBoxesObj = {};
        if ($scope.userInitials != null){
            angular.forEach($scope.recordset, function(obj){
            if(obj.PM25qa.nId != null){
                if($scope.selectBoxesObj[String(obj.PM25qa.nId)] == null){
                    $scope.selectBoxesObj[String(obj.PM25qa.nId)] = [];
                };
                $scope.selectBoxesObj[String(String(obj.PM25qa.nId))].push(obj.PM25nId);
            }
            if(obj.PM10qa.nId != null){
                if($scope.selectBoxesObj[String(obj.PM10qa.nId)] == null){
                    $scope.selectBoxesObj[String(obj.PM10qa.nId)] = [];
                };
                $scope.selectBoxesObj[String(String(obj.PM10qa.nId))].push(obj.PM10nId);
            };
        });
        
		$scope.drawChartJS($scope.recordset);
        $scope.postDataValidation();
        } else {
            alert("User Initials cannot be empty");
        };
    };

    $scope.setSelectValues = function(PM){
        angular.forEach($scope.recordset, function(obj){
            if(PM==1){
                obj.PM25qa.nId = $scope.setAllSelects.nId;
                obj.PM25initials = $scope.userInitials;
            } else if(PM==2){
                obj.PM10qa.nId = $scope.setAllSelects.nId;
                obj.PM10initials = $scope.userInitials;
            };
        });
        
		$scope.drawChartJS($scope.recordset);
        $scope.postDataValidation();
    };


    $scope.postDataValidation = function(){
        var dataObj = {update: $scope.selectBoxesObj, initials:$scope.userInitials};
		var res = $http.post('/postDataValidation', dataObj);
		res.success(function(data, status, headers, config) {
            //alert(JSON.stringify(data.recordset));
            //alert("Update Successful");
            $scope.getData();
		});
		res.error(function(data, status, headers, config) {
			//alert( "failure message: " + JSON.stringify({data: data}));
		});	
    };

	$scope.PM25optionChanged = function(){
		//alert(JSON.stringify(this.record));
		this.record.PM25initials = $scope.userInitials;
	};

	$scope.PM10optionChanged = function(){
		//alert(JSON.stringify(this.record));
		this.record.PM10initials = $scope.userInitials;
	};
});
	
	



</script>
</div>
</div>
</body>