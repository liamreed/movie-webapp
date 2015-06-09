<?php include_once 'includes/functions.php';
$filmID = htmlspecialchars($_GET['id']);
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

      <?php
        $pdo = Database::connect();
        $sql = "SELECT * FROM genrefilm WHERE FilmId ='".$filmID."'";
        foreach ($pdo->query($sql) as $row) {
          $genre = $row['GenreName'];
        }
          Database::disconnect();
        ?>

    <div class="container">
      <div class="row">
        <div class="row-same-height row-full-height">
        <div class="col-lg-12">
        <?php
          $pdo = Database::connect();
          $sql = "SELECT * FROM film WHERE FilmId ='".$filmID."'";
          foreach ($pdo->query($sql) as $row) {
            $padded = str_pad($row['FilmId'], 7, "0", STR_PAD_LEFT);
            echo '<header class="detailHeader">';
            echo '<div class="col-md-8">';
            echo '<h3>'. $row['FilmName'] . '</h3>';
            echo '<p>IMDB Rating • '. $row['Rating'] . '/10</p>';
            echo '<p>Genre • ' . $genre . '</p>';
            echo '<p>Release Date • '. $row['ReleaseDate'] . '</p>';
            echo '<p>Runtime • '. $row['RunTime'] . ' minutes</p>';
            echo '<p>Production Country • '. $row['Country'] . '</p>';
            echo '</div>';
            echo '<img class="img-responsive img-cover" src="img/cover/'. $padded .'.jpg" alt="cover" data-adaptive-background="1"></img>';
            echo '</header>';
            }
            Database::disconnect();
            ?>
         </div>
         </div>
         </div>
                
            <div class="row">
            <div class="col-md-2 col-md-height col-full-height">
            <div class="iconbar"><ul>
            <li data-toggle="modal" data-target="#seenModal"><a class="fui-eye"></a></li>
            <li data-toggle="modal" data-target="#twitterModal"><a class="fui-twitter"></a></li>
            <li data-toggle="modal" data-target="#starredModal"><a class="fui-star-2"></a></li>
            <li data-toggle="modal" data-target="#commentModal"><a class="fui-new"></a></li>
            </ul></div> <!-- /iconbar -->


    <div class="col-md-8 col-md-height col-full-height">
        <?php
        $pdo = Database::connect();
        $sql = "SELECT * FROM film WHERE FilmId ='".$filmID."'";
        foreach ($pdo->query($sql) as $row) {
          if ($row['Plot'] == "") {
            echo '<p>Plot not available for this title</p>';
          }
          $plot = strip_tags($row['Plot']);
          echo '<p>'. $plot . '</p>';
        }
          Database::disconnect();
        ?>

      </div>
      
      <div class="col-md-10">
        <?php
        $pdo = Database::connect();
        $sql = "SELECT * FROM genrefilm
				JOIN film on genrefilm.FilmId = film.FilmId
				WHERE genrefilm.GenreName ='".$genre."' AND film.FilmId <> '".$filmID."' 
				ORDER BY film.Rating DESC LIMIT 8";
        echo '<h6>Recommended films in ' . $genre . '</h6>';
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
	            <div class="panel-footer text-center">Rated: '. $row['Rating'] . '</div>
	          </div>
	        </div>';
        }
          Database::disconnect();
        ?>

      </div>

      <div class="col-md-8">
        <h4>Comments</h4>
        <?php
        $pdo = Database::connect();
        $sql = "SELECT * FROM customerfilm INNER JOIN customer on customerfilm.CustomerId = customer.CustomerId WHERE FilmId ='".$filmID."' AND Comments != ''";
        foreach ($pdo->query($sql) as $row) {
          if ($row['Comments'] == "") {
              echo '<p>No Comments</p>';
            }
          else {
            $comment = strip_tags($row['Comments']);
            echo '<blockquote><p>'. $comment . '</p><small><a href="profile.php?user=' . $row['CustomerId'] . '">' . $row['UserName'] . '</a></small></blockquote>';
            }
          }
          Database::disconnect();
        ?>
    </div>
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
</div>
<?php include_once 'includes/footer.php' ?>
<script src="js/jquery.adaptive-backgrounds.js"></script>
<script>
var myDate = new Date();
var curDate =(myDate.getMonth()+1) + '/' + myDate.getDate() + '/' +
        myDate.getFullYear();
$("#datepicker-01").datepicker('setDate', new Date());
$("#datepicker-01").val(curDate);
var datepickerSelector = $('#datepicker-01');
datepickerSelector.datepicker({
  showOtherMonths: true,
  selectOtherMonths: true,
  dateFormat: 'd MM, yy',
  yearRange: '-1:+1'
}).prev('.input-group-btn').on('click', function (e) {
  e && e.preventDefault();
  datepickerSelector.focus();
});
$.extend($.datepicker, { _checkOffset: function (inst,offset,isFixed) { return offset; } });

datepickerSelector.datepicker('widget').css({ 'margin-left': -datepickerSelector.prev('.input-group-btn').find('.btn').outerWidth() + 3 });
</script>
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
