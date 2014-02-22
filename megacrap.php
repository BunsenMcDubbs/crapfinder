<?php
	
	// first get the file
	$file = fopen('shit.csv', 'r');
	
	// results delimited by ~
	// properties delimited by %
	
	$results = array();
	$counter = 0;
	while (! feof($file) ){
		$results[$counter] = fgetcsv($file,0,'*');
		$counter = $counter + 1;
	}
	
	fclose($file);
	
	// now file is separated by results and properties
	// store the max value
	$maxValue = 30;
	
	$affordableItems = array();
	// traverse the array and remove all items that are more expensive than the max value
	$j = 0;
	// index for the most expensive thing I can get
	$maxIndex = -1;
	// running max value so far
	$runningMax = -1;
	
	for($i = 0; $i < count($results); $i++){
		// check the max value, if it is less, then add to the array
		if($results[$i][3] <= $maxValue){
			$affordableItems[$j] = $results[$i];
			
			
			// if need be, reset the runningMax and maxIndex
			
			if($results[$i][3] > $runningMax){
				$maxIndex = $i;
				$runningMax = $results[$i][3];
			}
			
			$j++;
		}
	}
	
	// now I have all the items I can afford
	
	//formulate first result: most expensive thing I can buy
	$mostExpensiveItem = $results[$maxIndex];
	
	var_dump($mostExpensiveItem);
	
	

?>