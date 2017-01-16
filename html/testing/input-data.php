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
			<h1>Input Data</h1>
			<hr></hr>
			<table class="table table-striped table-bordered">
			<tr>
				<th colspan="2">Match Information</th>
			</tr>
			<tr>
				<td>Match Date</td>
				<td><input type="input" class="form-control" id="inputID"></td>
			</tr>
			<tr>
				<td>Match Location</td>
				<td><input type="input" class="form-control" id="inputID"></td>
			</tr>
			<tr>
				<td>Match Number</td>
				<td><input type="input" class="form-control" id="inputID"></td>
			</tr>
			<tr>
				<td>Robot Alliance</td>
				<td><input type="input" class="form-control" id="inputID"></td>
			</tr>
			<tr>
				<td>Team Number</td>
				<td><input type="input" class="form-control" id="inputID"></td>
			</tr>
			</table>
			<table class="table table-striped table-bordered">
			<tr>
				<th colspan="2">Autonomous Period Scoring</th>
			</tr>
			<tr>
				<td>Robot Parking</td>
				<td><input type="input" class="form-control" id="inputID"></td>
			</tr>
			<tr>
				<td>Particles scored in <u><b>Center</b></u> Vortex</td>
				<td><input type="input" class="form-control" id="inputID"></td>
			</tr>
			<tr>
				<td>Particles scored in <u><b>Corner</b></u> Vortex</td>
				<td><input type="input" class="form-control" id="inputID"></td>
			</tr>
			<tr>
				<td>Cap Ball in Contact with the Floor</td>
				<td><input type="input" class="form-control" id="inputID"></td>
			</tr>
			<tr>
				<td><img src="beacon.png" class="img-responsive">Claimed Beacons</td>
				<<td><input type="input" class="form-control" id="inputID"></td>
			</tr>
			</table>
			
			<table class="table table-striped table-bordered">
			<tr>
				<th colspan="2">Driver-Controlled Period Scoring</th>
			</tr>
			<tr>
				<td>Particles scorder in <u><b>Corner</b></u> Vortex</td>
				<td><input type="input" class="form-control" id="inputID"></td>
			</tr>
			<tr>
				<td>Particles scored in <u><b>Center</b></u> Vortex</td>
				<td><input type="input" class="form-control" id="inputID"></td>
			</tr>
			</table>
			
			<table class="table table-striped table-bordered">
			<tr>
				<th colspan="2">End Game Period Scoring</th>
			</tr>
			<tr>
				<td><u><b>Alliance</b></u> Claimed Beacons (Both Alliance Robots Will Share the Same Score)</td>
				<td><input type="input" class="form-control" id="inputID"></td>
			</tr>
			<tr>
				<td>Cap Ball</td>
				<td><input type="input" class="form-control" id="inputID"></td>
			</tr>

			</table>
			
			
		<center><button type="button" class="btn btn-primary btn-block raised">Submit</button></center>
		</div>
		</div>
		<script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src = "js/bootstrap.js"></script>
	</body>
</html>