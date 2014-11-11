<?php
require_once('includes/config.php');
require_once('libraries/libraries.php');

$data = $db->get_col('news','id,title,category,category_no,date,text', 'id ="' . $_GET['id'] . '"');
$info = $data[0];

?>
<?php include('assets/templates/_head.php'); ?>
<!-- ####################################################################################################### -->
<div class="wrapper col2"> 
<?php include('assets/templates/_navi.php');?>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col4">
  <div id="container">
      
    <h1><?php echo $info['title']; ?></h1>
    <ul>
      <li>Category: <a href="main.php?cat=<?php echo $info['category_no']; ?>"><?php echo $info['category']; ?></a></li>
      <li>Date: <?php echo date("M d, Y h:i a", strtotime($info['date'])); ?></li>
    </ul>
    <p><?php echo $info['text']; ?></p>

  </div>
</div>
<!-- ####################################################################################################### -->
<?php include('assets/templates/_footer.php');?>