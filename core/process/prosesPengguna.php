<?php
include 'config/application.php';

$sess_id      = $_SESSION['user_id'];
$id           = $_SESSION['id'];
$id_data      = $purifier->purify($_POST[id]);
$kode         = $purifier->purify($_POST[kode]);
$name         = $purifier->purify($_POST[name]);
$username     = $purifier->purify($_POST[username]);
$password     = $utility->sha512($_POST[password]);
$newpassword  = $utility->sha512($_POST[newpass]);
$newpassword2 = $utility->sha512($_POST[newpass2]);
$email        = $purifier->purify($_POST[email]);
$level        = $purifier->purify($_POST[level]);
$kdprogram    = $purifier->purifyArray($_POST[kdprogram]);
$direktorat   = $purifier->purifyArray($_POST[direktorat]);
$grup   = $purifier->purifyArray($_POST[grup]);
$kdoutput     = $purifier->purifyArray($_POST[kdoutput]);
$status       = $purifier->purify($_POST[status]);

$strKdoutput = "";
$strKdprogram = "";
$strDirektorat = "";
// print_r($kdprogram);exit;
foreach ($kdoutput as $value) {
  if($strKdoutput==""){
    $strKdoutput = $value;
  } else {
    $strKdoutput = $strKdoutput.",".$value;
  }
}
foreach ($kdprogram as $value) {
  if($strKdprogram==""){
    $strKdprogram = $value;
  } else {
    $strKdprogram = $strKdprogram.",".$value;
  }
}
foreach ($direktorat as $value) {
  if($strDirektorat==""){
    $strDirektorat = $value;
  } else {
    $strDirektorat = $strDirektorat.",".$value;
  }
}

$data_pengguna = array(
  "id"           => $id,
  "id_data"      => $id_data,
  "kode"         => $kode,
  "name"         => $name,
  "username"     => $username,
  "password"     => $password,
  "newpassword"  => $newpassword,
  "newpassword2" => $newpassword2,
  "email"        => $email,
  "level"        => $level,
  "kdprogram"    => $strKdprogram,
  "direktorat"   => $strDirektorat,
  "grup"   => $grup,
  "kdoutput"     => $strKdoutput,
  "status"       => $status
);

