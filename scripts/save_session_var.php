<?php
  session_start();
  if (isset($_POST['save_var'])) {
    unset($_SESSION['sp_subcats']);
    $_SESSION['sp_subcats'] = $_POST['subcats'];
  }
?>