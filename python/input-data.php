<!DOCTYPE html>
<html>
	<head>
		<title>The Orange Alliance</title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<meta name = "viewport" content="width=device-width, initial-scale=1.0">
		<link href = "css/bootstrap.min.css" rel = "stylesheet" type="text/css">
		<link href = "css/styles.css" rel = "stylesheet" type="text/css">
		<link rel="apple-touch-icon" sizes="152x152" href="https://sites.google.com/site/filehostdummysite1234/files/theorangealliance/apple-touch-icon.png?v=vMrqOno5qk">
		<link rel="icon" type="image/png" href="https://sites.google.com/site/filehostdummysite1234/files/theorangealliance/favicon-32x32.png?v=vMrqOno5qk" sizes="32x32">
		<link rel="icon" type="image/png" href="https://sites.google.com/site/filehostdummysite1234/files/theorangealliance/favicon-16x16.png?v=vMrqOno5qk" sizes="16x16">
		<link rel="manifest" href="https://sites.google.com/site/filehostdummysite1234/files/theorangealliance/manifest.json?v=vMrqOno5qk">
		<link rel="mask-icon" href="https://sites.google.com/site/filehostdummysite1234/files/theorangealliance/safari-pinned-tab.svg?v=vMrqOno5qk" color="#ff9500">
		<link rel="shortcut icon" href="https://sites.google.com/site/filehostdummysite1234/files/theorangealliance/favicon.ico?v=vMrqOno5qk">
		<meta name="apple-mobile-web-app-title" content="The Orange Alliance">
		<meta name="application-name" content="The Orange Alliance">
		<meta name="msapplication-config" content="https://sites.google.com/site/filehostdummysite1234/files/theorangealliance/browserconfig.xml?v=vMrqOno5qk">
		<meta name="theme-color" content="#ff9500">
		<script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="js-webshim/minified/polyfiller.js"></script>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	</head>
	<body>
		<div class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<a class="nav-brand" href="http://theorangealliance.tk:8080/"> 
					<img style="max-width:50px" src="/images/logo.png"> 
					<span class="logo hidden-xs">The Orange Alliance</span>
					</a>
					<a class="nav-brand" href="http://theorangealliance.tk:8080/"></a>
					<button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
						<span class = "icon-bar"></span>
						<span class = "icon-bar"></span>
						<span class = "icon-bar"></span>
					</button>
				</div>
				<div class = "collapse navbar-collapse navHeaderCollapse">
					<ul class = "nav navbar-nav navbar-right">
						<li><a href = "http://theorangealliance.tk:8080/">Home</a></li>
						<li><a href = "http://theorangealliance.tk:8080/euclid.php">Euclid</a></li>
						<li><a href = "http://theorangealliance.tk:8080/turing.php">Turing</a></li>
						<li class = "active"><a href = "http://theorangealliance.tk:8080/input-data.php">Input Data</a></li>
						<li><a href = "http://theorangealliance.tk:8080/input-results.php">Input Results</a></li>
						<li><a href = "http://theorangealliance.tk:8080/input-schedule.php">Input Schedule</a></li>
						
					</ul>
				</div>
			</div>
		</div>
		
		<div class="content">
		<div class="container">
			<form action="input-data.php" method="post">
			<h1>Input Data</h1>
			<hr></hr>
			<table class="table table-striped table-bordered">
			<tr>
				<th colspan="2">Match Information</th>
			</tr>
			<tr>
				<td>Match Date</td>
					<td><select class="form-control" id="inputID" name="matchDate" required>
						<option></option>
						<option>02/04/17</option>
						<option>02/05/17</option>
					</select>
					</td>
			</tr>
			<tr>
				<td>Match Location</td>
					<td ><select class="form-control" id="inputID" name="matchPlace" required>
						<option></option>
						<option>2230 E Jewett St, San Diego, CA 92111</option>
						<option>1615 Mater Dei Dr, Chula Vista, CA 91913</option>
					</select>
					</td>
			</tr>
			<tr>
				<td>Match Number</td>
				<td><input type="number" class="form-control" id="inputID" name="matchNumber" required></td>
			</tr>
			<tr>
				<td>Robot Alliance</td>
				<td><select class="form-control" id="inputID" name="robotAlliance" required>
					<option></option>
					<option>Blue</option>
					<option>Red</option>
				</select>
				</td>
			</tr>
			<tr>
				<td>Team Number</td>
				<td><input type="number" class="form-control" id="inputID" name="teamNumber" required></td>
			</tr>
			<tr>
			<td>Validation Code</td>
				<td ><input type="text" class="form-control" id="inputID" name="dataValidation" required></td>
			</tr>
			</table>
			
			<table class="table table-striped table-bordered">
			<tr>
				<th colspan="2">Autonomous Period Scoring</th>
			</tr>
			<tr>
				<td><img src="/images/centervortex.png"><img src="/images/cornervortex.png">Robot Parking</td>
				<td><select class="form-control" id="inputID" name="autoRobotParking" required>
					<option></option>
					<option>Did Not Park</option>
					<option>Partially On Center Vortex</option>
					<option>Partially On Corner Vortex</option>
					<option>Fully On Center Vortex</option>
					<option>Fully On Corner Vortex</option>
				</select>
				</td>
			</tr>
			<tr>
				<td><img src="/images/particles.png"><img src="/images/centervortex.png">Particles scored in Center Vortex</td>
				<td><input type="number" class="form-control" id="inputID" name="autoParticlesCenter" required></td>
			</tr>
			<tr>
				<td><img src="/images/particles.png"><img src="/images/cornervortex.png">Particles scored in Corner Vortex</td>
				<td><input type="number" class="form-control" id="inputID" name="autoParticlesCorner" required></td>
			</tr>
			<tr>
				<td><img src="/images/capballs.png">Cap Ball in Contact with the Floor (Only One Robot on Each Alliance Can Achieve This)</td>
				<td><select class="form-control" id="inputID" name="autoCapBall" required>
					<option></option>
					<option>No</option>
					<option>Yes</option>
				</select>
				</td>
			</tr>
			<tr>
				<td>
				<img src="/images/beacon.png">Claimed Beacons
				</td>
				<td><input type="number" class="form-control" id="inputID" name="autoClaimedBeacons" required></td>
			</tr>
			</table>
			
			<table class="table table-striped table-bordered">
			<tr>
				<th colspan="2">Driver-Controlled Period Scoring</th>
			</tr>
			<tr>
				<td><img src="/images/particles.png"><img src="/images/centervortex.png">Particles scored in Center Vortex</td>
				<td><input type="number" class="form-control" id="inputID" name="driverParticlesCenter" required ></td>
			</tr>
			<tr>
				<td><img src="/images/particles.png"><img src="/images/cornervortex.png">Particles scored in Corner Vortex</td>
				<td><input type="number" class="form-control" id="inputID" name="driverParticlesCorner" required></td>
			</tr>
			</table>
			
			
			
			<table class="table table-striped table-bordered">
			<tr>
				<th colspan="2">End Game Period Scoring</th>
			</tr>
			<tr>
				<td><img src="/images/beacon.png">Alliance Claimed Beacons (Both Alliance Robots Will Share the Same Score)</td>
				<td><input type="number" class="form-control" id="inputID" name="endAllianceClaimedBeacons" required></td>
			</tr>
			<tr>
				<td><img src="/images/capballs.png">Cap Ball</td>
				<td><select class="form-control" id="inputID" name="endCapBall" required>
				<option></option>
				<option>On The Ground</option>
				<option>Raised Off The Floor</option>
				<option>Raised Above Vortex</option>
				<option>Scored In Center Vortex</option>
				</select>
				</td>
			</tr>

			</table>
			
			
		<center><button type="submit" class="btn btn-primary btn-block raised">Submit</button></center>
		</form>
		<?php
			require 'input.php';
			function AllOfIt(){
			//Loading and setting up the mongodb PHP
			$m = new MongoClient();
				// select a database
				$db = $m->TheOrangeAllianceTest;
				$collectionName = "T" . TimeTime($_POST['matchDate']) . PlaceID($_POST['matchPlace'], $_POST['dataValidation']);
				$collection = $db->$collectionName;

			$document = array(
				"MetaData" => array(
					"MetaData" => "MatchInput",
					"TimeStamp" => "MEOW",
					"InputID" => $_POST['dataValidation']
				),
				
				"MatchInformation" => array(
					"MatchNumber" => intval($_POST['matchNumber']),
					"RobotAlliance" => $_POST['robotAlliance'],
					"TeamNumber" => intval($_POST['teamNumber'])
				),

				"GameInformation" => array(
					"AUTO" => array(
						"RobotParking" => $_POST['autoRobotParking'],
						"ParticlesCenter" => intval($_POST['autoParticlesCenter']),
						"ParticlesCorner" => intval($_POST['autoParticlesCorner']),
						"CapBall" => $_POST['autoCapBall'],
						"ClaimedBeacons" => intval($_POST['autoClaimedBeacons'])
					),
					"DRIVER" => array(
						"ParticlesCenter" => intval($_POST['driverParticlesCenter']),
						"ParticlesCorner" => intval($_POST['driverParticlesCorner'])
					),
					"END" => array(
						"AllianceClaimedBeacons" => intval($_POST['endAllianceClaimedBeacons']),
						"CapBall" => $_POST['endCapBall']
					)
				)
			);
			$collection->insert($document);
			}
			AllOfIt();
		?>
		</div>
		</div>
				<div class="footer">
			<div class="container">
				<div class="col-md-6" style="padding-bottom: 10px;">
				<center>
				Designed by:
				Team 8097 Botcats,
				Team 9261 Level Up,
				Team 10809 Crow Force 5
				</center>
				</div>
				<div class="col-md-3">
				</div>
				<div class="col-md-3" >
				<center>
					© TheOrangeAlliance 2017
					</cetner>
				</div>
			</div>
		</div>
<script> 
	$('#mySelect').change(function () {
		$('#mySelect').css("background", $("select option:selected").css("background-color"));
	});
        webshim.activeLang('en');
        webshims.polyfill('forms');
        webshims.cfg.no$Switch = true;
    </script>
		<script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src = "js/bootstrap.js"></script>
	</body>
</html>