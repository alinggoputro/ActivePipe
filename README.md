Prepared by: Arya Linggoputro on 25 May 2015 For ActivePipe

The solution build using PHP 

Problem:
Take the below string and break it out into arrays. The string is made of two ‘arrays’ ssTrend and volTrend. You will notice that the first long number is the same in each array, this should be your array key.

$input_string = '<script>window.ssGraphData = {
   	             	ssTrend: [[1394323200000,97],[1394409600000,97],[1394496000000,97],[1394582400000,96],[1394668800000,97],[1394755200000,97],[1394841600000,97],[1394928000000,97],[1395014400000,97],[1395100800000,97],[1395187200000,97],[1395273600000,97],[1395360000000,99],[1395446400000,99],[1395532800000,99],[1395619200000,99],[1395705600000,99],[1395792000000,99],[1395878400000,99],[1395964800000,99],[1396051200000,99],[1396137600000,99],[1396224000000,99],[1396310400000,99],[1396396800000,99],[1396483200000,98],[1396569600000,97],[1396656000000,99],[1396742400000,99],[1396828800000,97],[1396915200000,99]],
   	             	ssColor: "#129f12",
   	             	volTrend: [[1394323200000,11400],[1394409600000,7898],[1394496000000,6897],[1394582400000,11501],[1394668800000,11796],[1394755200000,13993],[1394841600000,14000],[1394928000000,14000],[1395014400000,14566],[1395100800000,14908],[1395187200000,9495],[1395273600000,7122],[1395360000000,6029],[1395446400000,6033],[1395532800000,6451],[1395619200000,5806],[1395705600000,6943],[1395792000000,6553],[1395878400000,7172],[1395964800000,8698],[1396051200000,8705],[1396137600000,8286],[1396224000000,8270],[1396310400000,7216],[1396396800000,5498],[1396483200000,5027],[1396569600000,35281],[1396656000000,47339],[1396742400000,47339],[1396828800000,63416],[1396915200000,66000]]};</script>’

Your output should be a var_dump and contain the following information:

array(31) {
  '2014-03-09 11:00:00' =>
  array(2) {
	'score' =>
	string(2) "97"
	'volume' =>
	string(5) "11400"
  }
  '2014-03-10 11:00:00' =>
  array(2) {
	'score' =>
	string(2) "97"
	'volume' =>
	string(4) "7898"
  }
  '2014-03-11 11:00:00' =>
  array(2) {
	'score' =>
	string(2) "97"
	'volume' =>
	string(4) "6897"
  }..... continued until the end of the array.

Tackle this anyway you would like, this is a real problem we solved last week.

Note.
 - please add comments to your code
 - you can not modify by hand the value of $input_string as that is how we received it from the external source, you can modify it in code if you wish though. 
