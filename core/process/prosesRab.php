<?php
include 'config/application.php';

switch ($link[3]) {
  case 'table-rkakl':
    $dataArray['url_rewrite'] = $url_rewrite;

    #triwulan
    $query = "SELECT * from triwulan where status = '1' ORDER BY id DESC LIMIT 1";
    $result=$db->_fetch_array($query,1);
    if (!is_null($result)) {
      $idtriaktif = $result[0]['id'];
      foreach ($result as $key => $value) {
        $dataArray['prog_low'] = $value['prog_low'];
        $dataArray['prog_med'] = $value['prog_med'];
        $dataArray['prog_high'] = $value['prog_high'];
      }
    }else{
      $idtriaktif = '';
      $dataArray['prog_low'] = -1;
      $dataArray['prog_med'] = -1;
      $dataArray['prog_high'] = -1;
    }

    #realisasi
    $query="SELECT `id`, `thang`, `kdprogram`, `kdgiat`, `kdoutput`, `kdsoutput`, `kdkmpnen`, `kdskmpnen`, `deskripsi`, `tanggal`, `tanggal_akhir`, `tempat`, `lokasi`, `volume`, `satuan`, `jumlah`, `status`, `created_at`, `created_by`, `idtriwulan` FROM `rabview` " ;
    $result=$db->_fetch_array($query,1);
    $rabview =array();
    $key_stack=array();
    if (!is_null($result)) {
      foreach ($result as $key => $value) {
        $id=$value['id'];
        $thang=$value['thang'];
        $kdprogram=$value['kdprogram'];
        $kdgiat=$value['kdgiat'];
        $kdoutput=$value['kdoutput'];
        $kdsoutput=$value['kdsoutput'];
        $kdkmpnen=$value['kdkmpnen'];
        $kdskmpnen=$value['kdskmpnen'];
        $idtriwulan=$value['idtriwulan'];
        $jumlah=$value['jumlah'];
        $volume=$value['volume'];
        $status=$value['status'];
        $key="$kdprogram-$kdgiat-$kdoutput-$kdsoutput-$kdkmpnen-$kdskmpnen";
        $realisasi["$kdprogram-$kdgiat-$kdoutput-$kdsoutput-$kdkmpnen-$kdskmpnen"]['key']=$key;
        $realisasi["$kdprogram-$kdgiat-$kdoutput-$kdsoutput-$kdkmpnen-$kdskmpnen"]['jumlah'] += $jumlah;
        $realisasi["$kdprogram-$kdgiat-$kdoutput-$kdsoutput-$kdkmpnen-$kdskmpnen"]['volume'] += $volume;
          $realisasi["$kdprogram-$kdgiat-$kdoutput-$kdsoutput-$kdkmpnen-$kdskmpnen"]['lock'] += 0;
        if ($idtriaktif !== $idtriwulan) {
          $realisasi["$kdprogram-$kdgiat-$kdoutput-$kdsoutput-$kdkmpnen-$kdskmpnen"]['lock'] += $status;
        }
      }
      $dataArray = $realisasi;
    }

    #volume
    $query="SELECT `id`, `thang`, `kdprogram`, `kdgiat`, `kdoutput`, `kdsoutput`, `kdkmpnen`, `kdskmpnen`, `vol_target`, `vol_real`, `vol_real1`, `vol_real2`, `vol_real3`, `vol_real4`, `satuan`, `created_at`, `created_by` FROM `volume` order by id desc" ;
    $result=$db->_fetch_array($query,1);
    $rabview =array();

    if (!is_null($result)) {
      foreach ($result as $key => $value) {
        $id_vol=$value['id'];
        $thang=$value['thang'];
        $kdprogram=$value['kdprogram'];
        $kdgiat=$value['kdgiat'];
        $kdoutput=$value['kdoutput'];
        $kdsoutput=$value['kdsoutput'];
        $kdkmpnen=$value['kdkmpnen'];
        $kdskmpnen=$value['kdskmpnen'];
        $vol_target=$value['vol_target'];
        $vol_real=$value['vol_real'];
        $vol_real1=$value['vol_real1'];
        $vol_real2=$value['vol_real2'];
        $vol_real3=$value['vol_real3'];
        $vol_real4=$value['vol_real4'];
        $satuan=$value['satuan'];
        $dataArray["$kdprogram-$kdgiat-$kdoutput-$kdsoutput-$kdkmpnen-$kdskmpnen"]['vol_target'] = $vol_target;
        $dataArray["$kdprogram-$kdgiat-$kdoutput-$kdsoutput-$kdkmpnen-$kdskmpnen"]['vol_real'] = $vol_real;
        $dataArray["$kdprogram-$kdgiat-$kdoutput-$kdsoutput-$kdkmpnen-$kdskmpnen"]['satuan'] = $satuan;
        $dataArray["$kdprogram-$kdgiat-$kdoutput-$kdsoutput-$kdkmpnen-$kdskmpnen"]['id_vol'] = $id_vol;
      }
    }

    $swhere = "";
    if ($_POST['tahun'] != "") {
      $swhere="WHERE THANG = '".$_POST['tahun']."' ";
    }

    if ($_POST['direktorat'] != "") {
      if ($swhere == "") {
        $swhere .= "WHERE KDGIAT = '".$_POST['direktorat']."' ";
      }else{
        $swhere .= "AND KDGIAT = '".$_POST['direktorat']."' ";
      }
    }

    if ($_SESSION['direktorat'] != "") {
      if ($swhere == "") {
        $swhere .= "WHERE KDGIAT = '".$_SESSION['direktorat']."' ";
      }else{
        $swhere .= "AND KDGIAT = '".$_SESSION['direktorat']."' ";
      }
    }

    $tableKey   = "rkakl_full";
    $primaryKey = "idrkakl";
    $columns    = array('IDRKAKL',
                        'KDGIAT',
                        'CONCAT(KDOUTPUT," - ",NMOUTPUT)',
                        'CONCAT(KDSOUTPUT," - ",NMSOUTPUT)',
                        'CONCAT(KDKMPNEN," - ",NMKMPNEN)',
                        'CONCAT(KDSKMPNEN," - ",NMSKMPNEN)',
                        'SUM(JUMLAH)',
                        'CONCAT(KDPROGRAM,"-",KDGIAT,"-",KDOUTPUT,"-",KDSOUTPUT,"-",KDKMPNEN,"-",KDSKMPNEN)',
                        'SUM(JUMLAH)',
                        'CONCAT(KDPROGRAM,"-",KDGIAT,"-",KDOUTPUT,"-",KDSOUTPUT,"-",KDKMPNEN,"-",KDSKMPNEN)',
                        'CONCAT(KDPROGRAM,"-",KDGIAT,"-",KDOUTPUT,"-",KDSOUTPUT,"-",KDKMPNEN,"-",KDSKMPNEN)',
                        'SUM(JUMLAH)',
                        'IDRKAKL',
                        'CONCAT(KDPROGRAM,"-",KDGIAT,"-",KDOUTPUT,"-",KDSOUTPUT,"-",KDKMPNEN,"-",KDSKMPNEN)',
                        'CONCAT(KDPROGRAM,"-",KDGIAT,"-",KDOUTPUT,"-",KDSOUTPUT,"-",KDKMPNEN,"-",KDSKMPNEN)',
                        'CONCAT(KDPROGRAM,"-",KDGIAT,"-",KDOUTPUT,"-",KDSOUTPUT,"-",KDKMPNEN,"-",KDSKMPNEN)',
                        'CONCAT(KDPROGRAM,"-",KDGIAT,"-",KDOUTPUT,"-",KDSOUTPUT,"-",KDKMPNEN,"-",KDSKMPNEN)',
                        'CONCAT(KDPROGRAM,"-",KDGIAT,"-",KDOUTPUT,"-",KDSOUTPUT,"-",KDKMPNEN,"-",KDSKMPNEN)',
                        );
    $formatter  = array(
      '6' => array('formatter' => function($d,$row,$data){ 
        return number_format($d,2,",",".");
      }),
      '7' => array('formatter' => function($d,$row,$data){ 
        if (isset($data[$d]['jumlah'])) {
          return number_format($data[$d]['jumlah'],2,",",".");
        }else{
          return 0;
        }
      }),
      '8' => array('formatter' => function($d,$row,$data){ 
        if (isset($data[$row[7]]['jumlah'])) {
          $persen = ($data[$row[7]]['jumlah'] / $d) *100;

          if ($data['prog_low'] != "-1") {
            if ($persen <= $data['prog_low']) {
              $status = 'danger';
            }elseif ($persen <= $data['prog_med']) {
              $status = 'warning';
            }else{
              $status = 'success';
            }
          }else{
            $status = 'default';
          }
          return '<div class="pull-right">&nbsp;<span class="label label-'.$status.'">'.number_format($persen,2).'%</span></div>
                  <div class="progress progress-sm active">
                    <div class="progress-bar progress-bar-'.$status.' progress-bar-striped" role="progressbar" aria-valuenow="'.number_format($persen,2).'" aria-valuemin="0" aria-valuemax="100" style="width: '.number_format($persen,2).'%">
                      <span class="sr-only">'.number_format($persen,2).'% Complete</span>
                    </div>
                  </div>';
        }else{
          return '<div class="pull-right">&nbsp;<span class="label label-danger">'.number_format(0,2).'%</span></div>
                  <div class="progress progress-sm active">
                    <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="'.number_format(0,2).'" aria-valuemin="0" aria-valuemax="100" style="width: '.number_format(0,2).'%">
                      <span class="sr-only">'.number_format(0,2).'% Complete</span>
                    </div>
                  </div>';
        }
      }),
      '9' => array('formatter' => function($d,$row,$data){ 
        return number_format($data[$d]['vol_real']).' / '.number_format($data[$d]['vol_target'],0,",",".");
      }),
      '10' => array('formatter' => function($d,$row,$data){ 
        if ($data[$d]['id_vol'] != "") {
          $persenvol = ($data[$d]['vol_real'] / $data[$d]['vol_target']) * 100;
          if ($data['prog_low'] != "-1") {
            if ($persenvol <= $data['prog_low']) {
              $status = 'danger';
            }elseif ($persenvol <= $data['prog_med']) {
              $status = 'warning';
            }else{
              $status = 'success';
            }
          }else{
            $status = 'default';
          }
          return '<div class="pull-right">&nbsp;<span class="label label-'.$status.'">'.number_format($persenvol,2).'%</span></div>
                  <div class="progress progress-sm active">
                    <div class="progress-bar progress-bar-'.$status.' progress-bar-striped" role="progressbar" aria-valuenow="'.number_format($persenvol,2).'" aria-valuemin="0" aria-valuemax="100" style="width: '.number_format($persenvol,2).'%">
                      <span class="sr-only">'.number_format($persenvol,2).'% Complete</span>
                    </div>
                  </div>';
        }else{
          return '<div class="pull-right">&nbsp;<span class="label label-danger">'.number_format(0,2).'%</span></div>
                  <div class="progress progress-sm active">
                    <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="'.number_format(0,2).'" aria-valuemin="0" aria-valuemax="100" style="width: '.number_format(0,2).'%">
                      <span class="sr-only">'.number_format(0,2).'% Complete</span>
                    </div>
                  </div>';
        }
      }),
      '11' => array('formatter' => function($d,$row,$data){ 
        if (isset($d) || $d != "" || $d != 0) {
          $sisa = ($d - $data[$row[7]]['jumlah']);
          return number_format($sisa,2,",",".");
        }else{
          return 0;
        }
      }),
      '12' => array('formatter' => function($d,$row,$data){ 
        $button = '<div class="col-md-12">';
        $button .= '<a href="'.$data['base_content'].'kegiatan-rinci/'.$d.'" class="btn btn-flat btn-primary btn-sm col-md-12" ><i class="fa fa-list"></i>&nbsp; Kegiatan</a>';
        $button .= '<a id="btn-vol" href="#mdl-vol" class="btn btn-flat btn-warning btn-sm col-md-12" data-toggle="modal"><i class="fa fa-pencil"></i>&nbsp; Edit Volume</a>';
        if ($data[$row[17]]['lock'] == 0 && $_SESSION['level'] == 0) {
          $button .= '<a id="btn-unlock" href="#unlock" class="btn btn-flat btn-danger btn-sm col-md-12" data-toggle="modal"><i class="fa fa-unlock-alt"></i>&nbsp; Unlock</a>';
        }elseif($data[$row[17]]['lock'] > 0 && $_SESSION['level'] == 0){
          $button .= '<a id="btn-lock" href="#lock" class="btn btn-flat btn-danger btn-sm col-md-12" data-toggle="modal"><i class="fa fa-lock"></i>&nbsp; Lock</a>';
        }
        $button .='</div>';
        return $button; 
      }),
      '13' => array('formatter' => function($d,$row,$data){ 
        if (isset($data[$d]['satuan'])) {
          return $data[$d]['satuan'];
        }else{
          return "";
        }
      }),
      '14' => array('formatter' => function($d,$row,$data){ 
        if (isset($data[$d]['id_vol'])) {
          return $data[$d]['id_vol'];
        }else{
          return 0;
        }
      }),
      '15' => array('formatter' => function($d,$row,$data){ 
        if (isset($data[$d]['vol_target'])) {
          return $data[$d]['vol_target'];
        }else{
          return 0;
        }
      }),
      '16' => array('formatter' => function($d,$row,$data){ 
        if (isset($data[$d]['vol_real'])) {
          return $data[$d]['vol_real'];
        }else{
          return 0;
        }
      }),
      );
    $query      =  "SELECT SQL_CALC_FOUND_ROWS ".implode(", ", $columns)."
                    FROM rkakl_full
                    ".$swhere."
                    GROUP BY KDPROGRAM, KDGIAT, KDOUTPUT, KDSOUTPUT, KDKMPNEN, KDSKMPNEN";
    $datatable->get_table($tableKey, $primaryKey, $columns, $query, $formatter, $dataArray);

    break;
  case 'table-kegiatan':
    $dataArray['url_rewrite'] = $url_rewrite;
    $dataArray['idrkakl'] = $_POST['idrkakl'];
    $tableKey   = "rabview";
    $primaryKey = "id";
    $columns    = array('id',
                        'deskripsi',
                        'idtriwulan',
                        'tanggal',
                        'lokasi',
                        'jumlah',
                        'status',
                        'status',
                        'tanggal_akhir',
                        'tempat',
                        );
    $formatter  = array(
        '3' => array('formatter' => function($d,$row,$data){ 
          return date("d M Y", strtotime($d)) . ' - ' . date("d M Y", strtotime($row[8]));
        }),
        '4' => array('formatter' => function($d,$row,$data){ 
          return $row[9] . ', ' . $d;
        }),
        '5' => array('formatter' => function($d,$row,$data){ 
          return number_format($d,2,",",".");
        }),
        '6' => array('formatter' => function($d,$row,$data){ 
          if ($d == "1") {
            return "<i>Aktif</i>";
          }elseif ($d == "0") {
            return "<i>Close</i>";
          }elseif ($d == "4") {
            return "<i>Revisi</i>";
          }
        }),
        '7' => array('formatter' => function($d,$row,$data){ 
          $button = '<div class="col-md-12">';
          if($_SESSION['level'] != 0 && ($d == 1 || $d == 4)){
            $button .= '<a id="btn-trans" href="'.$data['url_rewrite'].'content/kegiatan-edit/'.$row[0].'/'.$data['idrkakl'].'" class="btn btn-flat btn-warning btn-sm col-md-6" ><i class="fa fa-pencil"></i>&nbsp; Edit</a>';
            if ($d == 1) {
              $button .= '<a id="btn-del" href="#delete" class="btn btn-flat btn-danger btn-sm col-md-6" data-toggle="modal"><i class="fa fa-close"></i>&nbsp; Delete</a>';
            }
          }
          elseif(($_SESSION['level'] != 0 && $d == 0) || ($_SESSION['level'] == 0 && $d == 1) ){
            $button .= '<a style="margin:1px 2px;" class="btn btn-flat btn-sm btn-default col-md-12"><i class="fa fa-warning"></i> No available</a>';
          }
          elseif($_SESSION['level'] == 0 && $d == 0){
            $button .= '<a id="btn-unlock" href="#unlock" class="btn btn-flat btn-danger btn-sm col-md-12" data-toggle="modal"><i class="fa fa-unlock-alt"></i>&nbsp; Unlock</a>';
          }
          elseif($_SESSION['level'] == 0 && $d == 4){
            $button .= '<a id="btn-lock" href="#lock" class="btn btn-flat btn-warning btn-sm col-md-12" data-toggle="modal"><i class="fa fa-lock"></i>&nbsp; Lock</a>';
          }
          $button .= '</div>';
          return $button;
        }),
      );
    $tahun = $_POST['tahun'];
    $direktorat = $_POST['direktorat'];
    $kdoutput = $_POST['kdoutput'];
    $kdsoutput = $_POST['kdsoutput'];
    $kdkmpnen = $_POST['kdkmpnen'];
    $kdskmpnen = $_POST['kdskmpnen'];
    $where="";
    if ($tahun != "") {
      $where = 'thang = "'.$tahun.'" ';
    }
    if ($direktorat != "") {
      if ($where == "") {
        $where .= 'kdgiat = "'.$direktorat.'" ';
      }else{
        $where .= 'AND kdgiat = "'.$direktorat.'" ';
      }
    }
    if ($kdoutput != "") {
      if ($where == "") {
        $where .= 'kdoutput = "'.$kdoutput.'" ';
      }else{
        $where .= 'AND kdoutput = "'.$kdoutput.'" ';
      }
    }
    if ($kdsoutput != "") {
      if ($where == "") {
        $where .= 'kdsoutput = "'.$kdsoutput.'" ';
      }else{
        $where .= 'AND kdsoutput = "'.$kdsoutput.'" ';
      }
    }
    if ($kdkmpnen != "") {
      if ($where == "") {
        $where .= 'kdkmpnen = "'.$kdkmpnen.'" ';
      }else{
        $where .= 'AND kdkmpnen = "'.$kdkmpnen.'" ';
      }
    }
    if ($kdskmpnen != "") {
      if ($where == "") {
        $where .= 'kdskmpnen = "'.$kdskmpnen.'" ';
      }else{
        $where .= 'AND kdskmpnen = "'.$kdskmpnen.'" ';
      }
    }
    $query      =  "SELECT SQL_CALC_FOUND_ROWS ".implode(", ", $columns)."
                    FROM rabview
                    WHERE ".$where."";
    $datatable->get_table($tableKey, $primaryKey, $columns, $query, $formatter, $dataArray);

    break;
    case 'getDirektorat':
    $kdprog = $_POST['prog'];
    $rs = $rab->getDirektorat($kdprog);
    echo json_encode($rs);
    break;
  case 'getyear':
    $query  = "SELECT THANG FROM rkakl_full where (THANG != '' OR THANG != '-') and STATUS = 1 group by THANG";
    $result=$db->_fetch_array($query,1);
    echo json_encode($result);
    break;
  case 'getkode':
    // print_r($_POST);
    /*$kdgrup = $_SESSION['kdgrup'];
    $query = "SELECT * FROM grup WHERE id = '$kdgrup'";
    $res = $db->_fetch_array($query,1);

    $direktorat = explode(",", $res[0]['direktorat']);
    $kodegiat = '(';
    foreach ($direktorat as $key => $value) {
      $pecah = explode("-", $value);
      $kodegiat .= "'".$pecah[1]."',";
      print_r($pecah);
    }
    $kodegiat = substr($kodegiat,0,-1);
    $kodegiat .= ")";
    print_r($kodegiat);
    die;*/

    $getrkakl = "SELECT THANG,KDPROGRAM,KDGIAT,NMGIAT,KDOUTPUT,NMOUTPUT,KDSOUTPUT,NMSOUTPUT,KDKMPNEN,NMKMPNEN,KDSKMPNEN,NMSKMPNEN
                        FROM rkakl_full 
                            WHERE idrkakl = '".$_POST['idrkakl']."'
                            AND THANG = '".$_POST['tahun']."'
                            LIMIT 1
                "; 

    $result=$db->_fetch_array($getrkakl,1);
    echo json_encode($result);
    break;
  case 'gettriwulan':
    $query = "SELECT id, nama, status FROM triwulan WHERE status = 1";
    $result=$db->_fetch_array($query,1);
    echo json_encode($result);
    break;
    case 'getout2':
    $output = $rab->getout2($_POST['prog'],$_POST['direktorat']);
    echo json_encode($output);
    break;
  case 'getsout':
    $soutput = $mdl_rab->getsout($_POST['prog'],$_POST['output'],$_POST['tahun'],$_POST['direktorat']);
    echo json_encode($soutput);
    break;
  case 'getkomp':
    $komp = $mdl_rab->getkomp($_POST['prog'],$_POST['output'],$_POST['soutput'],$_POST['tahun'],$_POST['direktorat']);
    echo json_encode($komp);
    break;
  case 'getskomp':
    $skomp = $mdl_rab->getskomp($_POST['prog'],$_POST['output'],$_POST['soutput'],$_POST['komp'],$_POST['tahun'],$_POST['direktorat']);
    echo json_encode($skomp);
    break;
  case 'save':  
    $idrkakl = $_POST['idrkakl'];
    $cek = $rabview->cekpagu($idrkakl,$_POST['jumlah'],$_POST['idtriwulan']);
      
    if ($cek == 'error') {
      $flash  = array(
            'category' => "warning",
            'messages' => "Data Kegiatan gagal dilanjutkan karena realisasi melebihi PAGU Anggaran."
          );
      $utility->location("content/kegiatan-rinci/".$idrkakl,$flash);
    }elseif ($cek == 'berhasil') {
      $rabview->insertRabview($_POST);
      $flash  = array(
            'category' => "success",
            'messages' => "Data Kegiatan berhasil ditambahkan !"
          );
      $utility->location("content/kegiatan-rinci/".$idrkakl,$flash);
    }else{
      $flash  = array(
            'category' => "warning",
            'messages' => "Data Kegiatan gagal dilanjutkan. Silahkan dicoba kembali."
          );
      $utility->location("content/kegiatan-rinci/".$idrkakl,$flash);
    }
    break;
  case 'edit':
    $idrkakl = $_POST['idrkakl'];
    $cek = $rabview->cekpagu($idrkakl,$_POST['jumlah'],$_POST['idtriwulan'], $_POST['id']);
    if ($cek == 'error') {
      $flash  = array(
            'category' => "warning",
            'messages' => "Data Kegiatan gagal dilanjutkan karena realisasi melebihi PAGU Anggaran."
          );
      $utility->location("content/kegiatan-rinci/".$idrkakl,$flash);
    }elseif ($cek == 'berhasil') {
      $rabview->updateRabview($_POST);
      $flash  = array(
            'category' => "success",
            'messages' => "Data Kegiatan berhasil diubah !"
          );
      $utility->location("content/kegiatan-rinci/".$idrkakl,$flash);
    }else{
      $flash  = array(
            'category' => "warning",
            'messages' => "Data Kegiatan gagal dilanjutkan. Silahkan dicoba kembali."
          );
      $utility->location("content/kegiatan-rinci/".$idrkakl,$flash);
    }
    break;
  case 'delete':
    $idrkakl = $_POST['idrkakl'];
    $jumlah = 0;
    $id = $_POST['id'];
    $query = "SELECT idtriwulan FROM rabview WHERE id = '$id'";
    $result = $db->_fetch_array($query,1);
    $idtriwulan = $result[0]['idtriwulan'];
    $cek = $rabview->cekpagu($idrkakl,$jumlah,$idtriwulan,$id);
    $rabview->deleteRabview($_POST);
    $flash  = array(
          'category' => "success",
          'messages' => "Data Kegiatan telah dihapus"
        );
    $utility->location("content/kegiatan-rinci/".$_POST['idrkakl'],$flash);
    break;
  case 'lock':
    $status = $_POST['statuslock'];
    if (isset($_POST['id_rab_unlock'])) {
      $id = $_POST['id_rab_unlock'];
    }else{
      $id = $_POST['id_rab_lock'];
    }
    $query = "UPDATE rabview SET status = '$status' WHERE id = '$id'";
    $result = $db->query($query);
    if ($status == 4) {
      $flash  = array(
              'category' => "success",
              'messages' => "Data Kegiatan Telah Dibuka Kembali !"
            );
    }else{
      $flash  = array(
              'category' => "success",
              'messages' => "Data Kegiatan Telah Dikunci Kembali !"
            );
    }
    $utility->location("content/kegiatan-rinci/".$_POST['idrkakl'],$flash);

    break;
  case 'lockkomp':
    $status = $_POST['statuslock'];
    $idrkakl = $_POST['idrkakl'];
    #triwulan
    $query = "SELECT id from triwulan where status = '1' ORDER BY id DESC LIMIT 1";
    $result=$db->_fetch_array($query,1);
    if (!is_null($result)) {
      $idtriaktif = $result[0]['id'];
    }else{
      $idtriaktif = '';
    }

    $query = "SELECT THANG, KDPROGRAM, KDGIAT, KDOUTPUT, KDSOUTPUT, KDKMPNEN, KDSKMPNEN FROM rkakl_full where IDRKAKL = '$idrkakl' ";
    $result = $db->_fetch_array($query,1);

    $thang = $result[0]['THANG'];
    $kdprogram = $result[0]['KDPROGRAM'];
    $kdgiat = $result[0]['KDGIAT'];
    $kdoutput = $result[0]['KDOUTPUT'];
    $kdsoutput = $result[0]['KDSOUTPUT'];
    $kdkmpnen = $result[0]['KDKMPNEN'];
    $kdskmpnen = $result[0]['KDSKMPNEN'];

    $query = "UPDATE rabview SET status = '$status' 
              WHERE thang = '$thang' 
              and kdprogram = '$kdprogram' 
              and kdgiat = '$kdgiat'
              and kdoutput = '$kdoutput'
              and kdsoutput = '$kdsoutput'
              and kdkmpnen = '$kdkmpnen'
              and kdskmpnen = '$kdskmpnen'
              and idtriwulan != '$idtriaktif'";
    $result = $db->query($query);
    if ($status == 4) {
      $flash  = array(
              'category' => "success",
              'messages' => "Data Kegiatan Telah Dibuka Kembali !"
            );
    }else{
      $flash  = array(
              'category' => "success",
              'messages' => "Data Kegiatan Telah Dikunci Kembali !"
            );
    }
    $utility->location("content/kegiatan-rinci/".$_POST['idrkakl'],$flash);

    break;
    break;
  case 'editvol':
    $id_volume = $_POST['id_volume'];
    $idrkakl_vol = $_POST['idrkakl_vol'];
    $data = $_POST;
    $query="SELECT `THANG`, `KDPROGRAM`, `KDGIAT`, `KDOUTPUT`, `KDSOUTPUT`, `KDKMPNEN`, `KDSKMPNEN` FROM `rkakl_full` where IDRKAKL = '$idrkakl_vol'" ;
    $result=$db->_fetch_array($query,1);
    foreach ($result as $key => $value) {
        $data['thang'] = $value['THANG'];
        $data['kdprogram'] = $value['KDPROGRAM'];
        $data['kdgiat'] = $value['KDGIAT'];
        $data['kdoutput'] = $value['KDOUTPUT'];
        $data['kdsoutput'] = $value['KDSOUTPUT'];
        $data['kdkmpnen'] = $value['KDKMPNEN'];
        $data['kdskmpnen'] = $value['KDSKMPNEN'];
    }

    $query = "SELECT * from triwulan where status = '1' ORDER BY id DESC LIMIT 1";
    $result=$db->_fetch_array($query,1);
    if (!is_null($result)) {
      foreach ($result as $key => $value) {
        $data['idtriwulan'] = $value['id'];
      }
    }else{
      $data['idtriwulan'] = "";
    }

    if ($data['idtriwulan'] != "") {
      if ($id_volume == "" || $id_volume == 0) {
        $volume->insertVolume($data);
        $flash  = array(
              'category' => "success",
              'messages' => "Data Volume Telah Ditambahkan !"
            );
      }else{
        $volume->updateVolume($data);
        $flash  = array(
              'category' => "success",
              'messages' => "Data Volume Telah Diubah !"
            );
      }
    }else{
      $flash  = array(
              'category' => "error",
              'messages' => "Gagal Melanjutkan Proses Karena Status Triwulan Sedang Tidak Aktif !"
            );
    }
    
    $utility->location("content/kegiatan",$flash);
    break;
  default:
    $utility->location(".");
  break;

  function cekpagu(){
    return 'tes';
  }
}
?>
