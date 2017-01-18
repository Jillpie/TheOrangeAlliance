<?php
	
	//SOLID Puts Stuff In A <Td> <Td>
	function PutItInATD($stuffToPutIn){
		echo "<td>" . $stuffToPutIn . "</td>";
	}
	//Transforms a liniar model into its division of 4 peridodicaly ex: 4 = 1, 5 = 1... 8 = 2
	function TrueMatchNumberTransformer($trueMatchNumber){
		return intval($trueMatchNumber / 4);
	}
	//SOLID Serches though TheOrangeAlliance.Teams to convert a team number into a team name
	function TeamNumberName($teamNumber){
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Teams');
		$cursor = $c->find(['MetaData.MetaData' => 'TeamList']);
		$teamName = "TeamNamePlaceHolder";
		foreach($cursor as $document){
			$teamName = $document["TeamInformation"][strval($teamNumber)];
		}
		if($teamName == ""){
			$teamName = "NO NAME";
		}
		return  $teamName;
	}
	//SOLID Countes the amount of matches in schedule then times it by four
	function CountMatchesScheduleInputTimesFour($dataValidation){
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursor = $c->find(['MetaData.MetaData' => 'ScheduleInput' ,'MetaData.InputID' => $dataValidation]);
		foreach ($cursor as $document) {
			$amountOfMatchesTimesFour = count($document['Match']);
		}
		$amountOfMatchesTimesFour *= 4; 
		return $amountOfMatchesTimesFour;
	}
	//SOLID Takes in Number 1-4... Peridocically giving it 'Red1', 'Red2', 'Blue1', 'Blue2'
	function MatchNumberInFourToInterpertAsAllianceNumber($matchNumberInFour){
			switch ($matchNumberInFour % 4) {
				case 1 % 4:
					$interpertedMatchNumberInFour = 'Red1';
					break;
				case 2 % 4:
					$interpertedMatchNumberInFour = 'Red2';
					break;
				case 3 % 4:
					$interpertedMatchNumberInFour = 'Blue1';
					break;
				case 4 % 4:
					$interpertedMatchNumberInFour = 'Blue2';
					break;
				default:
					$interpertedMatchNumberInFour = 'Pink';
					break;
			}
		return $interpertedMatchNumberInFour;
	}
	//SOLID Changes Red1 ... Blue2 into Red ... Blue and adds class='red' HAS ITS OWN TD AND ECHO 
	function AllianceColorNumberInterperterToColor($allianceColorNumber){
		switch ($allianceColorNumber) {
			case 'Red1':
				$interpertedAllianceColor = '<td class="red">Red</td>';
				break;
			case 'Red2':
				$interpertedAllianceColor = '<td class="red">Red</td>';
				break;
			case 'Blue1':
				$interpertedAllianceColor = '<td class="blue">Blue</td>';
				break;
			case 'Blue2':
				$interpertedAllianceColor = '<td class="blue">Blue</td>';
				break;
			default:
				$interpertedAllianceColor = '<td class="pink">Pink</td>';
				break;
		}
		echo $interpertedAllianceColor;
	}
	// Does all the Match Number Aliance Team Number Team Name For Match History
	function MatchHistoryMatchAllianceTeam($dataValidation , $matchNumberInFour){
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursor = $c->find(['MetaData.MetaData' => 'ScheduleInput' ,'MetaData.InputID' => $dataValidation]);
			foreach($cursor as $document){
				PutItInATD(TrueMatchNumberTransformer($matchNumberInFour + 3));
				AllianceColorNumberInterperterToColor(MatchNumberInFourToInterpertAsAllianceNumber($matchNumberInFour));
				PutItInATD($document['Match']['Match1'][MatchNumberInFourToInterpertAsAllianceNumber($matchNumberInFour)]);
				PutItInATD(TeamNumberName($document['Match']['Match1'][MatchNumberInFourToInterpertAsAllianceNumber($matchNumberInFour)]));
			}
	}
	// Does All the Results and RP for Match History
	function MatchHistoryResultsAndRP($matchNumberInFour){
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursor = $c->find(['MetaData.MetaData' => 'ResultsInput']);
			foreach($cursor as $document){

			}
	}
	function MatchHistoryTable(){
		$DATAVALIDATION = 'rainbow';
		for($currentMatchNumberInFour = 1; $currentMatchNumberInFour <= CountMatchesScheduleInputTimesFour($DATAVALIDATION); $currentMatchNumberInFour++){
			echo "<tr>";

			MatchHistoryMatchAllianceTeam($DATAVALIDATION,$currentMatchNumberInFour);
			MatchHistoryResultsAndRP();

			echo "<tr>";
		}
	}

	
	/* Leagacy: 
		function TheOrangeAllianceLogos($logoSelect){
			switch ($logoSelect) {
				case 1:
					echo 'Orange Alliance';
				break;
				case 2:
					echo 'The Orange Alliance';
				break;
				default:
					echo 'Juicy';
				break;
			}
		}
		function TotalMatchesComplex($iDVerification){ 
			$m = new MongoClient();
			$db = $m->TheOrangeAllianceTest;
			$functionSubCollection = "Y201701211";
			$acollection = $db->$functionSubCollection;

			$functionCursor = $acollection->find(['MetaData.MetaData' => "ScheduleInput", 'MetaData.InputID' => $iDVerification ]);

			$matchesComplex = array();
			$matchNumberInc = 0;
			foreach($functionCursor as $document){
				foreach($document['Match'] as $matchNumberComplex){
					$matchNumberInc++;
					$matchesComplex['Match' . $matchNumberInc] = array(
						'Red1' => $matchNumberComplex['Red1'],
						'Red2' => $matchNumberComplex['Red2'],
						'Blue1' => $matchNumberComplex['Blue1'],
						'Blue2' => $matchNumberComplex['Blue2']
					);
				}
			}
			return $matchesComplex;
		}
		function MakeMatchArray($matchesComplex){
			$matchArray = array();
			$thisMatchNumber = 0;
			foreach($matchesComplex as $matchNumberInterval){
				$thisMatchNumber++;
				$matchArray[(4 * ($thisMatchNumber - 1)) + 1] = $matchNumberInterval['Red1'];
				$matchArray[(4 * ($thisMatchNumber - 1)) + 2] = $matchNumberInterval['Red2'];
				$matchArray[(4 * ($thisMatchNumber - 1)) + 3] = $matchNumberInterval['Blue1'];
				$matchArray[(4 * ($thisMatchNumber - 1)) + 4] = $matchNumberInterval['Blue2'];
			}
			
			return $matchArray;
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
		function MatchResults($matchNumber){
			$m = new MongoClient();
			$db = $m->TheOrangeAllianceTest;
			$functionSubCollection = "Y201701211";
			$acollection = $db->$functionSubCollection;
			$functionCursor = $acollection->find(["MetaData.MetaData" => 'ResultsInput' , 'MatchNumber' => $matchNumber]);
			$matchResults = array();
			foreach($functionCursor as $document){
			//	$scoreFinalRed = $document['Score']['Final']['Red'];
			//	$scoreFinalBlue = $document['Score']['Final']['Blue'];
				$matchResults = array(
					'ScoreFinalRed' => $document['Score']['Final']['Red'],
					'ScoreFinalBlue' => $document['Score']['Final']['Blue'],
					'Winner' => $document['Winner']
				);
			return $matchResults;
			}
		}
		function MatchResultsFormat($matchResults){
			$matchResultsFormated = '';
			switch ($matchResults['Winner']) {
				case 'Blue':
					$matchResultsFormated .= "<td class='blue'>";
				break;
				case 'Red':
					$matchResultsFormated .= "<td class='red'>";
				break;
				case 'Tie':
					$matchResultsFormated .= "<td class='green'>";
				break;
				default:
					$matchResultsFormated .= "<td class='pink'>";
				break;
			}

			$matchResultsFormated .= $matchResults['ScoreFinalRed'] . '-' . $matchResults['ScoreFinalBlue'] . "</td>";
			if(is_null($matchResults['ScoreFinalRed']) or is_null($matchResults['ScoreFinalBlue'])){
				$matchResultsFormated = "<td class='pink'>" . 'NOT POSTED' . "</td>";
			}
			return $matchResultsFormated;
		}
		function AllianceColorationAlt($alliance){
			$allianceColor = '';
			switch ($alliance) {
				case 'Red':
					$allianceColor = "<td class='red'>";
					break;
				case 'Blue':
					$allianceColor = "<td class='blue'>";
					break;
				default:
					$allianceColor = "<td class='pink'>";
					break;
			}
			return $allianceColor;
		}
		function InterpertColoration($quarter){
			$alliance = '';
			switch ($quarter) {
				case 1 % 4:
				$alliance = 'Red';
					break;
				case 2 % 4:
				$alliance = 'Red';
					break;
				case 3 % 4:
				$alliance = 'Blue';
					break;
				case 4 % 4:
				$alliance = 'Blue';
					break;
				default:
				$alliance = 'Pink';
					break;
			}
			return $alliance;
		}

			$m = new MongoClient();
			$db = $m->TheOrangeAllianceTest;
			$collectionName = "Y201701211";
			$collection = $db->$collectionName;
			
			//Makes sure to not add extra rows with no value
			$numberOfDocuments = 0;
			foreach($cursor as $document){
				$numberOfDocuments++ ;
			}
			
			//Generates list of ids
			$documentIDList = array();
			$documentIDList = DocumentIDListGenerator('MatchInput');
			$documentIDAmount = count($documentIDList);
			
			$calcRP = 123;
			$AUTORP = 123;
			$DRIVERRP = 123;
			$ENDRP = 123;
			$realMatchNumber = 0;
			$dataValidation = 'rainbow';

			function MatchHistoryTable(){
				for($currentMatch = 1; $currentMatch <= count(MakeMatchArray(TotalMatchesComplex($dataValidation))); $currentMatch++ ){
					if(($currentMatch % 4) == (1 % 4)){
						$realMatchNumber++;
					}
					$documentExist = false;
					echo "<tr>";
					echo "<td>" . $realMatchNumber . "</td>";
					echo AllianceColorationAlt(InterpertColoration($currentMatch % 4)) . InterpertColoration($currentMatch % 4) . "</td>";
					echo "<td>" . MakeMatchArray(TotalMatchesComplex($dataValidation))[$currentMatch] . "</td>";
					echo "<td>" . TeamNumberName(MakeMatchArray(TotalMatchesComplex($dataValidation))[$currentMatch]) . "</td>";

					$cursor = $collection->find(['MetaData.MetaData' => 'MatchInput', 'MatchInformation.MatchNumber' => $currentMatch]);
					
					foreach($cursor as $document){
						$documentExist = true;
						//To input the values into the cells
							//echo AllianceColorationAlt($document["MatchInformation"]["RobotAlliance"]) . $document["MatchInformation"]["RobotAlliance"] . "</td>";
							//echo "<td>" . $document["MatchInformation"]["TeamNumber"] . "</td>";
							//echo "<td>" . TeamNumberName($document["MatchInformation"]["TeamNumber"]) . "</td>";
							echo MatchResultsFormat(MatchResults($document["MatchInformation"]["MatchNumber"]));
							//echo "<td style='color:white' class='red' >" . $document["_id"] . "</td>";
							echo "<td>" . $calcRP . "</td>";
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
					if($documentExist == false){
						for($i = 0; $i <= 10; $i++){
							echo "<td/>";
						}
					}
					echo "</tr>";
				}	
			}
			MatchHistoryTable();
		function AverageScoresTable(){
			$m = new MongoClient();
			$db = $m->TheOrangeAllianceTest;
			$collectionName = "Y201701211";
			$collection = $db->$collectionName;
			$cursor = $collection->find();
			$numberOfDocuments = 0;
			foreach($cursor as $document){
				$numberOfDocuments++ ;
			}
			foreach($documentIDList as $documentID){
				echo "<tr>";
				$cursor = $collection->find(['_id' => $documentID]);
				foreach($cursor as $document){
						echo "<td>" . $document["MatchInformation"]["MatchNumber"] . "</td>";
						echo AllianceColorationAlt($document["MatchInformation"]["RobotAlliance"]) . $document["MatchInformation"]["RobotAlliance"] . "</td>";
						echo "<td>" . $document["MatchInformation"]["TeamNumber"] . "</td>";
						echo "<td>" . TeamNumberName($document["MatchInformation"]["TeamNumber"]) . "</td>";
						echo "<td>" . $calcRP . "</td>";
						echo "<td>" . $document["GameInformation"]["AUTO"]["RobotParking"] . "</td>";
						echo "<td>" . $document["GameInformation"]["AUTO"]["ParticlesCenter"] . "</td>";
						echo "<td>" . $document["GameInformation"]["AUTO"]["ParticlesCorner"] . "</td>";
						echo "<td>" . $document["GameInformation"]["AUTO"]["CapBall"] . "</td>";
						echo "<td>" . $document["GameInformation"]["AUTO"]["ClaimedBeacons"] . "</td>";
						echo "<td>" . $document["GameInformation"]["DRIVER"]["ParticlesCenter"] . "</td>";
				}
				echo "</tr>";
			}
		}
		AverageScoresTable();
	*/
	
	function Debug($show){
		$debugEchoArray = array(
			'Hi',
			'Two',
			'Three'
			);
		for ($i=0; $i <= count($debugEchoArray); $i++) { 
			echo "<br/>";
			echo $debugEchoArray[$i];
		}
		$projection =  array("_id" => false, "FactoryCapacity" => true);
		echo "<br/>";
		var_dump($projection);

	}
	
?>