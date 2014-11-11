<?php
require_once('../includes/config.php');
require_once('../includes/logcheck.php');
require_once('../libraries/libraries.php');

$news_return_url = $_SESSION['return_url'].'?action=deleted';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['id'])) {

$id = $db->_decrypt_string($_GET['id']);

  if ($id) {
    
    $del = $db->delete('news', 'id', $id);

    if($del){
      header("Location: $news_return_url");
      exit;
    }
  }
}
?>