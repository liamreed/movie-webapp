<?php
include_once 'functions.php';
include_once 'database.php';
sec_session_start();

if (login_check($pdo) != true) {
  header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/custom.min.css" rel="stylesheet">
  <link href="css/flat-ui.min.css" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Grand+Hotel' rel='stylesheet' type='text/css'>
</head>
<body>
  
  <?php include 'navigation.php'; ?>

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
          $padded = str_pad($row['FilmId'], 7, "0", STR_PAD_LEFT);
          echo '<div class="col-md-3 portfolio-item">
          <div class="panel panel-cover">
            <div class="panel-heading text-center">' . $row['FilmName'] . '</div>
            <div class="panel-body">
              <a href="detail.php?id=' . $padded . '">
                <img class="img-responsive img-cover" src="img/cover/'. $padded .'.jpg" alt="cover"></img>
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
