<?php
	
	//SOLID Puts Stuff In A <Td> <Td>
	function PutItInATD($stuffToPutIn){
		$HIGHLIGHTLIST = array(
			8097,
			9261,
			10809,
			'Crow Force 5',
			'Level Up',
			'Botcats'
		);
		$isItListed = false;
		foreach($HIGHLIGHTLIST as $highlight){
			if($highlight == $stuffToPutIn and gettype($stuffToPutIn) == gettype($highlight)){
				$isItListed = true;
			}
			if($highlight ){

			}
		}
		if($isItListed == true){
			echo "<td class='purple'>" . $stuffToPutIn . "</td>";
		}else{
		echo "<td>" . $stuffToPutIn . "</td>";
		}
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
					case 'Tie':
						$matchHistoryResultsFormated .= 'class="green">';
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
	// Removes a Match Hostyr Match Input fullfilling criteria
	function RemoveMatchHistoryMatchInput($dataValidation,$matchNumberInFour){
		$r = new MongoClient();
		$t = $r->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursort = $t->find(['MetaData.MetaData' => 'ScheduleInput' ,'MetaData.InputID' => $dataValidation]);
		$currentTeamForRP = 0;
			foreach($cursort as $document){
				$currentTeamForRP = $document['Match']['Match' . TrueMatchNumberTransformer($matchNumberInFour + 3) ][MatchNumberInFourToInterpertAsAllianceNumber($matchNumberInFour)];
			}
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$c->remove(['MetaData.MetaData' => 'MatchInput', 'MatchInformation.MatchNumber' => TrueMatchNumberTransformer($matchNumberInFour + 3) , 'MatchInformation.TeamNumber' => $currentTeamForRP]);
	}
	//Puts Together all the Functions to make up all of Match History
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
	//Puts Together all the Functions to make up all of Match History ALTERNATE FOR ADMIN
	function MatchHistoryTableAdmin($removeValue){
		$DATAVALIDATION = 'rainbow';
		for($currentMatchNumberInFour = 1; $currentMatchNumberInFour <= CountMatchesScheduleInputTimesFour($DATAVALIDATION); $currentMatchNumberInFour++){
			echo "<tr>";
			MatchHistoryMatchAllianceTeam($DATAVALIDATION,$currentMatchNumberInFour);
			MatchHistoryResults($currentMatchNumberInFour);
			MatchHistoryGameScore($DATAVALIDATION,$currentMatchNumberInFour);
			PutItInATD('<input class="btn btn-primary raised" type="submit" value=": 3">');
			echo "</tr>";
		}
		RemoveMatchHistoryMatchInput($DATAVALIDATION,$removeValue);
	}
	// Generates a Unique List from a un unique list 
	function GenerateUniqueList($ununiqueList){
		$uniqueList = array();
		foreach($ununiqueList as $ununique){
			$checkIfUnique = false;
			foreach($uniqueList as $unique){ 
				if($unique == $ununique){
					$checkIfUnique = true;
				}
			}
			if($checkIfUnique == false){
				$uniqueList[count($uniqueList)] = $ununique;
			}			
		}
		return $uniqueList;
	}
	//Generates a unique list of teams from data Validation
	function UniqueTeamList($dataValidation){
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursor = $c->find(['MetaData.MetaData' => 'ScheduleInput' ,'MetaData.InputID' => $dataValidation]);
		$ununiqueTeamList = array();
		for($currentMatchNumberInFour = 1; $currentMatchNumberInFour <= CountMatchesScheduleInputTimesFour($dataValidation); $currentMatchNumberInFour++){
			foreach($cursor as $document){
				$ununiqueTeamList[count($ununiqueTeamList)] = $document['Match']['Match' . TrueMatchNumberTransformer($currentMatchNumberInFour + 3) ][MatchNumberInFourToInterpertAsAllianceNumber($currentMatchNumberInFour)];
			}
		}
		return GenerateUniqueList($ununiqueTeamList);
	}
	//Makes an array of the matches that team played
	function WhichMatchesDidThatTeamPlayAndWhatAlliance($dataValidation, $teamToSearchFor){
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursor = $c->find(['MetaData.MetaData' => 'ScheduleInput' ,'MetaData.InputID' => $dataValidation]);
		$matchesPlayedByThatTeamAndAlliance = array();
		$redRedCombination = array(
			'Red1',
			'Red2'
		);
		$blueBlueCombination = array(
			'Blue1',
			'Blue2'
		);
		foreach($cursor as $document){
			for($matchNumber = 1; $matchNumber <= CountMatchesScheduleInputTimesFour($dataValidation)/4; $matchNumber++){
				foreach($redRedCombination as $currentColorRed){
					if($document['Match']['Match' . $matchNumber][$currentColorRed] == $teamToSearchFor){
						$matchesPlayedByThatTeamAndAlliance['Red'][count($matchesPlayedByThatTeamAndAlliance['Red'])] = $matchNumber;
					}
				}
				foreach($blueBlueCombination as $currentColorBlue){
					if($document['Match']['Match' . $matchNumber][$currentColorBlue] == $teamToSearchFor){
						$matchesPlayedByThatTeamAndAlliance['Blue'][count($matchesPlayedByThatTeamAndAlliance['Blue'])] = $matchNumber;
					}
				}
			}
		}
		return $matchesPlayedByThatTeamAndAlliance;
	}
	//Will Count and Complie whic teams ahd waht record they have
	function RankingsTableRecord($dataValidation){
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursor = $c->find(['MetaData.MetaData' => 'ResultsInput' ,'MetaData.InputID' => $dataValidation]);

		$listOfTeamsToRank = UniqueTeamList($dataValidation);
		$listOfTeamsRecords = array();
		$allianceColors = array(
			'Red',
			'Blue'
			);
		foreach($listOfTeamsToRank as $teamToRank){
			$teamToRankWins = 0;
			$teamToRankLoss = 0;
			$teamToRankTie = 0;
			$matchesThatTeamPlayedWithAlliance = WhichMatchesDidThatTeamPlayAndWhatAlliance($dataValidation, $teamToRank);
			foreach($allianceColors as $allianceColor){
				foreach($matchesThatTeamPlayedWithAlliance[$allianceColor] as $matchThatTeamPlayed){
					foreach($cursor as $document){
						if($document['MatchNumber'] == $matchThatTeamPlayed and $document['Winner'] == $allianceColor){
							$teamToRankWins++;
						}
						if($document['MatchNumber'] == $matchThatTeamPlayed and $document['Winner'] != $allianceColor and $document['Winner'] != 'Tie'){
							$teamToRankLoss++;
						}
						if($document['MatchNumber'] == $matchThatTeamPlayed and $document['Winner'] == 'Tie'){
							$teamToRankTie++;
						}
					}
				}
			}
			$listOfTeamsRecords['TeamNumber' . $teamToRank] = array(
				'TeamNumber' => $teamToRank,
				'Wins' => $teamToRankWins,
				'Loss' => $teamToRankLoss,
				'Tie' => $teamToRankTie,
				'GamesPlayed' => $teamToRankWins + $teamToRankLoss + $teamToRankTie,
				'Present' => $teamToRankWins . '-' . $teamToRankLoss . '-' . $teamToRankTie,
				'QP' => ($teamToRankWins * 2) + ($teamToRankTie)
			);
		}
		return $listOfTeamsRecords;

			/*
								$gate = array(
									array(
										'match' => array(
										)
									)
								);

								$mei = $c->aggregate();
								
								//$cursor = $c->find(['MetaData.MetaData' => 'ResultsInput']);
								
								$cursor = $c->aggregateCursor(
									[	
										['$group' => ['_id' => '$MatchNumber', 'points' =>['$sum' => '$Score']]],
										['$sort' => ['points' => -1]]
									]
								);
								PutItInATD($cursor['_id']['points']);
								//foreach($cursor as $thing){
									//PutItInATD('hi');
									//PutItInATD({$thing['_id']}:{$thing['points']}\n);
								//}
								
								
						$ops = array(
						    array(

						    	'$match' => array(
						    		'MetaData.MetaData' => 'ResultsInput'
						    	)
						    ),
						    
						    array(
						    	
						        '$project' => array(
						            "Score.Total.Red" => 1,
						            '_id' => 0
						        )
						    )
						    
						    array('$unwind' => '$MetaData'),
						    array(
						        '$group' => array(
						            "_id" => array("MetaData" => '$MetaData'),
						            "authors" => array('$addToSet' => '$author'),
						        ),
						    ),
						    
						);
						$results = $c->aggregate($ops);
						$c->insert($results);
							
						
						foreach($results as $pump){
							echo $pump; 
							echo '<br/><br/><br/><br/><br/><br/><br/>';
							var_dump($pump);
						}
						
						//var_dump($results);
		*/
	}
	function MatchNumberAndRP($dataValidation){
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursor = $c->find(['MetaData.MetaData' => 'ResultsInput' ,'MetaData.InputID' => $dataValidation]);
		$matchNumberAndRP = array();
		foreach($cursor as $document){
			if('Red' == $document['Winner']){
				$matchNumberAndRP['MatchNumber' . $document['MatchNumber']] = $document['Score']['Total']['Blue'];
			}
			if('Blue' == $document['Winner']){
				$matchNumberAndRP['MatchNumber' . $document['MatchNumber']] = $document['Score']['Total']['Red'];
			}
			if('Tie' == $document['Winner']){
				$matchNumberAndRP['MatchNumber' . $document['MatchNumber']] = $document['Score']['Total']['Red'];
			}
		}
		return $matchNumberAndRP;
	}
	function RankingsTableRP($dataValidation, $teamToSearchFor){
		$matchesTeamPlayedInWithAlliance = WhichMatchesDidThatTeamPlayAndWhatAlliance($dataValidation, $teamToSearchFor);
		$matchNumberAndRP = MatchNumberAndRP($dataValidation);
		$teamRP = 0;
		foreach($matchesTeamPlayedInWithAlliance as $matchTeamPlayed){
			foreach($matchTeamPlayed as $matchTeam){
				$teamRP += $matchNumberAndRP['MatchNumber' . $matchTeam];
			}
		}
		return $teamRP;
	}
	function EnsureExampleData(){
		$DATAVALIDATION = 'rainbow';
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursor = $c->find(['MetaData.MetaData' => 'ScheduleInput' ,'MetaData.InputID' => $DATAVALIDATION]);
		$checkForExample = false;
		$EXMAPLEDATA = array(
			array(
				'MetaData' => array(
					'MetaData' => 'ScheduleInput',
					'TimeStamp' => 'EXAMPLEDATA!!!!',
					'InputID' => 'rainbow'
				),
				'Match' => array(
					'Match1' => array(
						'Red1' => 6226,
						'Red2' => 8097,
						'Blue1' => 5229,
						'Blue2' => 11107
					),
					'Match2' => array(
						'Red1' => 11107,
						'Red2' => 6226,
						'Blue1' => 8097,
						'Blue2' => 5229
					),
					'Match3' => array(
						'Red1' => 5229,
						'Red2' => 11107,
						'Blue1' => 6226,
						'Blue2' => 8097
					),
					'Match4' => array(
						'Red1' => 8097,
						'Red2' => 5229,
						'Blue1' => 11107,
						'Blue2' => 6226
					)
				)
			),
			array(
				'MetaData' => array(
					'MetaData' => 'ResultsInput',
					'TimeStamp' => 'EXAMPLEDATA',
					'InputID' => 'rainbow'
				),
				'MatchNumber' => 1,
				'Winner' => 'Blue',
				'Score' => array(
					'Total' => array(
						'Red' => 12,
						'Blue' => 23
						),
					'Penalty' => array(
						'Red' => 0,
						'Blue' => 0
						),
					'Final' => array(
						'Red' => 12,
						'Blue' => 23
						)
				)
			),
			array(
				'MetaData' => array(
					'MetaData' => 'ResultsInput',
					'TimeStamp' => 'EXAMPLEDATA',
					'InputID' => 'rainbow'
				),
				'MatchNumber' => 4,
				'Winner' => 'Blue',
				'Score' => array(
					'Total' => array(
						'Red' => 40,
						'Blue' => 90
						),
					'Penalty' => array(
						'Red' => 0,
						'Blue' => 0
						),
					'Final' => array(
						'Red' => 40,
						'Blue' => 90
						)
				)
			)
		);
		foreach($cursor as $document){
			if($document['MetaData']['InputID'] == $DATAVALIDATION){
				$checkForExample = true;
			}
		}
		if($checkForExample == false){
			foreach($EXMAPLEDATA as $data){
				$c->insert($data);
			}
		}
	}
	function PurgeOfTheNonValidations($DATAVALIDATION){
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursor = $c->find();
		$toAggregate = array(
			array(
				'project' => array(
					'invalid' => array(
						'$ne' => array(
							'$MetaData.MetaData' => 'rainbow'
						)
					)
				)
			)
		);
		$notValid = $cursor->aggregate($toAggregate);
		foreach($notValid as $document){
			if($document['invalid'] = true){
			}
		}
	}
	function RankingsRank($dataValidation, $teamToRank){
		$uniqueTeamList = UniqueTeamList($dataValidation);
		$rankingsTableRecordInstance = RankingsTableRecord($dataValidation);
		$teamRanksScore = array();
		$teamRanks = array();
		$teamRank = 0;
		foreach($uniqueTeamList as $uniqueTeam){
			$teamRanksScore['Team' . $uniqueTeam] = $rankingsTableRecordInstance['TeamNumber' . $uniqueTeam]['QP'] * 1000 + RankingsTableRP($dataValidation, $uniqueTeam);
		}
		foreach($uniqueTeamList as $uniqueTeam){
			$teamRank = 1;
			foreach($uniqueTeamList as $uniqueTeam1){
				if($teamRanksScore['Team' . $uniqueTeam] < $teamRanksScore['Team' . $uniqueTeam1]){
					$teamRank++;
				}
			}
			$teamRanks['Team' . $uniqueTeam] = $teamRank;
		}
		return $teamRanks;
	}
	//The Table Ranking For all of Rankings
	function RankingsTable(){
		$DATAVALIDATION = 'rainbow';
		$uniqueTeamListInstance = UniqueTeamList($DATAVALIDATION);
		$rankingsTableRecordInstance = RankingsTableRecord($DATAVALIDATION);
		$rankingsRank = RankingsRank($DATAVALIDATION, $uniqueTeam);

		foreach($uniqueTeamListInstance as $uniqueTeam){		
			echo "<tr>";
			PutItInATD($rankingsRank['Team' . $uniqueTeam]);
			PutItInATD($uniqueTeam);
			PutItInATD(TeamNumberName($uniqueTeam));
			PutItInATD($rankingsTableRecordInstance['TeamNumber' . $uniqueTeam]['Present']);
			PutItInATD($rankingsTableRecordInstance['TeamNumber' . $uniqueTeam]['QP']);
			PutItInATD(RankingsTableRP($DATAVALIDATION, $uniqueTeam));
			PutItInATD('testing');
			echo "</tr>";
		}
		//EnsureExampleData();
	}
?>