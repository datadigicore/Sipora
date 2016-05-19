<?php
  if (!empty($_POST)) {
    $username = $purifier->purify($_POST['username']);
    $password = $purifier->purify($_POST['password']);
    $password = $utility->sha512($password);
    if ($_SESSION['username'] != '') {
      $utility->location("content/home");
    }
    else {
      $data  = array('username' => $username,
        'password' => $password
      );
      $result = $login->readUser($data);
      if ($result == true) {
        $_SESSION['id']         = $result->id;
        $_SESSION['nama']       = $result->nama;
        $_SESSION['username']   = $result->username;
        $_SESSION['email']      = $result->email;
        $_SESSION['level']      = $result->level;
        $_SESSION['direktorat'] = $result->direktorat;
        $_SESSION['kdgrup']     = $result->kdgrup;
        $_SESSION['expire']     = time() + config::$session_time;
        $utility->location("content/home");
      }
      else {
        $flash  = array(
          'category' => "error",
          'messages' => "Username dan Password Tidak Sesuai"
        );
        $utility->location("login", $flash);
      }
    }  
  }
  else {
    $utility->location(".");
  }
?>