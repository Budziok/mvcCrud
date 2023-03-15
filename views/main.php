<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Forum</title>
</head>
<body>
<nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Ogłoszenia</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo ROOT_URL; ?>">Start</a></li>
            <li><a href="<?php echo ROOT_URL; ?>threads">Ogłoszenia</a></li>
          </ul>

          <ul>
           
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
        <?php Messages::displayMessage(); ?>
     	  <?php require($view); ?>
    </div>
</body>
</html>