<?php
require_once('includes/config.php');
require_once('libraries/libraries.php');

$business = $db->get_latest_news("business");
$health = $db->get_latest_news("health");
$sports = $db->get_latest_news("sports");
$weather = $db->get_latest_news("weather");

$news_side_col = array();
$news_side_col['celebrity'] = $db->get_latest_news("celebrity");
$news_side_col['games'] = $db->get_latest_news("games");
$news_side_col['movies'] = $db->get_latest_news("movies");
$news_side_col['music'] = $db->get_latest_news("music");
$news_side_col['food'] = $db->get_latest_news("food");
$news_side_col['travel'] = $db->get_latest_news("travel");

// Check the last array , it will use for li design
$news_last_array = end($news_side_col);

?>
<?php include('assets/templates/_head.php'); ?>
<!-- ####################################################################################################### -->
<div class="wrapper col2"> 
<?php include('assets/templates/_navi.php');?>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col4">
  <div id="container">
    <div id="content">
      <div id="featured_post"><img src="./assets/img/frontendimg/620x270.gif" alt="" />
        <p><a href='news.php?id=<?php echo $business['id']; ?>'><?php echo $business['title']; ?></a></p>
        <p><?php echo $db->limit_count_words($business['text']); ?>
        <span class="readmore"><a href='news.php?id=<?php echo $business['id']; ?>'>Continue Reading &raquo;</a></span>
        </p> 
      </div>
      <div id="hpage_latest">
        <ul>
          <li><img src="./assets/img/frontendimg/190x80.gif" alt="" />
            <p><a href='news.php?id=<?php echo $health['id']; ?>'><?php echo $health['title']; ?></a></p>
            <p><?php echo $db->limit_count_words($health['text']); ?></p>
            <p class="readmore"><a href='news.php?id=<?php echo $health['id']; ?>'>Continue Reading &raquo;</a></p>
          </li>
          <li><img src="./assets/img/frontendimg/190x80.gif" alt="" />
            <p><a href='news.php?id=<?php echo $sports['id']; ?>'><?php echo $sports['title']; ?></a></p>
            <p><?php echo $db->limit_count_words($sports['text']); ?></p>
            <p class="readmore"><a href='news.php?id=<?php echo $sports['id']; ?>'>Continue Reading &raquo;</a></p>
          </li>
          <li class="last"><img src="./assets/img/frontendimg/190x80.gif" alt="" />
            <p><a href='news.php?id=<?php echo $weather['id']; ?>'><?php echo $weather['title']; ?></a></p>
            <p><?php echo $db->limit_count_words($weather['text']); ?></p>
            <p class="readmore"><a href='news.php?id=<?php echo $weather['id']; ?>'>Continue Reading &raquo;</a></p>
          </li>
        </ul>
        <br class="clear" />
      </div>
    </div>
    <div id="column">
      <ul id="latestnews">
        <?php foreach ($news_side_col as $key => $value) :?>
        <?php 
          // ADD CLASS at LI
          if ($news_last_array['id'] == $value['id']) {
            echo '<li class="last">';
          } else {
            echo '<li>';
          }
        ?>
          <p><strong><a href='news.php?id=<?php echo $value['id']; ?>'><?php echo $value['title']; ?></a></strong>
          <?php echo $db->limit_count_words($value['text']); ?></p>
          <a href='news.php?id=<?php echo $value['id']; ?>'>&raquo; Readmore </a>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
    <br class="clear" />
  </div>
  <br class="clear" />
</div>

<!-- ####################################################################################################### -->
<?php include('assets/templates/_footer.php');?>