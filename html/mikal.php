<?php
	
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
	
	
	$m = new MongoClient();
	$db = $m->TheOrangeAllianceTest;
	$collectionName = "Y201701211";
	$collection = $db->$collectionName;	

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
	

?>