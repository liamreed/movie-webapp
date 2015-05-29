<?php include_once 'includes/functions.php';

$userID = null;

if (empty($_GET)) {
	echo 'Error retrieving profile information';
}
else {
		if($_GET['user']){
			$userID = htmlspecialchars($_GET['user']);
		}
		else {
			$userID = htmlspecialchars($_['user_id']);
		}
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

<?php include_once 'includes/navigation.php' ?>

    <div class="container">
      <div class="row">
        <div class="col-lg-12">
        <?php
          $pdo = Database::connect();
          $sql = "SELECT * FROM customer WHERE CustomerId ='".$userID."'";
          foreach ($pdo->query($sql) as $row) {
            echo '<header class="detailHeader">';
            echo '<div class="col-md-8">';
            echo '<h3>'. $row['UserName'] . '</h3>';
            echo '<p>Real Name • '. $row['Name'] . '</p>';
            echo '<p>User ID • '. $row['CustomerId'] . '</p>';
            echo '<p>Email • '. $row['Email'] . '</p>';
            echo '</div>';
            echo '</header>';
            }
              Database::disconnect();
        ?>
          </div>
        </div>

    <div class="col-lg-12">
        <?php
        $pdo = Database::connect();
        $sql = "SELECT * FROM customerfilm INNER JOIN film on customerfilm.FilmId = film.FilmId WHERE Starred = 'yes' AND CustomerId ='".$userID."'";
        echo "<h4>Starred Films</h4>";
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

    <div class="col-lg-12">
        <?php
        $pdo = Database::connect();
        $sql = "SELECT * FROM customerfilm INNER JOIN film on customerfilm.FilmId = film.FilmId WHERE CustomerId ='".$userID."'";
        echo "<h4>Seen Films</h4>";
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

<!-- Seen List Modal -->
<div class="modal fade" id="seenModal" tabindex="-1" role="dialog" aria-labelledby="seenModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-center">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="seenModalLabel">Add to Seen List?</h4>
      </div>
      <div class="modal-body">
        <p>Select a seen date</p>
        <div class="form-group">
		  <div class="input-group">
		    <span class="input-group-btn">
		      <button class="btn" type="button"><span class="fui-calendar"></span></button>
		    </span>
		    <input type="text" class="form-control" value="1 Jan, 2013" id="datepicker-01" />
		  </div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>
</div>

<!-- Starred Modal -->
<div class="modal fade" id="starredModal" tabindex="-1" role="dialog" aria-labelledby="starredModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-center">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="starredModalLabel">Add to Starred?</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you wish to star this title?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Star</button>
      </div>
    </div>
  </div>
</div>

<!-- Comment Modal -->
<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-center">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="commentModalLabel">Write a comment</h4>
      </div>
      <div class="modal-body">
        <textarea rows="3" placeholder="Add comment..." class="form-control"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Post</button>
      </div>
    </div>
  </div>
</div>

  </div>
<?php include_once 'includes/footer.php' ?>
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
</body>
</html>