switch ($link[3]) {

  case 'table':
    $tableKey = "pengguna";
    $Key   = "id";
    $columns=array(
      'id',
      'nama',
      'status',
      'username',
      'email',
      'level',
      'direktorat',
      'level',
      'status'
      );
    $formatter=array(
      '2' => array('formatter' => function($d,$row,$data){ 
        if($d==1){
          return '<button id="aktif" class="btn btn-flat btn-success btn-xs"><i class="fa fa-check-circle"></i> Aktif</button>';
        }
        else{
          return '<button id="nonaktif" class="btn btn-flat btn-danger btn-xs"><i class="fa fa-warning"></i> Belum Aktif</button>';
        }
      }),
      '5' => array('formatter' => function($d,$row,$data){ 
        if($d==1){
          return 'Operator';
        }
        else if ($d==2){
          return 'Operator';
        }
        else if ($d==3){
          return 'Asisten Operator';
        }
      })

      );
    // $column = array(
    //   array( 'db' => 'id',      'dt' => 0 ),
    //   array( 'db' => 'nama',  'dt' => 1 ),
    //   array( 'db' => 'status',  'dt' => 2, 'formatter' => function($d,$row){ 
    //     if($d==1){
    //       return '<button id="aktif" class="btn btn-flat btn-success btn-xs"><i class="fa fa-check-circle"></i> Aktif</button>';
    //     }
    //     else{
    //       return '<button id="nonaktif" class="btn btn-flat btn-danger btn-xs"><i class="fa fa-warning"></i> Belum Aktif</button>';
    //     }
    //   }),
    //   array( 'db' => 'username',  'dt' => 3 ),
    //   array( 'db' => 'email',   'dt' => 4 ),
    //   array( 'db' => 'level', 'dt' => 5, 'formatter' => function($d,$row){ 
    //     if($d==1){
    //       return 'Operator Bendahara Pengeluaran';
    //     }
    //     else if ($d==2){
    //       return 'Bendahara Pengeluaran Pembantu';
    //     }
    //     else if ($d==3){
    //       return 'Operator BPP';
    //     }
    //   }),
    //   array( 'db' => 'direktorat',   'dt' => 6 ),
    //   array( 'db' => 'level',   'dt' => 7 ),
    //   array( 'db' => 'status',  'dt' => 8 )
    // );
    $swhere = "WHERE level != 0";
    $query      =  "SELECT SQL_CALC_FOUND_ROWS ".implode(", ", $columns)."
                    FROM pengguna
                    ".$swhere;
    // $datatable->get_table($table, $key, $column, $where);
    $datatable->get_table($tableKey, $Key, $columns, $query, $formatter);
  break;
  case 'table-group':
    $table = "grup";
    $key   = "id";
    // $column = array(
    //   array( 'db' => 'id',      'dt' => 0 ),
    //   array( 'db' => 'kode',  'dt' => 1 ),
    //   array( 'db' => 'nama',  'dt' => 2),
    //   array( 'db' => 'kdoutput',  'dt' => 3 )
    // );
    $columns=array(
      'id',
      'kode',
      'nama',
      'kdoutput',
      );
    $where = "WHERE status = 1";
    $query      =  "SELECT SQL_CALC_FOUND_ROWS ".implode(", ", $columns)."
                    FROM grup
                    ".$where;
    // echo $query;exit;
    $datatable->get_table($table, $key, $columns, $query);
  break;
  case 'activate':
    $id = $_POST['key'];
    $pengguna->activatePengguna($id);
  break;
  case 'deactivate':
    $id = $_POST['key'];
    $pengguna->deactivatePengguna($id);
  break;
  case 'add':
    $pengguna->insertPengguna($data_pengguna);
    $flash  = array(
      'category' => "success",
      'messages' => "Data pengguna berhasil ditambahkan"
    );
    $utility->location("content/addpengguna", $flash);
  break;
  case 'add-group':
    
    // $strKdoutput = "";
    // foreach ($kdoutput as $value) {
    //   if($strKdoutput==""){
    //     $strKdoutput = $value;
    //   } else {
    //     $strKdoutput = $strKdoutput.",".$value;
    //   }
    // }
    // echo $strKdoutput;
    $flash  = array(
      'category' => "success",
      'messages' => "Data pengguna berhasil ditambahkan"
    );
    $pengguna->insertGroup($data_pengguna);
    $utility->location("content/addgroup",$flash);
  case 'edt':
    $pengguna->updatePengguna($data_pengguna);
    $utility->location_goto("content/setting");
  break;
  case 'edt-pass':
    if($newpassword2==$newpassword){
      $current_pass = $pengguna->getPass($data_pengguna);
      
      if($current_pass==$password){
        $pengguna->updatePass($data_pengguna);
        $flash  = array(
          'category' => "success",
          'messages' => "Password berhasil diubah"
        );
        $utility->location("content/edit_pass", $flash);
      } else {
        $flash  = array(
          'category' => "warning",
          'messages' => "Password gagal diubah, password lama tidak sesuai"
        );
        $utility->location("content/edit_pass", $flash);
      }
      
    } else {
      $flash  = array(
        'category' => "warning",
        'messages' => "Password Gagal Diubah, Password baru tidak sama"
      );
      $utility->location("content/edit_pass", $flash);
    }
  break;
  case 'edt2':
    $pengguna->updatePengguna2($data_pengguna);
    $utility->location("content/edit_profile","success","Data berhasil diubah");
  break;
  case 'edit':
    if (!empty($_POST['password'])) {
      $_POST['password'] = $utility->sha512($_POST['password']);
    }
    $pengguna->editPengguna($purifier->purifyArray($_POST));
    $flash  = array(
      'category' => "success",
      'messages' => "Data Pengguna berhasil diperbaharui"
    );
    $utility->location("content/pengguna", $flash);
  break;
  case 'edit-group':
    $pengguna->editGrup($data_pengguna);
    $flash  = array(
      'category' => "success",
      'messages' => "Data Pengguna berhasil diperbaharui"
    );
    // $utility->load("content/user",$flash);
    $utility->location("content/pengguna", $flash);
  break;
  case 'delete':
    $id = $_POST['id'];
    $pengguna->deletePengguna($id);
    $flash  = array(
      'category' => "success",
      'messages' => "Data Pengguna berhasil dihapus"
    );
    $utility->location("content/pengguna", $flash);
  break;
  case 'deletegroup':
    $id = $_POST['id'];
    $pengguna->deleteGroup($id);
    $flash  = array(
      'category' => "success",
      'messages' => "Data Group berhasil dihapus"
    );
    $utility->location("content/pengguna", $flash);
  break;
  case 'kuitansi':
    $report->kuitansi($data_pengguna);
  break;
  default:
    $utility->location_goto(".");
  break;
}
?>
