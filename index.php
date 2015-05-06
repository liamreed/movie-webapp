<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/custom.min.css" rel="stylesheet">
  <link href="css/ui.css" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Grand+Hotel' rel='stylesheet' type='text/css'>
</head>
<body>
  <nav class="navbar navbar-ct-blue navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">MovieDB</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="index.php">Home</a></li>
          <li><a href="new.php">New</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Account <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Profile</a></li>
              <li><a href="#">Settings</a></li>
              <li class="divider"></li>
              <li><a href="#">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <header class="top-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="tagline">Interstellar</h1>
        </div>
      </div>
    </div>
  </header>

  <div class="full-width-bar">
    <div class="container">
      <p>Top 100 Rated</p>  
    </div>
  </div>
  <div class="container"> 
    <div class="row">
      <div class="col-lg-12">
        <?php
        include 'database.php';
        $pdo = Database::connect();
        $sql = 'SELECT * FROM film ORDER BY Rating DESC LIMIT 100';
        foreach ($pdo->query($sql) as $row) {
          echo '<div class="col-md-3 portfolio-item">
          <div class="panel panel-cover">
            <div class="panel-heading text-center">' . $row['FilmName'] . '</div>
            <div class="panel-body">
              <a href="detail.php?id=' . $row['FilmId'] . '">
                <img class="img-responsive img-cover" src="img/cover/'. $row['FilmId'] .'.jpg" alt="cover"></img>
              </a>
            </div>
            <div class="panel-footer text-center">IMDB rating: '. $row['Rating'] . '</div>
          </div>
        </div>';
      }
      Database::disconnect();
      ?>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
<footer>
</footer>