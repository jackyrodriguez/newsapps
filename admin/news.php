<?php
require_once('../includes/config.php');
require_once('../includes/logcheck.php');
require_once('../libraries/libraries.php');
require_once('../libraries/pagination.sql.php');

$pg = new PaginationHelper(DB_USER, DB_PASSWD, DB_NAME, DB_HOST);

$data = $pg->paginate_data("news", '', 5);

$_SESSION['return_url'] = $_SERVER['REQUEST_URI'];

?>
<?php include_once('../assets/admin_templates/top.php'); ?>
<?php include_once('../assets/admin_templates/header.php'); ?>

<div class="container" style="width:1040px;">
<?php include_once('_addons-navi.php'); ?>
  <ul id="records">
    <li id="records-head">
      <span class="title">Title</span>
      <span class="category">Category</span>
      <span class="reldate">Released date</span>
      <span class="desc">Description</span>
      <span class="created">Created</span>
      <span class="modify">Modify</span>
      <span class="action">Action</span>            
    </li>
    <?php if($data['results']): ?>
    <!-- loop goes here -->
    <?php $i=0; ?>
    <?php foreach($data['results'] as $val): ?>
    <li <?php echo ($i%2==0)?'class="row0"':'class="row1"'; ?>>
      <span class="title" id="colbtitle"><?php echo $val['title']; ?></span>
      <span class="category"><?php echo $val['category']; ?></span>
      <span class="reldate"><?php echo date("M d, Y, h:i a", strtotime($val['date'])); ?></span>
      <span class="desc"><?php echo $val['text']; ?></span>
      <span class="created"><?php echo date("m/d/Y, h:i a", strtotime($val['date_created'])); ?></span>
      <span class="modify"><?php echo ($val['date_modify'])?date("m/d/Y, h:i a", strtotime($val['date_modify'])):'&nbsp'; ?></span>
      <span class="action">
          <a href="update.php?id=<?php echo $db->_encrypt_string($val['id']); ?>">Edit</a>&nbsp;|
          <a href="#" class="del" id="<?php echo $db->_encrypt_string($val['id']); ?>" onclick="deleteNews(this)">Delete</a>
      </span>
    </li>
    <?php $i++; ?>
    <?php endforeach; ?>
    <!-- end loop goes -->
    <?php endif; ?> 
  </ul>
<?php echo $data['num_page']; ?>
</div>
<br style="clear:both;" />
<script type="text/javascript">
  function deleteNews(sel) {
   ids = sel.getAttribute('id');
    if (window.confirm("Do you really want to delete ?")) {
        location.href="delete.php?id="+ids;
    }
  } 
</script>
<?php include_once('../assets/admin_templates/footer.php'); ?>
