<?php
require_once('includes/config.php');
require_once('libraries/libraries.php');

$data = $db->get_col('news','id,title,category,category_no,date,text', 'category_no="' . $_GET['cat'] . '"');

?>
<?php include('assets/templates/_head.php'); ?>
<!-- ####################################################################################################### -->
<div class="wrapper col2"> 
<?php include('assets/templates/_navi.php');?>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col4">
  <div id="container">
    <?php foreach ($data as $value) { ?>
    <div class="category-bg">
      <h1><a href="news.php?id=<?php echo $value['id']; ?>"><?php echo $value['title']; ?></a></h1>
      <ul>
        <li>Category: <a href="main.php?cat=<?php echo $value['category_no']; ?>"><?php echo $value['category']; ?></a></li>
        <li>Date: <?php echo date("M d, Y h:i a", strtotime($value['date'])); ?></li>
      </ul>
      <p><?php echo $value['text']; ?></p>
    </div>
    <br/><br/>
    <?php } ?>
  </div>
</div>
<!-- ####################################################################################################### -->
<?php include('assets/templates/_footer.php');?>