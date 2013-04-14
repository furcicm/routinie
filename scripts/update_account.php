<?php
  session_start();
  require_once('../include/connect_db.php');
  $uid = $_SESSION['uid'];
  if (isset($_POST['update']) && $_POST['update'] == 1) {
    $full_name = $_POST['fullName'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $gender = $_POST['gender'];
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $query = mysql_query("UPDATE `wesrom_routinie`.`users` 
                          SET `full_name`='$full_name', `country`='$country', `city`='$city', `gender`='$gender', `birthday_day`='$day', `birthday_month`='$month', `birthday_year`='$year'
                          WHERE `uid`='$uid'");
    if ($query) {
      if (mysql_affected_rows()) {
        // Successful.
        echo '1';
      }
      else {
        // Nothing to update.
        echo '2';
      }
    }
    else {
      // Error
      echo '3';
    }
                               
  }
  elseif (isset($_POST['update_password']) && $_POST['update_password'] == 1) {
    if ($_POST['new_password'] == $_POST['current_password']) {
      echo '3';
      die;
    }
    $new_pass = ($_POST['new_password'] . SALT);
    $new_pass = hash('sha256', $new_pass);
    if ($_POST['no_pass'] != 1) { 
      $curr_pass = $_POST['current_password'];
      $curr_pass = $curr_pass . SALT;
      $curr_pass = hash('sha256', $curr_pass);
      $query = mysql_query("SELECT pass FROM users WHERE `uid`='$uid'");
      $result = mysql_fetch_array($query);
      $pass_from_db = $result['pass'];
      if ($pass_from_db != $curr_pass) {
        echo '4';
        die;
      }
    }
    
    $query = mysql_query("UPDATE `wesrom_routinie`.`users` 
                          SET `pass`='$new_pass'
                          WHERE `uid`='$uid'");
    if (mysql_affected_rows()) {
      echo '1';
    }
    else {
      echo '2';
    }
  }
  else {
    header("Status: 404 Not Found");
  }
?>