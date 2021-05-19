<!DOCTYPE html>
<html>
  <head>
  <title>Phone number validator</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <link rel="shortcut icon" type="image/jpg" href="phone.jpeg"/>
  </head>
	<body>
    <?php 
    include("phonevalid.php");
    ?>
  <h3>Is this a phone number???</h3>
		<form method="post" action="">
  		<h4>Phone Number:</h4>
  		<br>
  		<input type="text" name="number" value="<?= $number;?>">
  		<br><br> 
  		<input type="submit" value="Submit">
		</form>
		<div id="form-output">
			<p id="response"><?= $message?></p>
    </div>
	</body>
</html>
    