<?php

/**
*   @author: Arya Linggoputro
*   @date : 25 May 2015
*   @a im : Server as Utility Class - where all the magic happen 
**/

date_default_timezone_set('Australia/Melbourne');
class utility {
	
	
	private $new_array = array();
	private $stringInput = "";
	private $text = "";

	function __construct($stringInput) {
       $this->stringInput = $stringInput;
	}
	
	public function doAction($print=FALSE) {
		$pattern = '/<script>window.ssGraphData = (.*?)<\/script>/s';
		preg_match_all($pattern, $this->stringInput, $matches);
		$this->txt = $matches[1][0];

		// 1. generate ssTrend Data
		$ssTrendData = $this->_generateSSTrendData();

		// 2. generate volTrend Data
		$volTrendData = $this->_generateVolTrendData();

		$result = array();
		foreach($ssTrendData as $key=>$val) {
			$val2 = $volTrendData[$key];
			$result[$key]["score"] = $val;
			$result[$key]["volume"] = $val2;

		}

		if($print) {
			echo "<pre>"; var_dump($result); echo "</pre>";
		}
		return $result;
	}



	// Generating SS Trend Data
	private function _generateSSTrendData() {
		$pattern = '/ssTrend:(.*?)ssColor:/s';
		preg_match_all($pattern, $this->txt, $matches);
		$ssTrend = preg_replace('/,(?=[^,]*$)/', '', $matches[1][0]);   // removing the last comma
		$ssTrend = substr(trim($ssTrend),1,-1);

		$ssTrend = preg_replace_callback("/\[([^\]]+)\]/", array($this, "_replace_function"), $ssTrend);  // replace the content insinde the square bracket , original: [1394323200000,97] to [1394323200000-97]
		preg_match_all("^\[(.*?)\]^", $ssTrend, $ssTrendMatches);
		$tmp = implode(",", $ssTrendMatches[1]);
	
		$ssTrendFormatted = $this->_explodeToAssocArray(",", $tmp);
		return $ssTrendFormatted;
	}

	private function _generateVolTrendData() {
		$pattern = '/volTrend:(.*?)}/s';
		preg_match_all($pattern, $this->txt, $matches);
		$volTrend = substr(trim($matches[1][0]),1,-1);

		$volTrend = preg_replace_callback("/\[([^\]]+)\]/", array($this, "_replace_function"), $volTrend);
		preg_match_all("^\[(.*?)\]^", $volTrend, $volTrendMatches);
		$tmp = implode(",", $volTrendMatches[1]);
	
		$volTrendFormatted = $this->_explodeToAssocArray(",", $tmp);
		return $volTrendFormatted;

	}

	private function _explodeToAssocArray($delimiter, $string) {
		$array = explode($delimiter, $string);
		array_walk($array, array($this, '_walk'), $this->new_array);
		return $this->new_array;
	}	

	private function _walk($val, $key){
    	$nums = explode('-',$val);

		$datetime = date('Y-m-d h:i:s', $nums[0]/1000);   // format time : '2014-03-09 11:00:00' , need divided 1000 since it epoch time

    	$this->new_array[$datetime] = $nums[1];
	}

	private function _replace_function($s) {

  		return str_replace(",", "-", $s[0]);
	}

}

?>