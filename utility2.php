<?php

/**
*   @author: Arya Linggoputro
*   @date : 25 May 2015
*   @a im : Server as Utility Class V2 - where all the magic happen 
**/

date_default_timezone_set('Australia/Melbourne');


class utility2 {

	private $stringInput = "";

	function __construct($stringInput) {
       $this->stringInput = $stringInput;
	}
	
	public function doAction($print=FALSE) {
		$pattern = '/<script>window.ssGraphData = (.*?);<\/script>/s'; 
		preg_match_all($pattern, $this->stringInput , $matches);
		$clean_string = $matches[1][0];

		// make the $clean_string a valid json by wrapping each keys with double quote (")
		$valid_json = preg_replace("/(\n[\t ]*)([^\t ]+):/", "$1\"$2\":", $clean_string);

		$obj = json_decode($valid_json);

		$ssTrendData  = $obj->ssTrend;
		$volTrendData = $obj->volTrend;

		$result = array();
		foreach ($ssTrendData as $key => $val) {
			$date_key = date( 'Y-m-d h:i:s', $val[0]/1000 );
			$result[$date_key]['score']  = (string) $val[1];
			$result[$date_key]['volume'] = (string) $volTrendData[$key][1];
		}

		if($print) {
			echo "<pre>"; var_dump($result); echo "</pre>";
		}
		return $result;
	}

}

?>