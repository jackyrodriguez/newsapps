<?php 
require_once('../includes/config.php');
require_once('../libraries/libraries.php');

if($_SESSION['username']){
  header('Location:index.php'); 
  exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

$response['errors'] = null;

$arr = array(
'email'       => $_POST['email'],
'password'    => $_POST['password'],
);

foreach($arr as $key=> $val){
  if($val==''){
    $err[$key] = 'required';
  }
}

if(count($err)==0) {

  $post_email = $db->_sanitize_string($_POST['email']);

  if ($db->_input_validator($post_email, "email")) {
  
    $user_details = $db->get_user_details($post_email);
    
    if (!empty($user_details)) {

      if ($db->_validate_password($_POST['password'] ,$user_details['user_password'])) {

        // LOGIN SUCCESS, create session
        $_SESSION['userid'] = $db->_encrypt_string($user_details['uid']);
        $_SESSION['username'] = $user_details['fname'] ." ". $user_details['lname'];

        ob_start();
        exit(header('Location: index.php'));
        ob_end_flush();
      } else {
        // Wrong password
        $response['errors'] = "password not match.";
      }

    } else {
      // user not exist
      $response['errors'] = "Invalid account";
    }

  } else {
    // Wrong email
    $response['errors'] = "Invalid Email.";
  }
}

} // end condition
?>
<?php /*
<?php include_once('../assets/admin_templates/top.php'); ?>
<div id="main-wrap">
<?php include_once('../assets/admin_templates/header.php'); ?>
<!-- main-wrap end -->
</div>  
<?php include_once('../assets/admin_templates/footer.php'); ?>
*/?>



<?php include_once('../assets/admin_templates/top.php'); ?>

<?php include_once('../assets/admin_templates/header.php'); ?>

<!-- container -->
<div class="container-login">
      
  <h2 class="login-title">Login</h2>

  <?php if (isset($response['errors'])): ?>
  <div class="flash"><?php echo $response['errors']; ?></div>
  <?php endif; ?>

  <form action="#" method="POST"  style="margin-top:30px;">
     
    <label>Email</label>
    <input type="text" name="email" id="email" value="">
    <br/>
    <span class="err"><?php echo $err['email']; ?></span>
               
    <label>Password </label>
    <input type="password" name="password" id="password" value="">
    <br/>
    <span class="err"><?php echo $err['password']; ?></span>
    <br/>

    <span class="btn-wrapr">
      <input type="submit" name="submit" id="submit" value="Login">
    </span>
  </form>

</div>
<!-- end container -->


<?php include_once('../assets/admin_templates/footer.php'); ?>