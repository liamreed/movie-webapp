<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/custom.min.css" rel="stylesheet">
  <link href="css/ui.css" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Grand+Hotel' rel='stylesheet' type='text/css'>
  <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
  <script src="js/jquery.adaptive-backgrounds.js"></script>
  <script>
    var defaults = {
      normalizeTextColor:   true,
      normalizedTextColors:  {
        light:      "#fff",
        dark:       "#000"
      },
    };
    $(document).ready(function(){
      $.adaptiveBackground.run(defaults)
    });
  </script>
  <?php
  $filmID = htmlspecialchars($_GET['id']);
  ?>
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

<div class="container">
  <div class="jumbotron">
      <?php
      include 'database.php';
      $pdo = Database::connect();
      $sql = "SELECT * FROM film WHERE FilmId ='".$filmID."'";
      foreach ($pdo->query($sql) as $row) {
        $padded = str_pad($row['FilmId'], 7, "0", STR_PAD_LEFT);
        echo '<h2>'. $row['FilmName'] . '</h2>';
        echo '<h5>IMDB Rating • '. $row['Rating'] . '/10</h5>';
        echo '<img class="img-responsive img-cover" src="img/cover/'. $padded .'.jpg" alt="cover" data-adaptive-background="1"></img>';
        echo '<p>Release Date • '. $row['ReleaseDate'] . '</p>';
        echo '<p>Runtime • '. $row['RunTime'] . ' minutes</p>';
        echo '<a class="btn btn-primary" href="http://www.imdb.com/title/tt'.$row['FilmId'].'">IMDB</a>';
      }
        Database::disconnect();
      ?>
  </div>

  <div class="col-lg-12">
    <div class="row">
      <div class="col-md-4">
        <div class="well">
            <div class="sidebar-nav">
              <ul class="nav nav-list">
                <li><a href="index">Country</a></li>
                <li><a href="#">Rating</a></li>
                <li><a href="#">Twitter</a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="icon-star"></i>Add to starred</a></li>
                <li><a href="#"><i class="icon-share"></i>Share</a></li>
              </ul>
          </div>
        </div>
      </div>
    <div class="col-md-8">
      <div class="well">
        <?php
        include 'database.php';
        $pdo = Database::connect();
        $sql = "SELECT * FROM film WHERE FilmId ='".$filmID."'";
        foreach ($pdo->query($sql) as $row) {
          $plot = strip_tags($row['Plot']);
          echo '<p>'. $plot . '</p>';
        }
          Database::disconnect();
        ?>
      </div>
    </div>
  </div>
</div>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
