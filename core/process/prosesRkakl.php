<?php
switch ($link[3]) {
  case 'import':
    ini_set('memory_limit', '-1');
    $thang    = $purifier->purify($_POST['thang']);
    $revisi   = $purifier->purify($_POST['revisi']);
    $tanggal  = $purifier->purify($_POST['tanggal']);
    $pecahtgl = explode("/", $tanggal);
    $tanggal  = $pecahtgl[2].'-'.$pecahtgl[1].'-'.$pecahtgl[0];
    $no_dipa  = $purifier->purify($_POST['no_dipa']);
    $result   = $rkakl->checkThang($thang);
    if ($result->num_rows == 0 || $revisi == 'true') {
      if(isset($_POST) && !empty($_FILES['fileimport']['name'])) {
        $path = $_FILES['fileimport']['name'];
        $ext  = pathinfo($path, PATHINFO_EXTENSION);
        if($ext != 'xls' && $ext != 'xlsx' && $ext != 'XLS' && $ext != 'XLSX') {
          $utility->load("content/rkakl","error","Jenis file RKAKL yang di upload tidak sesuai");
        }
        else {
          $time        = time();
          $target_dir  = $path_upload;
          $target_name = basename(date("Ymd-His-\R\K\A\K\L.",$time).$ext);
          $target_file = $target_dir . $target_name;
          $response    = move_uploaded_file($_FILES['fileimport']['tmp_name'],$target_file);
          if($response) {
            try {
              $objPHPExcel = PHPExcel_IOFactory::load($target_file);
            }
            catch(Exception $e) {
              die('Kesalahan! Gagal dalam mengupload file : "'.pathinfo($_FILES['excelupload']['name'],PATHINFO_BASENAME).'": '.$e->getMessage());
            }
            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(NULL,TRUE,FALSE,TRUE);
            $data_insert = array(
              "tanggal"    => $tanggal,
              "no_dipa"    => $no_dipa,
              "filename"   => $path,
              "filesave"   => $target_name,
              "keterangan" => $purifier->purify($_POST['keterangan']),
              "tahun"      => $purifier->purify($_POST['thang'])
            );
            if ($thang == date("Y")+1) {
              $data_insert["status"] = 2;
            }
            else {
              $data_insert["status"] = 1;
            }
            if (isset($_POST['pesan'])) {
              $data_insert['pesan'] = $_POST['pesan'];
            }
            if ($allDataInSheet[1]['A'] != NULL && $allDataInSheet[1]['G'] != NULL) {
              $rkakl->insertRkakl($data_insert);
              $result = $rkakl->importRkakl($allDataInSheet, $data_insert["tahun"]);
              if ($result) {
                $flash  = array(
                  'category' => "success",
                  'messages' => "Data Anggaran berhasil di import ke dalam database"
                );
                $utility->location("content/rkakl", $flash);
              }
              else {
                $flash  = array(
                  'category' => "error",
                  'messages' => "Maaf jumlah anggaran kurang dari realisasi yang ada harap diperiksa kembali"
                );
                $utility->location("content/rkakl", $flash);
              }
            }
            else {
              $flash  = array(
                'category' => "error",
                'messages' => "Maaf file excel yang anda lampirkan format datanya tidak sesuai"
              );
              $utility->location("content/rkakl", $flash);
            }
          }
        }
      }
      else {
        $flash  = array(
          'category' => "warning",
          'messages' => "Belum ada file excel yang di lampirkan"
        );
        $utility->location("content/rkakl", $flash);
      }
    }
    else {
      $flash  = array(
        'category' => "warning",
        'messages' => "Maaf data tahun anggaran ".$thang." sudah ada, jika ingin melakukan perubahan harap revisi"
      );
      $utility->location("content/rkakl", $flash);
    }
  break;
  case 'table':
    $table      = "rkakl_view";
    $primaryKey = "id";
    $columns    = array(
      array( 'db' => 'id',      'dt' => 0 ),
      array( 'db' => 'tahun',   'dt' => 1 ),
      array( 'db' => 'tanggal',  'dt' => 2, 'formatter' => function( $d, $row ) {
            return date( 'j-M-Y', strtotime($d));
          }
      ),
      array( 'db' => 'no_dipa',  'dt' => 3),
      array( 'db' => 'status', 'dt' => 4, 'formatter' => function($d,$row){ 
        if($d==1){
          return '<i>Digunakan</i> - Revisi '.$row[7];
        }
        if($d==2){
          return '<i>Disusun</i> - Revisi '.$row[7];
        }
        else {
          return '<i>Direvisi</i> - Revisi '.$row[7];
        }
      }),
      array( 'db' => 'status',  'dt' => 5, 'formatter' => function($d,$row,$data){ 
        if($d==1){
          return  '<div class="text-center">'.
                    '<a style="margin:0 2px;" id="btn-viw" class="btn btn-flat btn-primary btn-sm" data-toggle="modal"><i class="fa fa-file-text-o"></i> View</a>'.
                    '<a style="margin:0 2px;" id="btn-edt" href="#editModal" class="btn btn-flat btn-success btn-sm" data-toggle="modal"><i class="fa fa-edit"></i> Revisi</a>'.
                  '</div>';
        }
        else if($d==2 && $row[4]==1){
          return  '<div class="text-center">'.
                    '<a style="margin:0 2px;" id="btn-viw" class="btn btn-flat btn-primary btn-sm" data-toggle="modal"><i class="fa fa-file-text-o"></i> View</a>'.
                    '<a style="margin:0 2px;" id="btn-edt" href="#editModal" class="btn btn-flat btn-success btn-sm" data-toggle="modal"><i class="fa fa-edit"></i> Revisi</a>'.
                  '</div>';
        }
        else if($d==2 && $data==$row[1]){
          return  '<div class="text-center">'.
                    '<a style="margin:0 2px;" id="btn-act" class="btn btn-flat btn-info btn-sm" data-toggle="modal"><i class="fa fa-file-text-o"></i> Aktifkan</a>'.
                    '<a style="margin:0 2px;" id="btn-viw" class="btn btn-flat btn-primary btn-sm" data-toggle="modal"><i class="fa fa-file-text-o"></i> View</a>'.
                    '<a style="margin:0 2px;" id="btn-edt" href="#editModal" class="btn btn-flat btn-success btn-sm" data-toggle="modal"><i class="fa fa-edit"></i> Revisi</a>'.
                  '</div>';
        }
        else{
          return  '<div class="text-center">'.
                    '<a style="margin:0 2px;" id="btn-viw" class="btn btn-flat btn-primary btn-sm" data-toggle="modal"><i class="fa fa-file-text-o"></i> View</a>'.
                    '<a style="margin:0 2px;" id="btn-pesan" href="#lihatpesan" class="btn btn-flat btn-warning btn-sm" data-toggle="modal"><i class="fa fa-envelope"></i> Pesan</a>'.
                  '</div>';
        }
      }),
      array( 'db' => 'filesave',  'dt' => 6),
      array( 'db' => 'versi',  'dt' => 7),
      array( 'db' => 'pesan',  'dt' => 8),
    );
    $datatable->get_rkakl_view($table, $primaryKey, $columns);
  break;
  case 'view':
    ini_set('memory_limit', '-1');
    $filesave = $purifier->purify($_POST['filename']);
    $data = new Spreadsheet_Excel_Reader($path_upload.$filesave);
    if (empty($data->defaultColWidth)) {
      echo '<script>
              window.open("location", "_self", "");
              window.close();
            </script>';
    }
    else {
      echo '<html>
      <head>
      <title>Sistem Informasi Pelaporan | Kemenpora</title>
      <link rel="shortcut icon" type="image/png" href="'.$url_rewrite."static/dist/img/Kemenpora.png".'"/>
      <style>
      table.excel {border-style:ridge;border-width:1;border-collapse:collapse;font-family:sans-serif;font-size:12px;}
      table.excel thead th, table.excel tbody th {background:#CCCCCC;border-style:ridge;border-width:1;text-align: center;vertical-align:bottom;}
      table.excel tbody th {text-align:center;width:20px;}
      table.excel tbody td {vertical-align:bottom;}
      table.excel tbody td {padding: 0 3px;border: 1px solid #EEEEEE;}
      </style>
      </head>
      <body>'.$data->dump(true,true,0).'</body>
      </html>';
    }
  break;
  default:
    $utility->location_goto(".");
  break;
}
?>
