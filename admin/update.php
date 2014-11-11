<?php 
require_once('../includes/config.php');
require_once('../includes/logcheck.php');
require_once('../libraries/libraries.php');

$categories = $db->get_all_in('categories');
$news_return_url = $_SESSION['return_url'];

if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['id'])) {

  if ($db->_decrypt_string($_GET['id'])) {

    $data = $db->get_col('news','id,title,category,category_no,date,text', 'id ="' . $db->_decrypt_string($_GET['id']) . '"');
    $info = $data[0];

  } else {
    // Serves as checker for query string 
    $wrong_url = " <br><br/> <span class='err-msg'>Oops wrong url</span>";
  }

  $_SESSION['QUERY_STR'] = $_SERVER['QUERY_STRING'];

}
elseif($_SERVER['REQUEST_METHOD'] == 'GET') {
  echo "404 Mali ang URL mo"; exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $id = $db->_decrypt_string($_POST['id']);
  $uid = $db->_decrypt_string($_SESSION['userid']);
  
    $arr = array(
    'title'       => $_POST['title'],
    'category'    => $_POST['category_name'],
    'category_no' => $_POST['category_no'],
    'date'        => $_POST['date'],
    'text'        => $_POST['text'],
    'user_id'     => $uid,
    'date_modify' => $now->format('Y-m-d H:i:s'),
    'id'          => $id 
  );

  foreach($arr as $key=> $val){
    if($val==''){
      $err[$key] = 'required';
    }
  }
  
  // check release date if valid format 
  if ($db->check_date_time($_POST['date'])) {

    if(count($err)==0){
      // update information to database
      $db->build_update_all('news',$arr,'sssssssi');

      $_SESSION['QUERY_STR'] = " ";
      
      ob_start();
      exit(header("Location: $news_return_url"));
      ob_end_flush();
    }

  } else {
    $err_date = '<span class="err frm-ul-spn" style="width: 43px;">Invalid Date</span>';
  }
} // END Post condition
?>
<?php include_once('../assets/admin_templates/top.php'); ?>
<?php include_once('../assets/admin_templates/header.php'); ?>

<?php echo ($wrong_url)?$wrong_url:''; // output the checker for query string ?>

<div class="container">
<?php // serves as checker for Hidden id and hidden category ?>
<?php if (isset($err['id']) || isset($err['category']) ): ?>
<div class="flash">Something went wrong please <a href="user.php">Go back</a> and edit again</div>
<?php endif; ?>
<?php include_once('_addons-navi.php'); ?>
  <div class="form-container">
    <div style="padding:10px 0 0 35px;">Date Today : <?php echo $now->format('M-d-Y H:i:s'); ?></div>
    <div class="form-name">Update News</div>
    <form action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SESSION['QUERY_STR']; ?>" method="POST" class="frm-main">
      <ul class="frm-ul">
        <li class="frm-li">
          <span class="frm-ul-spn">Title</span>
          <div class="frm-ul-div">
            <input type="text" name="title" required value='<?php echo ($info['title'])?$info['title']:$_POST['title'];?>' />
          </div>
          <span class="err frm-ul-spn"><?php echo $err['title']; ?></span>
          <br style="clear:both;" />
        </li>
        <li class="frm-li">
          <span class="frm-ul-spn">Category</span>
          <div class="frm-ul-div">
            <select name="category_no" required  id="catno" onchange="myFunction(this)">
              <?php  foreach ($categories as $value) {
                if ($value['id'] == $info['category_no']) {
                  echo "<option value='".$value['id'] ."' selected>" . $value['category'] ."</option>";
                } else {
                  echo "<option value='".$value['id'] ."'>" . $value['category'] ."</option>";
                }
              }?>
            </select>
          </div>

          <div class="frm-ul-div">
            <input type="text" name="category_name" id="catname" value="<?php echo ($info['category'])?$info['category']:$_POST['category_name'];?>" style="display:none;"/>
          </div>
          <span class="err frm-ul-spn"><?php echo $err['category_no']; ?></span>
          <br style="clear:both;" />
        </li>
        <li class="frm-li">
          <span class="frm-ul-spn">Release Date</span>
          <div class="frm-ul-div">
            <input type="text" name="date" required value='<?php echo ($info['date'])?$info['date']:$_POST['date']; ?>' />
            <?php echo ($err_date)?$err_date:'';?>
          </div>
          <label class="frm-sml-lbl">Format: Year-Month-Day Hr:min:sec(24 hr clock)</label> 
          <span class="err frm-ul-spn"><?php echo $err['date']; ?></span>
          <br style="clear:both;" />
        </li>
        <li class="frm-li">
          <span class="frm-ul-spn">Text:</span>
          <div class="frm-ul-div">
            <textarea name="text" required ><?php echo ($info['text'])?$info['text']:$_POST['text']; ?></textarea>
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
          </div>
          <span class="err frm-ul-spn"><?php echo $err['text']; ?></span>
          <br style="clear:both;" />
        </li>
        <li class="frm-li">
          <span class="frm-ul-spn">&nbsp;</span>
          <input type="submit" name="save" id="submit" value="Save" style="display:inline;"/>
          &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $news_return_url; ?>">Return</a>
        </li>
      </ul>
    </form>
  </div>
</div> <!-- end container -->

<?php include_once('../assets/admin_templates/footer.php'); ?>