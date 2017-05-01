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
      <form class="form-signin" action="upload.php" method="post" enctype="multipart/form-data">
        <h2 class="form-signin-heading">Upload Audio</h2>
        <input type="file" name="audio_file" id="audio_file" class="form-control" placeholder="Choose File" required>
        <br>
        <button class="btn btn-lg btn-primary btn-block" name="upload" type="submit">Upload</button>
      </form>
    </div> <!-- /container -->
  </body>
</html>
