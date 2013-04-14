<?php
  session_start();
  require_once('../include/connect_db.php');
  if (isset($_POST['save'])) {
    $nr = 0;
    while (isset($_POST['q' . $nr])) {
      $_SESSION['planner__' . $_POST['cat'] . '__' . $_POST['q' . $nr]] = $_POST['an' . $nr] . '__' . $_POST['aa' . $nr];
      $nr++;
    }
    $_SESSION['planner_year'] = $_COOKIE['planner_year'];
    print_r($_SESSION);
  }
  else {
    header("Status: 404 Not Found");
  }
?>