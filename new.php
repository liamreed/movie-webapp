<?php 
include_once 'includes/functions.php';
include_once 'includes/db_connect.php';
sec_session_start ();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link href="css/vendor/bootstrap.min.css" rel="stylesheet">
  <link href="css/flat-ui-pro.min.css" rel="stylesheet">
  <link href="css/custom.min.css" rel="stylesheet">
</head>
<body>

  <?php include_once 'includes/navigation.php' ?>

  <div class="container">
  <h3>New Additions</h3>
    <div class="row">
      <div class="col-lg-12">
        <?php
        $pdo = Database::connect();
        $sql = 'SELECT * FROM film ORDER BY ReleaseDate DESC LIMIT 100';
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
<?php include_once 'includes/footer.php' ?>
</body>
<footer>
</footer>
