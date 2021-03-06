<?php
  error_reporting(E_ALL ^ (E_WARNING | E_STRICT));
  session_start();
  $TITLE             = "Sistem Evaluasi Kemenpora";
  $base_url          = "http://localhost/sipora/";
  $base_content      = "http://localhost/sipora/content/";
  $base_process      = "http://localhost/sipora/process/";
  $url_rewrite       = "http://localhost/sipora/";
  $url_img           = "http://localhost/sipora/";
  //================== PATH UPLOAD LOCAL linux LAMPP =================//
  // $path              = "/opt/lampp/htdocs/sipora/";
  // $path_upload       = "/opt/lampp/htdocs/sipora/static/uploads/";
  // ================== PATH UPLOAD LOCAL linux=================//
  $path              = "/var/www/html/sipora/";
  // $path_upload       = "/var/www/html/sipora/static/uploads/";
  //================== PATH UPLOAD LOCAL WINDOWS =================//
  // $path              = "C:/xampp/htdocs/sipora/";
  // $path_upload       = "C:/xampp/htdocs/sipora/static/uploads/";
  $path_upload    = "/Applications/XAMPP/xamppfiles/htdocs/sipora/static/uploads/";

  class config {
    public $db_host             = "localhost";
    public $db_user             = "root";
    public $db_pass             = "";
    public $database            = "evaluasi";
    public $url_rewrite_class   = "http://localhost/sipora/";
    public static $root         = 0;
    public static $session_time = 7200 /*2 hours*/;
    public function open_connection() {
      $this->link_db = mysqli_connect($this->db_host, $this->db_user, $this->db_pass,$this->database)
      or die("Koneksi Database gagal");
      return $this->link_db;
    }
    public function sql_details() {
      $this->sql_details = array(
        'user' => $this->db_user,
        'pass' => $this->db_pass,
        'db'   => $this->database,
        'host' => $this->db_host
      );
      return $this->sql_details;
    }
  }
?>
