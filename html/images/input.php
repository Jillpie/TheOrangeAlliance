<?php
	
	function PlaceID($placeFullAddress, $dataValidation){
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Places');
		$cursor = $c->find(['MetaData.MetaData' => 'Places', 'MetaData.InputID' => 'rainbow']);
		$placeID = 'ERROR';
		foreach($cursor as $document){
			if($document['PlaceInformation']['PlaceFullAddress'] == '1615 Mater Dei Dr, Chula Vista, CA 91913'){
					$placeID = str($document['PlaceInformation']['PlaceID']);
				//break;
			}
			$placeID = 'IRAN';
		}
		//return $placeID;
	}
	function TimeTime($time){
		$timeFinal = 0;
		$timeDay = 0;
		$timeMonth = 0;
		$timeYear = 0;
		$timeBad = explode('/',$time);
		$timeDay = $timeBad[1];
		$timeMonth = $timeBad[0];
		$timeYear = $timeBad[2];
		$timeFinal = '20' . $timeYear . $timeMonth . $timeDay;
		return $timeFinal;
	}
?>