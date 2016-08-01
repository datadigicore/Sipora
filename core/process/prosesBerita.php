<?php

switch ($link[3 - config::$root]) {
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
    $rs = $berita->addBerita($data);
    $flash  = array(
            'category' => "success",
            'messages' => "Berita berhasil ditambahkan !"
          );
    $utility->location("content/berita",$flash);
  break;
  case 'addpengumuman':
    $data = $purifier->purifyArray($_POST);
    $rs = $berita->addPengumuman($data);
    $flash  = array(
            'category' => "success",
            'messages' => "Pengumuman berhasil diubah !"
          );
    $utility->location("content/pengumuman",$flash);
  break;
  case 'table':
    $dataArray['url_rewrite'] = $url_rewrite;
    $dataArray['idrkakl'] = $_POST['idrkakl'];
    $tableKey   = "berita";
    $primaryKey = "id";
    $columns    = array('id','id',
                        'tanggal',
                        'judul',
                        'isi',
                        'status',
                        );
    $formatter  = array(
        '5' => array('formatter' => function($d,$row,$data){ 
          if ($d == 1) {
            return 'Aktif';
          }
          else {
            return 'Tidak Aktif';
          }
        }),
      );
    
    $query      =  "SELECT SQL_CALC_FOUND_ROWS ".implode(", ", $columns)."
                    FROM $tableKey ";
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