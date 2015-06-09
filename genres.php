<?php
include_once 'includes/functions.php';
include_once 'includes/db_connect.php';
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
    <div class="row">
      <div class="col-lg-12">
        <?php
        if (isset($_GET['genre'])):
          $genre = htmlspecialchars($_GET['genre']);
          $pdo = Database::connect();
          $sql = "SELECT * FROM genre WHERE GenreName = '".$genre."'";
          foreach ($pdo->query($sql) as $row) {
            echo '<ul>';
            echo '<h3>'. $row['GenreName'] . '</h3>';
            echo '<p>' . $row['GenreDescription'] . '</p>';
            echo '</ul>';
          }
          Database::disconnect();
          echo '<h3>Films in this genre</h3>';
          $pdo = Database::connect();
          $sql = "SELECT * FROM genrefilm INNER JOIN film on genrefilm.FilmId=film.FilmId WHERE GenreName = '".$genre."' ORDER BY film.Rating DESC";
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
        else:
          echo '<h3>All Genres</h3>';
          $pdo = Database::connect();
          $sql = 'SELECT * FROM genre';
          foreach ($pdo->query($sql) as $row) {
            echo '<div class="col-lg-4"><ul>';
            echo '<p><a href="genres.php?genre='. $row['GenreName'] . '">'. $row['GenreName'] . '</a></p>';
            echo '</ul></div>';
          }
          Database::disconnect();
        endif;
        ?>
    </div>
    </div>
  </div>
</body>
<?php include_once 'includes/footer.php' ?>
