<?php
include_once 'includes/functions.php';
include_once 'includes/db_connect.php';
sec_session_start();

$userID = null;

$userID = htmlspecialchars($_SESSION['user_id']);

if (login_check($pdo) != true) {
	header('Location: login.php');
}
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
  
  <?php include_once 'includes/navigation.php'; 

  if (isset ( $_GET ['error'] )) {
  echo '<p class="error">Error with login</p>';
  } ?>

  <div class="container">
    <div class="row">
	  <div class="col-lg-12">
	        <?php
	        $pdo = Database::connect();
	        $sql = "SELECT * FROM customerfilm
					JOIN film on customerfilm.FilmId = film.FilmId WHERE CustomerId ='".$userID."' 
					ORDER BY customerfilm.seen";
	        echo "<h4>Recently Seen Films</h4>";
	        foreach ($pdo->query($sql) as $row) {
	          $padded = str_pad($row['FilmId'], 7, "0", STR_PAD_LEFT);
	          echo '<div class="col-md-3 portfolio-item">
	          <div class="panel panel-cover">
	            <div class="panel-heading text-center">' . $row['FilmName'] . '</div>
	            <div class="panel-body">
	              <a href="detail.php?id=' . $row['FilmId'] . '">
	                <img class="img-responsive img-cover" src="img/cover/'. $padded .'.jpg" alt="cover"></img>
	              </a>
	            </div>
	            <div class="panel-footer text-center">Rated: '. $row['CustomerRating'] . '</div>
	          </div>
	        </div>';
	        }
	          Database::disconnect();
	        ?>
	    </div>
	   </div>
	  </div>

  <div class="full-width-bar">
    <div class="container">
      <p>Top 50 Rated</p>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <?php
        $pdo = Database::connect();
        $sql = 'SELECT * FROM film ORDER BY Rating DESC LIMIT 50';
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
<?php include_once 'includes/footer.php'?>
</body>
