<?php echo
'<div class="bottom-menu bottom-menu-inverse">
        <div class="container">
          <div class="row">
            <div class="col-md-2 col-sm-2">
              <a href="index.php" class="bottom-menu-brand">MovieDB</a>
            </div>
            <div class="col-md-8 col-sm-8">
              <ul class="bottom-menu-list">
                <li><a href="index.php">Top</a></li>
                <li><a href="new.php">New</a></li>
                <li><a href="genres.php">Genres</a></li>
              </ul>
            </div>
            <div class="col-md-2 col-sm-2">
              <ul class="bottom-menu-iconic-list">
                <li><a href="https://twitter.com/share" class="fui-twitter" data-hashtags="MovieDB"></a></li>
                <li><a href="javascript:fbshareCurrentPage()" target="_blank" class="fui-facebook"></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div> <!-- /bottom-menu-inverse -->';
echo '<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document, "script", "twitter-wjs");</script>
  <script>function fbshareCurrentPage(){window.open("https://www.facebook.com/sharer/sharer.php?u="+escape(window.location.href)+"&t="+document.title, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600");return false; }</script>
  <script src="js/vendor/jquery.min.js"></script>
  <script src="js/vendor/jquery-ui.min.js"></script>
  <script src="js/flat-ui-pro.min.js"></script>';
?>
