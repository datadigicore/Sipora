<?php 

#This code provided by:
#Yohanes Christomas Daimler(yohanes.christomas@gmail.com)
#Gunadarma University

$utility->destroy_session();
$flash  = array(
  'category' => "info",
  'messages' => "Anda Telah Mengakhiri Sesi Ini"
);
$utility->location("login",$flash);

?>