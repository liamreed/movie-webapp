<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/custom.min.css" rel="stylesheet">
  <?php 
  $filmID = htmlspecialchars($_GET['id']);
  ?>
</head>

<body>
  <div class="container">
    <div class="jumbotron">
      <div class="container">
        <?php
        include 'database.php';
        $pdo = Database::connect();
        $sql = "SELECT * FROM film WHERE FilmId ='".$filmID."'";
        foreach ($pdo->query($sql) as $row) {
          echo '<h2>'. $row['FilmName'] . '</h2>';
          echo '<h5>IMDB Rating - '. $row['Rating'] . '/10</h5>';
          echo '<img class="img-responsive img-cover" src="img/cover/'. $row['FilmId'] .'.jpg" alt="cover"></img>';
          echo '<p>'. $row['Description'] . '</p>';
          echo '<a class="btn btn-primary" href="http://www.imdb.com/title/tt'.$row['FilmId'].'">IMDB</a>';
        }   
        Database::disconnect();
        ?>
      </div>
    </div>
    <div class="row">
      <p>
        <a href="create.php" class="btn btn-success">Create</a>
      </p>
    </div>
  </div>
  <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>