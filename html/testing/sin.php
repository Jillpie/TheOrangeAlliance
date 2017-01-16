<!DOCTYPE html>
<html>
	<body>
		
		<div class="test">
			<p>Testing goses here!
			<div>
				<form action="mytesting.php" method="post">
					firstname: <input type="text" name="firstname"><br>
					lastname: <input type="text" name="lastname"><br>
					<input type="submit">
				</form>
			<div></div>
				<?php
					echo "hi";
					// connect to mongodb
					$m = new MongoClient();
					echo "Connection to database successfully";
					// select a database
					$db = $m->test;
					echo "Database test selected";
					$collection = $db->createCollection("myCollectionTest");
					echo "Collection created";
					$document = array(
						"title" => $_POST['object'],
						"desciption" => "database",
						"likes" => 100
					);
					//$collection->insert($document);
					//echo "Document inserted successfully!";
					//$cursor = $collection->find();
					// iterate cursor to display title of documents

					foreach ($cursor as $document) {
						echo $document["title"] . "\n";
					}
				?>
			</div>	
			</p>
		</div>
		<div id="demo">
			<button type="button" onclick="loadXMLDoc()">Change</button>
		</div>
		<script>
			function loadXMLDoc() {
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("demo").innerHTML =
						this.responseText;
					}
				};
				xhttp.open("GET", "xmltest.xml", true);
				xhttp.send();
			}
		</script>
		<button type="button" onclick="loadDoc()">List</button>
<br><br>
<table id="demo"></table>

<script>
function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
	  myFunction(this);
	}
  };
  xhttp.open("GET", "list.xml", true);
  xhttp.send();
}
function myFunction(xml) {
  var i;
  var xmlDoc = xml.responseXML;
  var table="<tr><th>First Name</th><th>Last Name</th></tr>";
  var x = xmlDoc.getElementsByTagName("PEOPLE");
  for (i = 0; i <x.length; i++) { 
	table += "<tr><td>" +
	x[i].getElementsByTagName("FIRSTNAME")[0].childNodes[0].nodeValue +
	"</td><td>" +
	x[i].getElementsByTagName("LASTNAME")[0].childNodes[0].nodeValue +
	"</td></tr>";
  }
  document.getElementById("demo").innerHTML = table;
}
</script>
		<script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src = "js/bootstrap.js"></script>
	</body>
</html>