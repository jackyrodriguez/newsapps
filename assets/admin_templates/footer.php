<?php 
// for js checker .. Temp procedural style
function js_page_checker() {
  if (strpos($_SERVER['SCRIPT_NAME'],'add.php') !== false) {
      $strstart = -7;
  } elseif (strpos($_SERVER['SCRIPT_NAME'],'update.php') !== false) {
      $strstart = -10;
  }

  $strlength = strlen($_SERVER['SCRIPT_NAME']);
  $page = substr($_SERVER['SCRIPT_NAME'], $strstart, $strlength);

  if ($page === "add.php" || $page === "update.php") {
    echo '<script language="javascript" type="text/javascript" src="../assets/js/adminscript.js"></script>';
  }
}

// Load js for specific page
js_page_checker();
?>
  <!-- footer-wrap -->
<div id="footer-wrap">
</div>
</body>
</html>