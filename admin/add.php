<?php
require_once('../includes/config.php');
require_once('../includes/logcheck.php');
require_once('../libraries/libraries.php');


$categories = $db->get_all_in('categories');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $uid = $db->_decrypt_string($_SESSION['userid']);

  $arr = array(
    'title' => $_POST['title'],
    'category' => $_POST['category_name'],
    'category_no' => $_POST['category_no'],
    'date' => $_POST['date'],
    'text' => $_POST['text'],
    'user_id' => $uid,
    'date_created' => $now->format('Y-m-d H:i:s'));

  foreach($arr as $key=> $val){
    if($val==''){
      $err[$key] = 'required';
    }
  }

  // check release date if valid format 
  if ($db->check_date_time($_POST['date'], 'add')) {

    if(count($err)==0){
      // add data into database
      $db->build_insert_all_query('news', $arr, 'sssssss');

      ob_start();
      exit(header('Location: news.php'));
      ob_end_flush();
    }
  
  } else {
    $err_date = '<span class="err frm-ul-spn" style="width: 43px;">Invalid Date</span>';
  }
} // END Post condition
?>
<?php include_once('../assets/admin_templates/top.php'); ?>
<?php include_once('../assets/admin_templates/header.php'); ?>

<div class="container">
<?php include_once('_addons-navi.php'); ?>
  <div class="form-container">
    <div class="form-name"> Add News </div>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="frm-main">
      <ul class="frm-ul">
          <li class="frm-li">
            <span class="frm-ul-spn">Title:</span>
            <div class="frm-ul-div">
              <input type="text" name="title" required value="<?php echo $_POST['title']; ?>" />
            </div>
            <span class="err frm-ul-spn"><?php echo $err['title']; ?></span>
            <br style="clear:both;" />
          </li>
          <li class="frm-li">
            <span class="frm-ul-spn">Category:</span>
            <div class="frm-ul-div">
              <select name="category_no" required id="catno" onchange="myFunction(this)">
                <option value="">-- Select Category --</option>
                <?php  foreach ($categories as $value) {
                  echo "<option value='".$value['id'] ."'>" . $value['category'] ."</option>";
                }?>
              </select>
            </div>

            <div class="frm-ul-div">
              <input type="text" name="category_name" id="catname" value="<?php echo $_POST['category_name']; ?>" style="display:none;" />
            </div>
            <span class="err frm-ul-spn"><?php echo $err['category_no']; ?></span>
            <br style="clear:both;" />
          </li>
          <li class="frm-li">
            <span class="frm-ul-spn">Release Date</span>
            <div class="frm-ul-div">
              <input type="text" name="date" required value='<?php echo ($_POST['date'])?$_POST['date']:$now->format('Y-m-d H:i:s'); ?>' />
              <?php echo ($err_date)?$err_date:'';?>
            </div>
            <label class="frm-sml-lbl">Format: Year-Month-Day Hr:min:sec(24 hr clock)</label> 
            <span class="err frm-ul-spn" style="width: 43px;"><?php echo $err['date']; ?></span>
            <br style="clear:both;" />
          </li>
          <li class="frm-li">
            <span class="frm-ul-spn">Text:</span>
            <div class="frm-ul-div">
              <textarea name="text" class="frm-ul-div"required placeholder="news description and details"><?php echo $_POST['text']; ?></textarea>
            </div>
            <span class="err frm-ul-spn"><?php echo $err['text']; ?></span>
            <br style="clear:both;" />
          </li>

          <li class="frm-li">
            <span class="frm-ul-spn">&nbsp;</span>
            <input type="submit" name="save" id="submit" value="Save" />
          </li>
        
      
      </ul>
    </form>
  </div>
</div><!-- end container -->
<?php include_once('../assets/admin_templates/footer.php'); ?>
