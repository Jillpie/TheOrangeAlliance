<!DOCTYPE html>
<html>
	<head>
	<?php
		$m = new MongoClient();
		$db = $m->TheOrangeAllianceTest;
	?>
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
						<li class = "active"><a href = "http://theorangealliance.tk:8080/">Home</a></li>
						<li><a href = "http://theorangealliance.tk:8080/input-data.php">Input Data</a></li>
						<li><a href = "http://theorangealliance.tk:8080/input-results.php">Input Results</a></li>
						<li ><a href = "http://theorangealliance.tk:8080/input-schedule.php">Input Schedule</a></li>
						
					</ul>
				</div>
			</div>
		</div>
		</header>
		
		<div class="test">
			<div class="container">
				<?php
					$subCollection = "Y201701211";
					$collection = $db->$subCollection;
					$document = $collection->find();
					var_dump($document);

					echo "hi" . "<br />";
					echo $collection . "<br />";
					var_dump($collection);
					echo "<br />";

					$crit = array(
						"MatchInput" => array(
							"MetaData.MetaData",
							"MetaData.TimeStamp",
							"MetaData.InputID",

							"MatchInformation.MatchNumber",
							"MatchInformation.RobotAlliance",
							"MatchInformation.TeamNumber",

							"GameInformation.AUTO.RobotParking",
							"GameInformation.AUTO.ParticlesCenter",
							"GameInformation.AUTO.ParticlesCorner",
							"GameInformation.AUTO.CapBall",
							"GameInformation.AUTO.ClaimedBeacons",
							"GameInformation.DRIVER.ParticlesCenter",
							"GameInformation.DRIVER.ParticlesCorner",
							"GameInformation.END.AllianceClaimedBeacons",
							"GameInformation.END.CapBall"
							),
						"ResultsInput" => array(
							"MetaData.MetaData",
							"MetaData.TimeStamp",
							"MetaData.InputID",

							"MatchNumber",
							"Winner",
							"Score.Total.Red",
							"Score.Total.Blue",
							"Score.Penalty.Red",
							"Score.Penalty.Blue",
							"Score.Final.Red",
							"Score.Final.Blue"
							)
					);
					$cursor = $collection->find();
					foreach ($cursor as $document) {
						foreach ($crit["ResultsInput"] as $i){
							echo $i . " : " . $document[$i] . "<br />";
						}
						foreach ($crit["MatchInput"] as $i){
							echo $i . " : " . $document[$i][$i] . "<br />";
						}
					echo "<br />";
					}
					var_dump($document);

				?>
			</div>
		</div>
		<script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src = "js/bootstrap.js"></script>
	</body>
</html>