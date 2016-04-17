<?php

#This code provided by:
#Yohanes Christomas Daimler(yohanes.christomas@gmail.com)
#Gunadarma University

if (isset($_SESSION['expire'])) {
  $sessiontime_now = time();
  if ($sessiontime_now > $_SESSION['expire']) {
    $utility->destroy_session();
    $flash  = array(
      'category' => "warning",
      'messages' => "Sesi Anda Telah Berakhir, Silahkan Login Kembali"
    );
    $utility->location("login", $flash);
  }
}

?>
