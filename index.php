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
			if(isset($_REQUEST["dollar"])){
				$money = $_REQUEST["dollar"];
				if($money != 0){
					echo "<h3>";
					echo "For ";
					echo "\$".sprintf("%0.2f", $money);
					echo " you can buy...";
					echo "</h3>";
				}
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