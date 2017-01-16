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
						<li><a href = "http://theorangealliance.tk:8080/input-data.php">Input Data</a></li>
						<li class = "active"><a href = "http://theorangealliance.tk:8080/input-results.php">Input Results</a></li>
						<li ><a href = "http://theorangealliance.tk:8080/input-schedule.php">Input Schedule</a></li>
						
					</ul>
				</div>
			</div>
		</div>
		</header>
		
		<div class="content">
		<div class="container">
		<form action="importphp.php" method="post">
			<h1>Input Results</h1>
			<hr></hr>
			<table class="table table-striped table-bordered">
				<tr>
					<th>Match Date</th>
					<th>Match Location</th>
				</tr>
				<tr>
					<td class="green"><select class="form-control" id="inputID" name="matchDate">
					<option>20170121</option>
					</select>
					</td>
					<td class="green"><select class="form-control" id="inputID" name="matchLocation">
					<option>Boys and Girls: Club 2230 E Jewett St, San Diego, CA 92111</option>
					</select>
					</td>
				</tr>
				<tr>
					<th>Match Number</th>
					<th>Winner</th>
				</tr>
				<tr>
					<td class="green"><input type="number" class="form-control" id="inputID" name="matchNumber"></td>
					<td class="green"><select class="form-control" id="inputID" name="winner">
						<option>Blue</option>
						<option>Red</option>
						<option>Tie</option>
					</select>
					</td>	
					</tr>
					</table>
					<table class="table table-striped table-bordered">
			<tr>
				<th colspan="2"> Total Points Scored </th>
			</tr>
			<tr>
				<td class="blue"><input type="number" class="form-control" id="inputID" name="totalPointsScoredBlue"></td>
				<td class="red"><input type="number" class="form-control" id="inputID" name="totalPointsScoredRed"></td>
			</tr>
			<tr>
				<th colspan="2"> Penalty Points</th>
			</tr>
			<tr>
				<td class="blue"><input type="number" class="form-control" id="inputID" name="penaltyPointsBlue"></td>
				<td class="red"><input type="number" class="form-control" id="inputID" name="penaltyPointsRed"></td>
			</tr>
			<tr>
				<th colspan="2">Final Score</th>
			</tr>
			<tr>
				<td class="blue"><input type="number" class="form-control" id="inputID" name="finalScoreBlue"></td>
				<td class="red"><input type="number" class="form-control" id="inputID" name="finalScoreRed"></td>
			</tr>
			</table>
			<center><button type="submit" class="btn btn-primary btn-block raised" >Submit</button></center>
		</form>
		</div>
		</div>
		<?php
			//MongoDBSetup
				// connect to mongodb
				$m = new MongoClient();
				// select a database
				$db = $m->TheOrangeAllianceTest;
				$collectionName = "Teams";
				$collection = $db->$collectionName;

			
			function inputTeamNumberName(){
				//Team Number and Name
					$teamNumberArray = array(
						2885,
						3513,
						3650,
						3712,
						3848,
						4216,
						4262,
						4278,
						5015,
						5131,
						5135,
						5136,
						5229,
						5540,
						5828,
						6003,
						6016,
						6074,
						6137,
						6226,
						7159,
						7214,
						7542,
						7696,
						8000,
						8039,
						8097,
						8380,
						8471,
						8472,
						8605,
						8606,
						8742,
						8906,
						9022,
						9049,
						9164,
						9261,
						9266,
						9367,
						9441,
						9837,
						9892,
						9920,
						10092,
						10221,
						10390,
						10564,
						10793,
						10809,
						11107,
						11128,
						11212,
						11278,
						11285,
						11288,
						11328,
						11350,
						11411,
						11445,
						11656,
						11764,
						11840,
						11938,
						12073,
						12405,
						12406
					);
					$teamNameArray = array(
						'Kronos',
						'Domo Arigato',
						'Torrey Techies Blue',
						'Purple F.E.A.R.',
						'Shockwave',
						'Rise of Hephaestus',
						'Ridgebots',
						'De.Evolution',
						'Buffalo Wings',
						'PL Robotics',
						'Team Uncopyrightable',
						'Crusader Creators',
						'Dragons',
						'Skynet',
						'E.M.P. Chaos',
						'Techno Eagles',
						'Ironwolves',
						'R.A.W.A.L.A',
						'RoBowties',
						'Bambusa',
						'Robo Ravens',
						'The Cruzers',
						'OLP Microchicks',
						'RSF Singularity',
						'Team Paradox',
						'Return of the Adrenaline Snails',
						'Botcats',
						'UC Robotics',
						'The Ducks',
						'Robotatoes',
						'RSF Logitechies',
						'RSF Intergalactic Dragons',
						'MVMS Robotechs',
						'ROARbots',
						'T-Wrecks',
						'Robopuffs',
						'Zorrobots',
						'Level Up',
						'Pyrobots',
						'Torrey Techies White',
						'Syndicate',
						'Ravenettes',
						'EngiNERDs',
						'Furious Falcons',
						'Green.Griffins',
						'Robotx',
						'STEM Scouts',
						'iMiddle Robotics',
						'Voltrons',
						'Crow Force 5',
						'Wired Up',
						'Inspiration',
						'The Clueless',
						'Virtually Creative',
						'PATENT PENDING',
						'Seminerds',
						'Foothills Engineers',
						'Sloth Slowbotics',
						'Cherry Pi',
						'Crusader Creators #2',
						'Neutron Stars',
						'UC High Centurions',
						'MTM (Tbd)',
						'GPA Eagles',
						'The Trisectors',
						'Game of Drones',
						'Hakuna Automata'
					);

				//Accociation
				$TeamInformationArray = array();
				
				for ($row = 0; $row < count($teamNumberArray); $row++){
					$TeamInformationArray += array(
						$teamNumberArray[$row] => $teamNameArray[$row]
					);
				}
				/*			
					for ($row = 0; $row < count($teamNumberArray); $row++){
					$TeamInformationArray["TeamID" . ($row + 1)]["TeamNumber"] => $teamNumberArray[.row];
					$TeamInformationArray["TeamID" . ($row + 1)]["TeamName"] => $teamNameArray[.row];
				};
				*/
				
				$document = array(
					"MetaData" => array(
						"MetaData" => "TeamList"
					),
					"TeamInformation" => $TeamInformationArray
				);
				return $document;
			}
			
			$document = inputTeamNumberName();
			$collection->insert($document);
		?>
		<script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src = "js/bootstrap.js"></script>
	</body>
</html>