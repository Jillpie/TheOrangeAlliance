<?php
	//Instances	
	$m = new MongoClient();
	$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');


	function MatchHistoryMatchAllianceTeam(){
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Teams');

		echo "<td>"
		echo "</td>"
	}


	function MatchHistoryTable(){

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
													//To calculate RP via their gameplay
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
																case "Rasied Off The Floor":
																	$ENDRP += 10;
																break;
																case "Rasied Above Vortex":
																	$ENDRP += 20;
																break;
																case "Scored In Cener Vortex":
																	$ENDRP += 40;
																break;
																default:
																	$AUTORP += 9000;
															}
													$calcRP = $AUTORP + $DRIVERRP + $ENDRP;
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
	}
?>