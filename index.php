<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Crap Finder v0.6 beta</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
        </style>
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php"><span id="teamName"><b>Team mmmYEP</b></span> presents...</a>
          <a class="navbar-brand" href="about.html">about us.</a>
        </div>
      </div>
    </div>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container" id="search">
        <h1 id="hero">Find crap!</h1>
        
		<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
		How much money you want to blow: <span class="currencyinput">$
			<input type="number" name="dollar" required="true" min="0" step="any"
			autofocus="true"
			value="
			<?php 
				if(isset($_REQUEST["dollar"]))
					echo $_REQUEST["dollar"];
				else echo "0";
			?>
			">
			</span>
		<input type="submit" value="Spend!">
		</form>

      </div>
      
      <div class="container" id ="results">
      	
   	    <?php
   	    
   	    	function todollar($num){
   	    		return "\$".sprintf("%0.2f", $num);
   	    	}
   	    
			if(!isset($_REQUEST["dollar"])){
				return;
			}
			$maxValue = $_REQUEST["dollar"];
			if($maxValue == 0){
				return;
			}

			echo "<h2>With ".toDollar($maxValue)." you can buy...</h2>";
	
			
			// KOUSHIK'S CODE
	
			// first get the file
			$file = fopen('shit.csv', 'r');
			
			$results = array();
			$counter = 0;
			while (! feof($file) ){
				$results[$counter] = fgetcsv($file,0,'*');
				$counter = $counter + 1;
			}
			
			fclose($file);
			
			// now file is separated by results and properties
			
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
			
			// formulate result: random item
			if (count($affordableItems)-2 <= 0){
				echo "<p>Nothing.</p>";
				return;
			}
			$randIndex = mt_rand(0,count($affordableItems)-2);
			// echo $randIndex;
			
			// calculate how many of this item I can buy
			$items = $maxValue/$affordableItems[$randIndex][3];
			
			$finalItem = array();
			for($i = 0; $i < count($affordableItems[$randIndex]); $i++){
				$finalItem[$i] = $affordableItems[$randIndex][$i];
			}
			$finalItem[5] = floor($items);
			
			// var_dump($finalItem);
			
			
			// Putting the results onto the screen!
			if(isset($finalItem)){
				$name = $finalItem[0];
				$image = $finalItem[1];
				$link = $finalItem[2];
				$price = $finalItem[3];
				$comment = $finalItem[4];
				$multiple = $finalItem[5];
				echo 
				"<p><b>".$multiple." x </b><i>".$name."</i> for <b>".todollar($price);
				if ($multiple > 1){
					echo "</b> each";
				}
				else {
					echo "</b>";
				}
				echo "</p>".
				"<a href=\"".$link."\">"."<img src=\"".$image."\" height=\"350px\">"."</a>";
				if (isset($comment) && strlen($comment)>0){
					echo "<p id=\"comment\">(".$comment.")</p>";
				}
				$leftover = $maxValue - $price * $multiple;
				if ($leftover > 0){
					echo "<p>and have <b>".todollar($leftover)."</b> leftover!!!!";
				}
			}
			else {
				echo "<p>Nothing.</p>";
			}
		
		?>
      </div>
    </div>


    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.1.min.js"><\/script>')</script>

        <script src="js/vendor/bootstrap.min.js"></script>

        <script src="js/main.js"></script>
    </body>
</html>
</!DOCTYPE>