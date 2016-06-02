<?php

switch ($link[3]) {
  case 'getContent':

    if ($_POST['option'] == '1') {
      echo '<div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Judul</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="judul" placeholder="Judul Berita" required>
              </div>
            </div>
            <textarea class="input-block-level" id="summernote" name="isi" rows="18">
          </textarea>';
    }
    elseif ($_POST['option'] == '2') {
      echo '<div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Judul</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="judul" placeholder="Judul Berita" required>
              </div>
            </div>
            <textarea class="input-block-level" id="summernote" name="isi" rows="18">
          </textarea>';
      
    }
    elseif ($_POST['option'] == '3') {
      
    }
  break;
  case 'unlock':
    $data = $purifier->purifyArray($_POST);
    $triwulan->unlock($data);
  break;
  case 'uploadImg':

    //TODO List
    // 1) Rename the File
    // 2) For Multiple Upload , Loop through $_FILES

    $md5 = md5(time());
    $dir_name = $path_upload."berita/".$md5."/";
    if(!file_exists($dir_name))mkdir($dir_name, 0777, true);

    move_uploaded_file($_FILES['file']['tmp_name'],$dir_name.$_FILES['file']['name']);
    // echo "<img src='../static/uploads/berita/".$md5."/".$_FILES['file']['name']."'>";
    echo $base_url."static/uploads/berita/".$md5."/".$_FILES['file']['name'];
  break;
  case 'aktifkan':
    $data = $purifier->purifyArray($_POST);
    $triwulan->activate($data);
  break;
  case 'nonaktif':
    $data = $purifier->purifyArray($_POST);
    $triwulan->deactivate($data);
  break;
  case 'add':
    $data = $purifier->purifyArray($_POST);
    print_r($data);
    $rs = $berita->addBerita($data);
    echo $rs;
    // print_r($data);
  break;
  case 'table':
    $dataArray['url_rewrite'] = $url_rewrite;
    $dataArray['idrkakl'] = $_POST['idrkakl'];
    $tableKey   = "rabview";
    $primaryKey = "id";
    $columns    = array('id','id',
                        'nama',
                        'start_date',
                        'end_date',
                        'status',
                        'status',
                        );
    $formatter  = array(
        '3' => array('formatter' => function($d,$row,$data){ 
          $arrbulan = array(
                  '00'=>"00", '01'=>"Januari", '02'=>"Februari", '03'=>"Maret", '04'=>"April", '05'=>"Mei", '06'=>"Juni",
                  '07'=>"Juli", '08'=>"Agustus", '09'=>"September", '10'=>"Oktober", '11'=>"November", '12'=>"Desember",
          );
          $pecahtgl = explode("-", $d);
          if ($pecahtgl[2] == '00' && $pecahtgl[1] == '00') {
            $tanggal = '<div class="text-center">-</div>';
          }
          else {
            $tanggal = $pecahtgl[2].' - '.$arrbulan[$pecahtgl[1]].' - '.$pecahtgl[0];
          }
          return $tanggal;
        }),
        '4' => array('formatter' => function($d,$row,$data){ 
          $arrbulan = array(
                  '00'=>"00", '01'=>"Januari", '02'=>"Februari", '03'=>"Maret", '04'=>"April", '05'=>"Mei", '06'=>"Juni",
                  '07'=>"Juli", '08'=>"Agustus", '09'=>"September", '10'=>"Oktober", '11'=>"November", '12'=>"Desember",
          );
          $pecahtgl = explode("-", $d);
          if ($pecahtgl[2] == '00' && $pecahtgl[1] == '00') {
            $tanggal = '<div class="text-center">-</div>';
          }
          else {
            $tanggal = $pecahtgl[2].' - '.$arrbulan[$pecahtgl[1]].' - '.$pecahtgl[0];
          }
          return $tanggal;
        }),
        '5' => array('formatter' => function($d,$row,$data){ 
          if ($d == 1) {
            return '<div class="label label-success col-md-12"><i class="fa fa-check-circle"></i> Sedang Aktif</div>';
          }
          if ($d == 4) {
            return '<div class="label label-warning col-md-12"><i class="fa fa-warning"></i> Sedang Revisi</div>';
          }
          else {
            return '<div class="label label-danger col-md-12"><i class="fa fa-warning"></i> Tidak Aktif</div>';
          }
        }),
        '6' => array('formatter' => function($d,$row,$data){ 
          if ($d == 0) {
            return '<a style="margin:1px 2px;" id="btn-unl" class="btn btn-flat btn-warning btn-xs col-md-12"><i class="fa fa-check-circle"></i> Unlock</a>';
          }
          elseif ($d == 1) {
            return '<a style="margin:1px 2px;" id="btn-non" class="btn btn-flat btn-danger btn-xs col-md-12"><i class="fa fa-warning"></i> Non aktif</a>';
          }
          elseif ($d == 2) {
            return '<a style="margin:1px 2px;" id="btn-act" class="btn btn-flat btn-success btn-xs col-md-12"><i class="fa fa-warning"></i> Aktifkan</a>';
          }
          elseif ($d == 4) {
            return '<a style="margin:1px 2px;" id="btn-non" class="btn btn-flat btn-danger btn-xs col-md-12"><i class="fa fa-warning"></i> Non Aktif</a>';
          }
          else {
            return '<a style="margin:1px 2px;" class="btn btn-flat btn-default btn-xs col-md-12"><i class="fa fa-warning"></i> No available</a>';
          }
        }),
      );
    
    $query      =  "SELECT SQL_CALC_FOUND_ROWS ".implode(", ", $columns)."
                    FROM triwulan ";
    $datatable->get_table($tableKey, $primaryKey, $columns, $query, $formatter, $dataArray);
  break;
  case 'tablepro':

    $dataArray['url_rewrite'] = $url_rewrite;
    $dataArray['idrkakl'] = $_POST['idrkakl'];
    $tableKey   = "rabview";
    $primaryKey = "id";
    $columns    = array('id','id',
                        'nama',
                        'thang',
                        'prog_high',
                        'prog_med',
                        'prog_low',
                        'status',
                        );
    $formatter  = array(
        '7' => array('formatter' => function($d,$row,$data){ 
          return '<a style="margin:1px 2px;" id="btn-edt" class="btn btn-flat btn-success btn-xs col-md-12"><i class="fa fa-pencil"></i> Edit Progress</a>';
        }),
      );
    
    $query      =  "SELECT SQL_CALC_FOUND_ROWS ".implode(", ", $columns)."
                    FROM triwulan ";
    $datatable->get_table($tableKey, $primaryKey, $columns, $query, $formatter, $dataArray);
  break;
  default:
    $utility->location("content/triwulan");
  break;
}
?>