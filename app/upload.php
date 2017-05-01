<?php
require __DIR__ . '/../vendor/autoload.php';


if (isset($_POST["upload"])) {
    $file = $_FILES["audio_file"];
	$upload = new Rorikurn\GoogleSpeechClient\Upload($file);
	if ($upload->process($file)) {
		$messages = $upload->generateResult();
	} else {
		$messages = 'Sorry, upload failed';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Google Speech Client</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/app.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">
    	<div class="row">
	      	<?php if (count($messages)) { ?>
	      		<h2>Result</h2>
		      	<?php foreach ($messages as $message) { ?>
		      		<div class="col-md-12" style="border:1px solid #ddd">
		      			<p><?php echo $message; ?></p>
		      		</div>
		      		<br>
		      	<?php } ?>
	      	<?php } else { ?>
	      		<h2>Whoops, Something wrong.</h2>
	      		<div class="col-md-12">
		      		<p><?php echo $message; ?></p>
		      	</div>
	      	<?php } ?>

      		<div class="col-md-12 text-center">
		      	<a href="index.php" class="btn btn-lg btn-primary">Upload Audio</a>
		    </div>
      	</div>
    </div> <!-- /container -->
  </body>
</html>
