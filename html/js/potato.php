<?php
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
	function RankingsTable($datePlace){
	}
	function MatchHistoryTable($datePlace, $dataValidation){
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('test');
		$cursor = $c->find(['MetaData.MetaData' => 'MatchOutput' ,'MetaData.InputID' => $dataValidation]);

		foreach($cursor as $document){
			echo '<tr>';
			foreach($document as $row){
				foreach($row as $value){
					PutItInATD($value);
				}
			}
			echo '</tr>';
		}

	}
	function AverageScoresTable($datePlace){
	}
?>