<?php
  // if (!empty($_POST)) {
  //   $username = $purifier->purify($_POST['username']);
  //   $password = $purifier->purify($_POST['password']);
  //   $password = md5($password);
  //   if ($_SESSION['username'] == '') {
  //     $utility->location("content/home");
  //   }
  //   else {
      switch ($link[3]) {
        case 'create':
          echo "# BANG!";
        break;
        case 'creates':
          $thang  = $purifier->purify($_POST['thang']);
          $revisi = $purifier->purify($_POST['revisi']);
          $result = $rkakl->checkThang($thang);
          if ($result->num_rows == 0 || $revisi == 'true') {
            if(isset($_POST) && !empty($_FILES['fileimport']['name'])) {
              $path = $_FILES['fileimport']['name'];
              $ext  = pathinfo($path, PATHINFO_EXTENSION);
              if($ext != 'xls' && $ext != 'xlsx') {
                $utility->location("content/import");
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
                  $data_insert    = array(
                    "tanggal"    => date("Y-m-d H:i:s",$time),
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
                  $rkakl->insertRkakl($data_insert);
                  $rkakl->importRkakl($allDataInSheet);
                  $utility->location("content/import");
                }
              }
            }
            else {
              $utility->location("content/import");
            }
          }
          else {
            $utility->location("content/import");
          }
        break;
        case 'read':
          
        break;
        case 'update':
          echo "UPDATE HERE";
        break;
        case 'delete':
          echo "DELETE HERE";
        break;
        default:
          $utility->location("content/import");
        break;
      }
  //   }  
  // }
  // else {
  //   $utility->location(".");
  // }
?>
