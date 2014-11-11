<?php 
require_once('../includes/config.php');
//require_once('../includes/logcheck.php');
require_once('../libraries/libraries.php');

?>
<?php include_once('../assets/admin_templates/top.php'); ?>
<?php include_once('../assets/admin_templates/header.php'); ?>
<div class="container">
  <div class="jumbo">
  <?php if($_SESSION['username']):?>
    <h2> WELCOME <?php echo $_SESSION['username']; ?></h2>
    <br/>
    <p><a href="news.php">View News</a></p>
  <?php else: ?>
    <h3>Please Login</h3>
  <?php endif; ?>
  </div>
</div><!-- end container -->
<?php include_once('../assets/admin_templates/footer.php'); ?>