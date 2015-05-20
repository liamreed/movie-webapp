<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/custom.min.css" rel="stylesheet">
  <link href="css/flat-ui-pro.min.css" rel="stylesheet">
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

<?php include 'navigation.php' ?>

    <div class="container">
      <div class="row">
        <div class="col-lg-12">
      <?php
      include 'database.php';
      $pdo = Database::connect();
      $sql = "SELECT * FROM film WHERE FilmId ='".$filmID."'";
      foreach ($pdo->query($sql) as $row) {
        $padded = str_pad($row['FilmId'], 7, "0", STR_PAD_LEFT);
        echo '<header>
                <div class="container">
                  <div class="row rounded">
                    <div class="col-lg-12">';
        echo '<div class="col-md-8">';
        echo '<h2>'. $row['FilmName'] . '</h2>';
        echo '<p>IMDB Rating • '. $row['Rating'] . '/10</p>';
        echo '<p>Release Date • '. $row['ReleaseDate'] . '</p>';
        echo '<p>Runtime • '. $row['RunTime'] . ' minutes</p>';
        echo '<a class="btn btn-primary" href="http://www.imdb.com/title/tt'.$row['FilmId'].'">IMDB</a>';
        echo '</div>';
        echo '<img class="img-responsive img-cover" src="img/cover/'. $padded .'.jpg" alt="cover" data-adaptive-background="1"></img>';
        echo '</div></div></div></header>';
        echo '<div class="row">';
        echo '<div class="col-md-4">';
        echo '<div class="well">';
        echo '<div class="sidebar-nav">';
        echo '<ul class="nav nav-list">';
        echo '<li>Country • '. $row['Country'] . '</li>';
        echo '<li>Add to Watched</li>';
        echo '<li>Twitter</li>';
        echo '<li>Add to starred</li>';
        echo '<li>Share</li>';
              }
        Database::disconnect();
      ?>
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
