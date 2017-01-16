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
		<form action="input-results.php" method="post">
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
					<td class="green"><input type="input" class="form-control" id="inputID" name="matchNumber"></td>
					<td class="green"><select class="form-control" id="inputID" name="winner">
						<option>Blue</option>
						<option>Red</option>
					</select>
					</td>	
					</tr>
					</table>
					<table class="table table-striped table-bordered">
			<tr>
				<th colspan="2"> Total Points Scored </th>
			</tr>
			<tr>
				<td class="blue"><input type="input" class="form-control" id="inputID" name="totalPointsScoredBlue"></td>
				<td class="red"><input type="input" class="form-control" id="inputID" name="totalPointsScoredRed"></td>
			</tr>
			<tr>
				<th colspan="2"> Penalty Points</th>
			</tr>
			<tr>
				<td class="blue"><input type="input" class="form-control" id="inputID" name="penaltyPointsBlue"></td>
				<td class="red"><input type="input" class="form-control" id="inputID" name="penaltyPointsRed"></td>
			</tr>
			<tr>
				<th colspan="2">Final Score</th>
			</tr>
			<tr>
				<td class="blue"><input type="input" class="form-control" id="inputID" name="finalScoreBlue"></td>
				<td class="red"><input type="input" class="form-control" id="inputID" name="finalScoreRed"></td>
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
				$collectionName = "Y" . $_POST['matchDate'] . 1;
				$collection = $db->$collectionName;
			$document = array(
				"MetaData" => "ResultsInput",
				"TimeStamp" => "MUAHHAHAHHA",
				"InputID" => "I AM GRUUUUU",
				"MatchNumber" => $_POST['matchNumber'],
				"Winner" => $_POST['winner'],
				"TotalPointsScoredRed" => $_POST['totalPointsScoredRed'],
				"TotalPointsScoredBlue" => $_POST['totalPointsScoredBlue'],
				"PenaltyPointsRed" => $_POST['penaltyPointsRed'],
				"PenaltyPointsBlue" => $_POST['penaltyPointsBlue'],
				"FinalScoreRed" => $_POST['finalScoreRed'],
				"FinalScoreBlue" => $_POST['finalScoreBlue']
			);
			$collection->insert($document);
		?>
		<script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src = "js/bootstrap.js"></script>
	</body>
</html>