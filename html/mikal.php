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
	// Calculates RP from Data in Input Data outputs int
	function CalculatesRPFromData($dataValidation, $matchNumberInFour){
		$r = new MongoClient();
		$t = $r->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursort = $t->find(['MetaData.MetaData' => 'ScheduleInput' ,'MetaData.InputID' => $dataValidation]);
		$currentTeamForRP = 0;
			foreach($cursort as $document){
				$currentTeamForRP = $document['Match']['Match' . TrueMatchNumberTransformer($matchNumberInFour + 3) ][MatchNumberInFourToInterpertAsAllianceNumber($matchNumberInFour)];
			}
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursor = $c->find(['MetaData.MetaData' => 'MatchInput', 'MatchInformation.MatchNumber' => TrueMatchNumberTransformer($matchNumberInFour + 3) , 'MatchInformation.TeamNumber' => $currentTeamForRP]);
		//To calculate RP via their gameplay
			$checkIfItWorked = 0;
			foreach($cursor as $document){
				$checkIfItWorked++;
				//AUTO
					$AUTORP = 0;
					//RobotParking
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
					//Particles In Center
					$AUTORP += 15 * $document["GameInformation"]["AUTO"]["ParticlesCenter"];
					//Particles In Corner
					$AUTORP += 5 * $document["GameInformation"]["AUTO"]["ParticlesCorner"];
					//CapBall
					switch($document["GameInformation"]["AUTO"]["CapBall"]){
						case "No":
							$AUTORP += 0;
						break;
						case "Yes":
							$AUTORP += 5;
						break;
						default:
							$AUTORP += 9000;
					}
					//Beacons
					$AUTORP += 30 * $document["GameInformation"]["AUTO"]["ClaimedBeacons"];
				//DRIVER
					$DRIVERRP = 0;
					//Particles In Center
					$DRIVERRP += 5 * $document["GameInformation"]["DRIVER"]["ParticlesCenter"];
					//Particles In Corner
					$DRIVERRP += 1 * $document["GameInformation"]["DRIVER"]["ParticlesCorner"];
				//END
					$ENDRP = 0;
					//Allaince Calimed Beacons
					$ENDRP += 10 * $document["GameInformation"]["END"]["AllianceClaimedBeacons"];
					switch($document["GameInformation"]["END"]["CapBall"]){
						case "On The Ground":
							$ENDRP += 0;
						break;
						case "Raised Off The Floor":
							$ENDRP += 10;
						break;
						case "Raised Above Vortex":
							$ENDRP += 20;
						break;
						case "Scored In Center Vortex":
							$ENDRP += 40;
						break;
						default:
							$AUTORP += 9000;
					}
				}
			$calcRP = $AUTORP + $DRIVERRP + $ENDRP;
			if($checkIfItWorked == 0){
				$calcRP = '';
			}
		return $calcRP;
	}
	// Does all the Match Number Aliance Team Number Team Name For Match History
	function MatchHistoryMatchAllianceTeam($dataValidation , $matchNumberInFour){
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursor = $c->find(['MetaData.MetaData' => 'ScheduleInput' ,'MetaData.InputID' => $dataValidation]);
			foreach($cursor as $document){
				PutItInATD(TrueMatchNumberTransformer($matchNumberInFour + 3));
				AllianceColorNumberInterperterToColor(MatchNumberInFourToInterpertAsAllianceNumber($matchNumberInFour));
				PutItInATD($document['Match']['Match' . TrueMatchNumberTransformer($matchNumberInFour + 3) ][MatchNumberInFourToInterpertAsAllianceNumber($matchNumberInFour)]);
				PutItInATD(TeamNumberName($document['Match']['Match' . TrueMatchNumberTransformer($matchNumberInFour + 3)][MatchNumberInFourToInterpertAsAllianceNumber($matchNumberInFour)]));
			}
	}
	// Does All the Results into format HAS ITS DOWN TD and ECHO
	function MatchHistoryResults($matchNumberInFour){
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursor = $c->find(['MetaData.MetaData' => 'ResultsInput' , 'MatchNumber' => TrueMatchNumberTransformer($matchNumberInFour + 3)]);
		$matchHistoryResultsFormated = '<td ';	
			foreach($cursor as $document){
				switch ($document['Winner']) {
					case 'Red':
						$matchHistoryResultsFormated .= 'class="red">';
						break;
					case 'Blue':
						$matchHistoryResultsFormated .= 'class="blue">';
						break;
					default:
						$matchHistoryResultsFormated .= 'class="pink">';
						break;
				}
				$matchHistoryResultsFormated .= $document['Score']['Final']['Red'] . "-" . $document['Score']['Final']['Blue'] . '</td>';
			}
			if(is_null($document['Score']['Final']['Red']) or is_null($document['Score']['Final']['Blue'])){
				$matchHistoryResultsFormated = "<td class='pink'> NOT POSTED </td>";
			}
		echo $matchHistoryResultsFormated;
	}
	// Does The RP and all the game speificic stuff from input Data
	function MatchHistoryGameScore($dataValidation,$matchNumberInFour){
		$r = new MongoClient();
		$t = $r->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursort = $t->find(['MetaData.MetaData' => 'ScheduleInput' ,'MetaData.InputID' => $dataValidation]);
		$currentTeamForRP = 0;
			foreach($cursort as $document){
				$currentTeamForRP = $document['Match']['Match' . TrueMatchNumberTransformer($matchNumberInFour + 3) ][MatchNumberInFourToInterpertAsAllianceNumber($matchNumberInFour)];
			}
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursor = $c->find(['MetaData.MetaData' => 'MatchInput', 'MatchInformation.MatchNumber' =>  TrueMatchNumberTransformer($matchNumberInFour + 3) , 'MatchInformation.TeamNumber' => $currentTeamForRP ]);

		$checkIfItWorked = 0;
		PutItInATD(CalculatesRPFromData($dataValidation, $matchNumberInFour));
		foreach($cursor as $document){
			$checkIfItWorked++;
			PutItInATD($document["GameInformation"]["AUTO"]["RobotParking"]);
			PutItInATD($document["GameInformation"]["AUTO"]["ParticlesCenter"]);
			PutItInATD($document["GameInformation"]["AUTO"]["ParticlesCorner"]);
			PutItInATD($document["GameInformation"]["AUTO"]["CapBall"]);
			PutItInATD($document["GameInformation"]["AUTO"]["ClaimedBeacons"]);
			PutItInATD($document["GameInformation"]["DRIVER"]["ParticlesCenter"]);
			PutItInATD($document["GameInformation"]["DRIVER"]["ParticlesCorner"]);
			PutItInATD($document["GameInformation"]["END"]["AllianceClaimedBeacons"]);
			PutItInATD($document["GameInformation"]["END"]["CapBall"]);
		}
		if($checkIfItWorked == 0 ){
			for($i=1; $i <= 9 ; $i++) { 
				PutItInATD("");
			}
		}
	}

	function MatchHistoryTable(){
		$DATAVALIDATION = 'rainbow';
		for($currentMatchNumberInFour = 1; $currentMatchNumberInFour <= CountMatchesScheduleInputTimesFour($DATAVALIDATION); $currentMatchNumberInFour++){
			echo "<tr>";
			MatchHistoryMatchAllianceTeam($DATAVALIDATION,$currentMatchNumberInFour);
			MatchHistoryResults($currentMatchNumberInFour);
			MatchHistoryGameScore($DATAVALIDATION,$currentMatchNumberInFour);
			echo "</tr>";
		}
	}


	function Debug($show){
		/*
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
		*/

	}
	
?>