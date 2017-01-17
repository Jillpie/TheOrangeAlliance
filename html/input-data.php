<!DOCTYPE html>
<html>
	<head>
		<title>The Orange Alliance</title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<meta name = "viewport" content="width=device-width, initial-scale=1.0">
		<link href = "css/bootstrap.min.css" rel = "stylesheet" type="text/css">
		<link href = "css/styles.css" rel = "stylesheet" type="text/css">
		<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAH3yAACM/wDb7P8AAC4DAABo3gAAWd4ADGsAABfEAAAAO7MAYq71AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABVWVQAAAAAhEVaVlQAAAiIhFWZVUAACIiIRVZWQACIiIiERVlUAIiIiIiFWlQCiMiIiIhVlACIiIiIiIVUAojIyIiIhFQAqIiIiIiISAAKiMjIiIiAAACoqIiIiAAAAAAB3dAAAAAAAAAeHQAAAAAAABHhwAAAAAAAAB3cAD4HwAA4AcAAMADAADAAwAAgAEAAIABAACAAQAAgAEAAIABAACAAQAAwAMAAOAHAAD+HwAA/w8AAP8PAAD/xwAA" rel="icon" type="image/x-icon" />
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	</head>
	<body>
				<header>
		<div class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<a class="nav-brand" href="http://theorangealliance.tk:8080/"> 
					<img style="max-width:50px" src="logo.png">
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
						<li ><a href = "http://theorangealliance.tk:8080/">Home</a></li>
						<li class = "active"><a href = "http://theorangealliance.tk:8080/input-data.php">Input Data</a></li>
						<li><a href = "http://theorangealliance.tk:8080/input-results.php">Input Results</a></li>
						<li ><a href = "http://theorangealliance.tk:8080/input-schedule.php">Input Schedule</a></li>
						
					</ul>
				</div>
			</div>
		</div>
		</header>
		
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
					<td><select class="form-control" id="inputID" name="matchDate">
					<option>20170121</option>
					</select>
					</td>
			</tr>
			<tr>
				<td>Match Location</td>
					<td ><select class="form-control" id="inputID" name="matchLocation">
					<option>Boys and Girls: Club 2230 E Jewett St, San Diego, CA 92111</option>
					</select>
					</td>
			</tr>
			<tr>
				<td>Match Number</td>
				<td><input type="number" class="form-control" id="inputID" name="matchNumber"></td>
			</tr>
			<tr>
				<td>Robot Alliance</td>
				<td><select class="form-control" id="inputID" name="robotAlliance">
					<option>Blue</option>
					<option>Red</option>
				</select>
				</td>
			</tr>
			<tr>
				<td>Team Number</td>
				<td><input type="number" class="form-control" id="inputID" name="teamNumber"></td>
			</tr>
			<tr>
			<td>Validation Code</td>
				<td ><input type="text" class="form-control" id="inputID" name="dataValidation"></td>
			</tr>
			</table>
			
			<table class="table table-striped table-bordered">
			<tr>
				<th colspan="2">Autonomous Period Scoring</th>
			</tr>
			<tr>
				<td><img src="centervortex.png"><img src="cornervortex.png">Robot Parking</td>
				<td><select class="form-control" id="inputID" name="autoRobotParking">
					<option>Did Not Park</option>
					<option>Partially On Center Vortex</option>
					<option>Partially On Corner Vortex</option>
					<option>Fully On Center Vortex</option>
					<option>Fully On Corner Vortex</option>
				</select>
				</td>
			</tr>
			<tr>
				<td><img src="particles.png"><img src="centervortex.png">Particles scored in <u><b>Center</b></u> Vortex</td>
				<td><input type="number" class="form-control" id="inputID" name="autoParticlesCenter"></td>
			</tr>
			<tr>
				<td><img src="particles.png"><img src="cornervortex.png">Particles scored in <u><b>Corner</b></u> Vortex</td>
				<td><input type="number" class="form-control" id="inputID" name="autoParticlesCorner"></td>
			</tr>
			<tr>
				<td><img src="capballs.png">Cap Ball in Contact with the Floor (Only One Robot on Each Alliance Can Achieve This)</td>
				<td><select class="form-control" id="inputID" name="autoCapBall">
					<option>No</option>
					<option>Yes</option>
				</select>
				</td>
			</tr>
			<tr>
				<td>
				<img src="beacon.png">Claimed Beacons
				</td>
				<td><input type="number" class="form-control" id="inputID" name="autoClaimedBeacons"></td>
			</tr>
			</table>
			
			<table class="table table-striped table-bordered">
			<tr>
				<th colspan="2">Driver-Controlled Period Scoring</th>
			</tr>
			<tr>
				<td><img src="particles.png"><img src="centervortex.png">Particles scored in <u><b>Center</b></u> Vortex</td>
				<td><input type="number" class="form-control" id="inputID" name="driverParticlesCenter"></td>
			</tr>
			<tr>
				<td><img src="particles.png"><img src="cornervortex.png">Particles scored in <u><b>Corner</b></u> Vortex</td>
				<td><input type="number" class="form-control" id="inputID" name="driverParticlesCorner"></td>
			</tr>
			</table>
			
			<table class="table table-striped table-bordered">
			<tr>
				<th colspan="2">End Game Period Scoring</th>
			</tr>
			<tr>
				<td><img src="beacon.png"><u><b>Alliance</b></u> Claimed Beacons (Both Alliance Robots Will Share the Same Score)</td>
				<td><input type="number" class="form-control" id="inputID" name="endAllianceClaimedBeacons"></td>
			</tr>
			<tr>
				<td><img src="capballs.png">Cap Ball</td>
				<td><select class="form-control" id="inputID" name="endCapBall">
				<option>On The Ground</option>
				<option>Rasied Off The Floor</option>
				<option>Raised Above Vortex</option>
				<option>Scored In Center Vortex</option>
				</select>
				</td>
			</tr>

			</table>
			
			
		<center><button type="submit" class="btn btn-primary btn-block raised">Submit</button></center>
		</form>
		</div>
		</div>
		<?php
			//Loading and setting up the mongodb PHP
			$m = new MongoClient();
			$db = $m->TheOrangeAllianceTest;
			$collectionName = "Y" . $_POST['matchDate'] . 1;
			$collection = $db->$collectionName;

			//The stuff to do and send
			/*
			$document = array(
				"MetaData" => "MatchInput",
				"TimeStamp" => "MEOW",
				"InputID" => "I AM CHRIS",
				"MatchNumber" => $_POST['matchNumber'],

				"RobotAlliance" => $_POST['robotAlliance'],
				"TeamNumber" => $_POST['teamNumber'],

				"AUTORobotParking" => $_POST['autoRobotParking'],
				"AUTOParticlesCenter" => $_POST['autoParticlesCenter'],
				"AUTOParticlesConer" => $_POST['autoParticlesConer'],
				"AUTOCapBall" => $_POST['autoCapBall'],
				"AUTOClaimedBeaons" => $_POST['autoClaimedBeaons'],
				"DRIVERParticlesCenter" => $_POST['driverParticlesCenter'],
				"DRIVERParticlesCorner" => $_POST['driverParticlesCorner'],
				"ENDAllianceClaimedBeacons" => $_POST['endAllianceClaimedBeacons'],
				"ENDCapBall" => $_POST['endCapBall']
			);
			*/
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
		?>
		<script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src = "js/bootstrap.js"></script>
	</body>
</html>