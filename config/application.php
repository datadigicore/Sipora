<?php
// error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
date_default_timezone_set('Asia/Jakarta');
// ======== TAMBAHKAN UTILITY & LIBRARY DISINI ========
require_once __DIR__ .'/config.php';
require_once __DIR__ .'/../utility/database/mysql_db.php';
require_once __DIR__ .'/../utility/utilityCode.php';
require_once __DIR__ .'/../utility/PHPExcel/IOFactory.php';
require_once __DIR__ .'/../utility/ExcelReader.php';
require_once __DIR__ .'/../utility/dataTable.php';
require_once __DIR__ .'/../library/mPDF/mpdf.php';
require_once __DIR__ .'/../library/security/HTMLPurifier.auto.php';
// =========== TAMBAHKAN FILE MODEL DISINI ============
require_once __DIR__ .'/../model/modelLogin.php';
require_once __DIR__ .'/../model/modelHome.php';
require_once __DIR__ .'/../model/modelRkakl.php';
require_once __DIR__ .'/../model/modelRab.php';
require_once __DIR__ .'/../model/modelPengguna.php';
require_once __DIR__ .'/../model/modelReport.php';
// require_once __DIR__ .'/../model/modelProfile.php';
// require_once __DIR__ .'/../model/modelAnggaran.php';
// require_once __DIR__ .'/../model/modelEvaluasi.php';
// ====================================================

// ============== TAMBAHKAN CLASS DISINI ==============
$config    = new config();
$db        = new mysql_db();
$utility   = new utilityCode();
$datatable = new datatable();
//=========== TAMBAHKAN CLASS MODEL DISINI ===========
$login    = new modelLogin(); 
$home     = new modelHome();
$rkakl    = new modelRkakl();
$rab      = new modelRab();
$pengguna = new modelPengguna();
$report   = new modelReport();
// $profile  = new modelProfile();
// $anggaran = new modelAnggaran();
// $evaluasi = new modelEvaluasi();
// ====================================================

// ====== TAMBAHKAN CLASS & CONFIG KHUSUS DISINI ======
$config_security = HTMLPurifier_Config::createDefault();
$config_security ->set('URI.HostBlacklist', array('google.com'));
$purifier        = new HTMLPurifier($config_security);
// ====================================================

// ================ CEK SESSION EXPIRE ================
require_once __DIR__ .'/sessionExpire.php';
// ====================================================
?>