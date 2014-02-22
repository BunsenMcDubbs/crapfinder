<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
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
          <a class="navbar-brand" href="#"><b>Team mmmYEP</b> presents</a>
        </div>
      </div>
    </div>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Find crap!</h1>
        
		<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
		How much money you want to blow: <input type="number" name="dollar" required="true" min="0" step="any">
		<input type="submit">
		</form>

      </div>
      
      <div class="container">
   	    <?php
   	    
   	    	function todollar($num){
   	    		return "\$".sprintf("%0.2f", $num);
   	    	}
   	    
			if(!isset($_REQUEST["dollar"])){
				return;
			}
			$maxValue = $_REQUEST["dollar"];
			if($maxValue != 0){
				echo "<h3>";
				echo "For ";
				echo toDollar($maxValue);
				echo " you can buy...";
				echo "</h3>";
			}
	
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
			
			// var_dump($mostExpensiveItem);
			
			echo "<p>".$mostExpensiveItem[0]." for $".$mostExpensiveItem[3]."</p>";
			echo "<a href=\"".$mostExpensiveItem[2]."\">";
			echo "<img src=\"".$mostExpensiveItem[1]."\" height=\"350px\">";
			echo "</a>";
		
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