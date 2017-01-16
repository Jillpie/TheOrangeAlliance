<!DOCTYPE html>
<html>
	<head>
		<title>The Orange Alliance</title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<meta name = "viewport" content="width=device-width, initial-scale=1.0">
		<link href = "css/bootstrap.min.css" rel = "stylesheet" type="text/css">
		<link href = "css/styles.css" rel = "stylesheet" type="text/css">
		<link href = "css/jquery.dataTables.min.css" rel = "stylesheet" type="text/css">
		<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAH3yAACM/wDb7P8AAC4DAABo3gAAWd4ADGsAABfEAAAAO7MAYq71AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABVWVQAAAAAhEVaVlQAAAiIhFWZVUAACIiIRVZWQACIiIiERVlUAIiIiIiFWlQCiMiIiIhVlACIiIiIiIVUAojIyIiIhFQAqIiIiIiISAAKiMjIiIiAAACoqIiIiAAAAAAB3dAAAAAAAAAeHQAAAAAAABHhwAAAAAAAAB3cAD4HwAA4AcAAMADAADAAwAAgAEAAIABAACAAQAAgAEAAIABAACAAQAAwAMAAOAHAAD+HwAA/w8AAP8PAAD/xwAA" rel="icon" type="image/x-icon" />
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="js/jquery.dataTables.min.js"></script> 
		<script type="text/javascript">
			$(document).ready(function() { 
			$("#inputTable1").DataTable({
				paging: false
				}); 
				$("#inputTable2").DataTable({
				paging: false
				}); 
				$("#inputTable3").DataTable({
				paging: false
				}); 
			} );
		</script>
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
					<?php
						$m = new MongoClient();
						$db = $m->TheOrangeAllianceTest;
					?>
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
		
		<div class="content">
			<div class="container">
				<h1>Week 3: Boys and Girls Club Meet</h1>
				<hr></hr>
			
				<ul class="nav nav-tabs">
					<li role="presentation" class="active"><a data-toggle="tab" href="#rankings">Rankings</a></li>
					<li role="presentation"><a data-toggle="tab" href="#match-history">Match History</a></li>
					<li role="presentation"><a data-toggle="tab" href="#average-scores">Average Scores</a></li>
				</ul>
			
				<div class="tab-content">
					<div style="padding-top: 10px;" id="rankings" class="tab-pane fade in active">
						<table class="table table-striped table-bordered tablesorter" id="inputTable1">
							<thead>
								<tr>
									<th>Team Number</th>
									<th>Team Name</th>
									<th>Ranking</th>
									<th>Record</th>
									<th>Games Played</th>
									<th>QP</th>
									<th>RP</th>
									<th>OPR</th>
								</tr>
							</thead>
						</table>
					</div>
					
					<div style="padding-top: 10px;" id="match-history" class="tab-pane fade">
						<table class="table table-striped table-bordered" id="inputTable2">
							<thead>
								<tr>
									<th class="homepage-size">Match</th>
									<th class="homepage-size">Alliance</th>
									<th class="homepage-size">Team Number</th>
									<th class="homepage-size">Team Name</th>
									<th class="homepage-size">Result</th>
									<th class="homepage-size">RP</th>
									<th class="red homepage-size">Robot Parking</th>
									<th class="red homepage-size">Particles in Center</th>
									<th class="red homepage-size">Particles in Corner</th>
									<th class="red homepage-size">Cap Ball</th>
									<th class="red homepage-size">Beacons</th>
									<th class="blue homepage-size">Particles in Center</th>
									<th class="blue homepage-size">Particles in Corner</th>
									<th class="green homepage-size"> Beacons</th>
									<th class="green homepage-size">Cap Ball</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$collectionName = "Y201701211";
								$collection = $db->$collectionName;

								$cursor = $collection->find();

								function TeamNumberName($teamNumber){
									$m = new MongoClient();
									$db = $m->TheOrangeAllianceTest;
									$functionSubCollection = "Teams";
									$acollection = $db->$functionSubCollection;
									$functionCursor = $acollection->find();
									$teamName = "TeamNamePlaceHolder";
									foreach($functionCursor as $document){
										$teamName = $document["TeamInformation"][strval($teamNumber)];
									}
									if($teamName == ""){
										$teamName = "NO NAME";
									}
									return  $teamName;
								}
								function DocumentIDListGenerator($metaData){
									$m = new MongoClient();
									$db = $m->TheOrangeAllianceTest;
									$functionSubCollection = "Y201701211";
									$acollection = $db->$functionSubCollection;
									$functionCursor = $acollection->find(["MetaData.MetaData" => $metaData]);

									$documentIDList = array();
									$documentIDListCreatorIndex = 0;
									foreach($functionCursor as $document){
										$documentIDList[$documentIDListCreatorIndex] = $document["_id"];
										$documentIDListCreatorIndex++;
									}
									return  $documentIDList;
								}

								//Makes sure to not add extra rows with no value
								$numberOfDocuments = 0;
								foreach($cursor as $document){
									$numberOfDocuments++ ;
								};
								
								//Generates list of ids
								$documentIDList = array();
								$documentIDList = DocumentIDListGenerator('MatchInput');
								
								$calcRP = 123;
								$AUTORP = 123;
								foreach($documentIDList as $documentID){
									echo "<tr>";
									$cursor = $collection->find(['_id' => $documentID]);
									foreach($cursor as $document){
										//To calculate RP via their gameplay
											//AUTO
											$AUTORP = 0;
												switch($document["GameInformation"]["AUTO"]["RobotParking"]){
													case "Did Not Park":
														$AUTORP += 0;
													break;
													case "Partially On Center Vortex":
														$AUTORP += 5;
													break;
													case "Partially On Corner Vortex":
														$AUTORP += 5;
													break;
													case "Fully On Center Vortex":
														$AUTORP += 10;
													break;
													case "Fully On Corner Vortex":
														$AUTORP += 10;
													break;
													default:
														$AUTORP += 9000;
												}

										//To input the values into the cells
											echo "<td>" . $document["MatchInformation"]["MatchNumber"] . "</td>";
											echo "<td>" . $document["MatchInformation"]["RobotAlliance"] . "</td>";
											echo "<td>" . $document["MatchInformation"]["TeamNumber"] . "</td>";
											echo "<td>" . TeamNumberName($document["MatchInformation"]["TeamNumber"]) . "</td>";
											echo "<td>" . $document["_id"] . "</td>";
											echo "<td>" . $AUTORP . "</td>";
											echo "<td>" . $document["GameInformation"]["AUTO"]["RobotParking"] . "</td>";
											echo "<td>" . $document["GameInformation"]["AUTO"]["ParticlesCenter"] . "</td>";
											echo "<td>" . $document["GameInformation"]["AUTO"]["ParticlesCorner"] . "</td>";
											echo "<td>" . $document["GameInformation"]["AUTO"]["CapBall"] . "</td>";
											echo "<td>" . $document["GameInformation"]["AUTO"]["ClaimedBeacons"] . "</td>";
											echo "<td>" . $document["GameInformation"]["DRIVER"]["ParticlesCenter"] . "</td>";
											echo "<td>" . $document["GameInformation"]["DRIVER"]["ParticlesCorner"] . "</td>";
											echo "<td>" . $document["GameInformation"]["END"]["AllianceClaimedBeacons"] . "</td>";
											echo "<td>" . $document["GameInformation"]["END"]["CapBall"] . "</td>";
									}
									echo "</tr>";
								}
								
								/* LEGACY DO NOT DELETE:
								for($matchNumber = 1; $matchNumber <= $numberOfDocuments; $matchNumber++){
									echo "<tr>";
									$cursor = $collection->find(['MatchInformation.MatchNumber' => $matchNumber]);
									foreach($cursor as $document){
										echo "<td>" . $matchNumber . "</td>";
										echo "<td>" . $document["MatchInformation"]["RobotAlliance"] . "</td>";
										echo "<td>" . $document["MatchInformation"]["TeamNumber"] . "</td>";
										echo "<td>" . TeamNumberName($document["MatchInformation"]["TeamNumber"]) . "</td>";
										echo "<td>" . $document["_id"] . "</td>";
										echo "<td>" . $maxMatchNumber . "</td>";
										echo "<td>" . $document["GameInformation"]["AUTO"]["RobotParking"] . "</td>";
										echo "<td>" . $document["GameInformation"]["AUTO"]["ParticlesCenter"] . "</td>";
										echo "<td>" . $document["GameInformation"]["AUTO"]["ParticlesCorner"] . "</td>";
										echo "<td>" . $document["GameInformation"]["AUTO"]["CapBall"] . "</td>";
										echo "<td>" . $document["GameInformation"]["AUTO"]["ClaimedBeacons"] . "</td>";
										echo "<td>" . $document["GameInformation"]["DRIVER"]["ParticlesCenter"] . "</td>";
										echo "<td>" . $document["GameInformation"]["DRIVER"]["ParticlesCorner"] . "</td>";
										echo "<td>" . $document["GameInformation"]["END"]["AllianceClaimedBeacons"] . "</td>";
										echo "<td>" . $document["GameInformation"]["END"]["CapBall"] . "</td>";
									}
									echo "</tr>";
								}
								*/
								echo "<tr><td>Debug <br /> </td></td>";
								echo "<tr><td>" . $documentIDList . " <br /> </td></td>";

								//echo $documentIDList;
							?>
							</tbody>
						</table>
					</div>
					<div id="average-scores" style="padding-top: 10px;" class="tab-pane fade">
						<table class="table table-striped table-bordered" id="inputTable3">
							<thead>
								<tr>
									<th>Team Number</th>
									<th>Team Name</th>
									<th class="red">Robot Parking</th>
									<th class="red">Particles in Center Vortex</th>
									<th class="red">Particles in Corner Vortex</th>
									<th class="red">Cap Ball in Contact With the Floor</th>
									<th class="red">Claimed Beacons</th>
									<th class="blue">Particles in Center Vortex</th>
									<th class="blue">Particles in Corner Vortex</th>
									<th class="green">Claimed Beacons</th>
									<th class="green">Cap Ball</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			</div>
		</div>
		<script src = "js/bootstrap.js"></script>
	</body>
</html>