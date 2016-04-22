<?php
include 'config/application.php';

switch ($link[3]) {
  case 'table':
    $table = "rabview";
    $key   = "id";
    $dataArray['url_rewrite'] = $url_rewrite; 
    $dataArray['direktorat'] = $direk; 
    $tahun = $_POST['tahun'];
    $direktorat = $_POST['direktorat'];
    $kdoutput = $_POST['kdoutput'];
    $kdsoutput = $_POST['kdsoutput'];
    $kdkmpnen = $_POST['kdkmpnen'];
    $kdskmpnen = $_POST['kdskmpnen'];
    $column = array(
      array( 'db' => 'id',      'dt' => 0 ),
      array( 'db' => 'kdprogram',  'dt' => 1, 'formatter' => function($d,$row, $dataArray){ 
          return '<table><tr><td>Program</td><td> :&nbsp;</td><td>'.$d.'</td></tr>'.
                 '<tr><td>Output</td><td> :&nbsp;</td><td>'.$row[9].'</td></tr>'.
                 '<tr><td>Sub Output</td><td> :&nbsp;</td><td>'.$row[10].'</td></tr>'.
                 '<tr><td>Komponen</td><td> :&nbsp;</td><td>'.$row[11].'</td></tr>'.
                 '<tr><td>Sub Komponen</td><td> :&nbsp;</td><td>'.$row[12].'</td></tr></table>';
      }),
      array( 'db' => 'kdgiat',  'dt' => 2, 'formatter' => function($d, $row, $dataArray){
        return $dataArray['direktorat'][$d];
      }),
      array( 'db' => 'deskripsi',  'dt' => 3),
      array( 'db' => 'tanggal',  'dt' => 4, 'formatter' => function( $d, $row ) {
        $arrbulan = array(
                '01'=>"Januari",
                '02'=>"Februari",
                '03'=>"Maret",
                '04'=>"April",
                '05'=>"Mei",
                '06'=>"Juni",
                '07'=>"Juli",
                '08'=>"Agustus",
                '09'=>"September",
                '10'=>"Oktober",
                '11'=>"November",
                '12'=>"Desember",
        );
        $pecahtgl1 = explode("-", $d);
        $tglawal = $pecahtgl1[2].' '.$arrbulan[$pecahtgl1[1]].' '.$pecahtgl1[0];
        $pecahtgl2 = explode("-", $row[15]);
        $tglakhir = $pecahtgl2[2].' '.$arrbulan[$pecahtgl2[1]].' '.$pecahtgl2[0];
        return $tglawal.' - '.$tglakhir;
      }),
      array( 'db' => 'lokasi',  'dt' => 5, 'formatter' => function($d,$row){
        return $row[14].', '.$d;
      }),
      array( 'db' => '(SELECT SUM(rabfull.value) from rabfull where rabfull.rabview_id = rabview.id group by rabfull.rabview_id)','dt' => 6, 'formatter' => function($d,$row){
        return 'Rp '.number_format($d,2,',','.');
      }),
      array( 'db' => 'status', 'dt' => 7, 'formatter' => function($d,$row){ 
        if($d==0){
          return '<i>Belum Diajukan</i>';
        }
        elseif($d==1){
          return '<i>Telah Diajukan</i>';
        }
        elseif($d==2){
          return '<i>Telah Disahkan</i>';
        }
        elseif($d==3){
          return '<i>Revisi</i>';
        }
        elseif($d==4){
          return '<i>Close</i>';
        }
        elseif($d==5){
          return '<i>Adendum</i>';
        }
        elseif($d==6){
          return '<i>Close Adendum</i>';
        }
        elseif($d==7){
          return '<i>Penutupan Anggaran</i>';
        }
      }),
      array( 'db' => 'status',  'dt' => 8, 'formatter' => function($d,$row, $dataArray){ 
        $button = '<div class="btn-group">';
        if($d==0 && $_SESSION['level'] != 0){
          $button .= '<a style="margin:0 2px;" href="'.$dataArray['url_rewrite'].'content/rabdetail/'.$row[0].'" class="btn btn-flat btn-primary btn-sm" ><i class="fa fa-list"></i>&nbsp; Rincian</a>';
          if ($_SESSION['level'] == 2) {
            $button .= '<a style="margin:0 2px;" id="btn-aju" href="#ajuan" class="btn btn-flat btn-success btn-sm col-sm" data-toggle="modal"><i class="fa fa-check"></i>&nbsp; Ajukan</a>';
          }
          $button .= '<a style="margin:0 2px;" id="btn-trans" href="'.$dataArray['url_rewrite'].'content/rab/edit/'.$row[0].'" class="btn btn-flat btn-warning btn-sm" ><i class="fa fa-pencil"></i>&nbsp; Edit</a>';
          $button .= '<a style="margin:0 2px;" id="btn-del" href="#delete" class="btn btn-flat btn-danger btn-sm" data-toggle="modal"><i class="fa fa-close"></i>&nbsp; Delete</a>';
          $button .= '<a style="margin:0 2px;" id="btn-trans" href="'.$dataArray['url_rewrite'].'process/report/pengajuan_UMK/'.$row[0].'" class="btn btn-flat btn-default btn-sm" ><i class="fa fa-file-text-o"></i>&nbsp; Cetak Pengajuan UMK</a>';
          $button .= '<a style="margin:0 2px;" id="btn-trans" href="'.$dataArray['url_rewrite'].'process/report/rincian_kebutuhan_dana/'.$row[0].'" class="btn btn-flat btn-default btn-sm" ><i class="fa fa-file-text-o"></i>&nbsp; Cetak Rincian Keb. Dana</a>';
        }
        elseif ($d==0 && $_SESSION['level'] == 0) {
          $button .= '<a style="margin:0 2px;" id="btn-trans" href="'.$dataArray['url_rewrite'].'content/rabdetail/'.$row[0].'" class="btn btn-flat btn-primary btn-sm"><i class="fa fa-list"></i>&nbsp; Rincian</a>';
          $button .= '<a style="margin:0 2px;" id="btn-trans" href="'.$dataArray['url_rewrite'].'process/report/pengajuan_UMK/'.$row[0].'" class="btn btn-flat btn-default btn-sm" ><i class="fa fa-file-text-o"></i>&nbsp; Cetak Pengajuan UMK</a>';
          $button .= '<a style="margin:0 2px;" id="btn-trans" href="'.$dataArray['url_rewrite'].'process/report/rincian_kebutuhan_dana/'.$row[0].'" class="btn btn-flat btn-default btn-sm" ><i class="fa fa-file-text-o"></i>&nbsp; Cetak Rincian Keb. Dana</a>';
        }
        elseif($d==1  && $_SESSION['level'] != 0){
          $button .= '<a style="margin:0 2px;" class="btn btn-flat btn-primary btn-sm" href="'.$dataArray['url_rewrite'].'content/rabdetail/'.$row[0].'" ><i class="fa fa-list"></i>&nbsp; Rincian</a>';
          $button .= '<a style="margin:0 2px;" id="btn-trans" href="'.$dataArray['url_rewrite'].'process/report/pengajuan_UMK/'.$row[0].'" class="btn btn-flat btn-default btn-sm" ><i class="fa fa-file-text-o"></i>&nbsp; Cetak Pengajuan UMK</a>';
          $button .= '<a style="margin:0 2px;" id="btn-trans" href="'.$dataArray['url_rewrite'].'process/report/rincian_kebutuhan_dana/'.$row[0].'" class="btn btn-flat btn-default btn-sm" ><i class="fa fa-file-text-o"></i>&nbsp; Cetak Rincian Keb. Dana</a>';        
        }

        elseif ($d==1  && $_SESSION['level'] == 0) {
          $button .= '<a style="margin:0 2px;" href="'.$dataArray['url_rewrite'].'content/rabdetail/'.$row[0].'" class="btn btn-flat btn-primary btn-sm"><i class="fa fa-list"></i>&nbsp; Rincian</a>';
          $button .= '<a style="margin:0 2px;" id="btn-sah" href="#sahkan" class="btn btn-flat btn-success btn-sm" data-toggle="modal"><i class="fa fa-check"></i>&nbsp; Sahkan</a>';
          $button .= '<a style="margin:0 2px;" id="btn-rev" href="#revisi" class="btn btn-flat btn-warning btn-sm" data-toggle="modal"><i class="fa fa-edit"></i>&nbsp; Revisi</a>';
          $button .= '<a style="margin:0 2px;" id="btn-trans" href="'.$dataArray['url_rewrite'].'process/report/pengajuan_UMK/'.$row[0].'" class="btn btn-flat btn-default btn-sm" ><i class="fa fa-file-text-o"></i>&nbsp; Cetak Pengajuan UMK</a>';
          $button .= '<a style="margin:0 2px;" id="btn-trans" href="'.$dataArray['url_rewrite'].'process/report/rincian_kebutuhan_dana/'.$row[0].'" class="btn btn-flat btn-default btn-sm" ><i class="fa fa-file-text-o"></i>&nbsp; Cetak Rincian Keb. Dana</a>';
        }
        elseif($d==3 && $_SESSION['level'] != 0){
          $button .= '<a style="margin:0 2px;" id="btn-trans" href="'.$dataArray['url_rewrite'].'content/rabdetail/'.$row[0].'" class="btn btn-flat btn-primary btn-sm" ><i class="fa fa-list"></i>&nbsp; Rincian</a>';
          if ($_SESSION['level'] == 2) {
            $button .= '<a style="margin:0 2px;" id="btn-aju" href="#ajuan" class="btn btn-flat btn-success btn-sm" data-toggle="modal"><i class="fa fa-check"></i>&nbsp; Ajukan Revisi</a>';
          }
          $button .= '<a style="margin:0 2px;" id="btn-trans" href="'.$dataArray['url_rewrite'].'content/rab/edit/'.$row[0].'" class="btn btn-flat btn-warning btn-sm" ><i class="fa fa-pencil"></i>&nbsp; Edit</a>';
          if ($row[13] != "") {
            $button .= '<a style="margin:0 2px;" id="btn-pesan" href="#pesanrevisi" class="btn btn-flat btn-danger btn-sm" data-toggle="modal"><i class="fa fa-envelope"></i>&nbsp; Pesan </a>';
          }
        }
        elseif ($d==3 && $_SESSION['level'] == 0) {
          $button .= '<a style="margin:0 2px;" id="btn-trans" href="'.$dataArray['url_rewrite'].'content/rabdetail/'.$row[0].'" class="btn btn-flat btn-primary btn-sm"><i class="fa fa-list"></i>&nbsp; Rincian</a>';
          if ($row[13] != "") {
            $button .= '<a style="margin:0 2px;" id="btn-pesan" href="#pesanrevisi" class="btn btn-flat btn-danger btn-sm" data-toggle="modal"><i class="fa fa-envelope"></i>&nbsp; Pesan </a>';
          }
        }
        elseif($d==6 && $_SESSION['level'] != 0){
          $button .= '<a style="margin:0 2px;" id="btn-trans" href="'.$dataArray['url_rewrite'].'content/rabdetail/'.$row[0].'" class="btn btn-flat btn-primary btn-sm" ><i class="fa fa-list"></i>&nbsp; Rincian</a>';
        }
        elseif ($d==6 && $_SESSION['level'] == 0) {
          $button .= '<a style="margin:0 2px;" id="btn-aju" href="#tutup" class="btn btn-flat btn-success btn-sm" data-toggle="modal"><i class="fa fa-check"></i>&nbsp; Penutupan Anggaran</a>';
          $button .= '<a style="margin:0 2px;" id="btn-trans" href="'.$dataArray['url_rewrite'].'content/rabdetail/'.$row[0].'" class="btn btn-flat btn-primary btn-sm"><i class="fa fa-list"></i>&nbsp; Rincian</a>';
        }
        else{
          $button .= '<a style="margin:0 2px;" href="'.$dataArray['url_rewrite'].'content/rabdetail/'.$row[0].'" class="btn btn-flat btn-primary btn-sm" ><i class="fa fa-list"></i>&nbsp; Rincian</a>';
          $button .= '<a style="margin:0 2px;" id="btn-trans" href="'.$dataArray['url_rewrite'].'process/report/pengajuan_UMK/'.$row[0].'" class="btn btn-flat btn-default btn-sm" ><i class="fa fa-file-text-o"></i>&nbsp; Cetak Pengajuan UMK</a>';
          $button .= '<a style="margin:0 2px;" id="btn-trans" href="'.$dataArray['url_rewrite'].'process/report/rincian_kebutuhan_dana/'.$row[0].'/1'.'" class="btn btn-flat btn-default btn-sm" ><i class="fa fa-file-text-o"></i>&nbsp; Cetak Daftar PJ UMK</a>';
        }
        
        $button .= '</div>';
        return $button;
      }),
      array( 'db' => 'kdoutput',  'dt' => 9),
      array( 'db' => 'kdsoutput',  'dt' => 10),
      array( 'db' => 'kdkmpnen',  'dt' => 11),
      array( 'db' => 'kdskmpnen',  'dt' => 12),
      array( 'db' => 'pesan',  'dt' => 13),
      array( 'db' => 'tempat',  'dt' => 14),
      array( 'db' => 'tanggal_akhir',  'dt' => 15),
    );
    $where="";
    if ($tahun != "") {
      $where = 'thang = "'.$tahun.'"';
    }
    if ($direktorat != "") {
      if ($where == "") {
        $where .= 'kdgiat = "'.$direktorat.'"';
      }else{
        $where .= 'AND kdgiat = "'.$direktorat.'"';
      }
    }
    if ($kdoutput != "") {
      if ($where == "") {
        $where .= 'kdoutput = "'.$kdoutput.'"';
      }else{
        $where .= 'AND kdoutput = "'.$kdoutput.'"';
      }
    }
    if ($kdsoutput != "") {
      if ($where == "") {
        $where .= 'kdsoutput = "'.$kdsoutput.'"';
      }else{
        $where .= 'AND kdsoutput = "'.$kdsoutput.'"';
      }
    }
    if ($kdkmpnen != "") {
      if ($where == "") {
        $where .= 'kdkmpnen = "'.$kdkmpnen.'"';
      }else{
        $where .= 'AND kdkmpnen = "'.$kdkmpnen.'"';
      }
    }
    if ($kdskmpnen != "") {
      if ($where == "") {
        $where .= 'kdskmpnen = "'.$kdskmpnen.'"';
      }else{
        $where .= 'AND kdskmpnen = "'.$kdskmpnen.'"';
      }
    }
    $group='';
    $datatable->get_table_group($table, $key, $column,$where,$group,$dataArray);
    break;
  case 'table-rkakl':
      $table                    = "rkakl_full";
      $key                      = "KDGIAT";
      $dataArray['url_rewrite'] = $base_url; 
      $tahun                    = $_POST['tahun'];
      $direktorat               = $_POST['direktorat'];
      $column                   = array(
        array( 'db' => 'KDGIAT',      'dt' => 0 ),
        array( 'db' => 'NMGIAT',      'dt' => 1, 'formatter' => function($d,$row){
          return $row[0]." - ".$d;
        }),
        array( 'db' => 'NMOUTPUT',      'dt' => 2, 'formatter' => function($d,$row){
          if ($_SESSION['direktorat'] != "") {
            return 'Output : '.$row[12]." - ".$d;
          }else{
            return $row[12]." - ".$d;
          }
        }),
        array( 'db' => 'NMSOUTPUT',      'dt' => 3, 'formatter' => function($d,$row){
          return $row[13]." - ".$d;
        }),
        array( 'db' => 'NMKMPNEN',      'dt' => 4, 'formatter' => function($d,$row){
          return $row[14]." - ".$d;
        }),
        array( 'db' => 'NMSKMPNEN',      'dt' => 5, 'formatter' => function($d,$row){
          return $row[15]." - ".$d;
        }),
        array( 'db' => 'SUM(JUMLAH)',      'dt' => 6, 'formatter' => function($d,$row){
          return number_format($d,0,".",".");
        }),
        array( 'db' => '(SELECT SUM(rabview.jumlah) from rabview 
                        where rabview.kdprogram = rkakl_full.KDPROGRAM 
                        and rabview.kdgiat = rkakl_full.KDGIAT 
                        and rabview.kdoutput = rkakl_full.KDOUTPUT 
                        and CASE when rabview.kdsoutput is not null then rabview.kdsoutput = rkakl_full.KDSOUTPUT ELSE TRUE END
                        and CASE when rabview.kdkmpnen is not null then rabview.kdkmpnen = rkakl_full.KDKMPNEN ELSE TRUE END 
                        and CASE when rabview.kdskmpnen is not null then rabview.kdskmpnen = rkakl_full.KDSKMPNEN ELSE TRUE END 
                      limit 1)', 'dt' => 7, 'formatter' => function($d,$row){
          if(is_null($row[7])){
            if (is_null($row[18])) {
              return 0;
            }
            else {
              return number_format($row[18],0,".",".");
            }
          } else {
            return number_format($row[7],0,".",".");
          }
          
        }),
        array( 'db' => 'SUM(JUMLAH)','dt' => 8, 'formatter' => function($d,$row){
          if(is_null($row[7])){
            if (is_null($row[18])) {
              return '<div class="pull-right">&nbsp;<span class="label label-danger"> 0 %</span></div>';
            }
            else {
              $persen = ($row[18] / $d) * 100;
            if ($persen < 50) {
              $status = 'danger';
            }elseif ($persen < 80) {
              $status = 'warning';
            }elseif ($persen <= 100) {
              $status = 'success';
            }
            return '<div class="pull-right">&nbsp;<span class="label label-'.$status.'">'.number_format($persen,2).'%</span></div>
                    <div class="progress progress-sm active">
                      <div class="progress-bar progress-bar-'.$status.' progress-bar-striped" role="progressbar" aria-valuenow="'.number_format($persen,2).'" aria-valuemin="0" aria-valuemax="100" style="width: '.number_format($persen,2).'%">
                        <span class="sr-only">'.number_format($persen,2).'% Complete</span>
                      </div>
                    </div>';
            }
          } else {
            $persen = ($row[7] / $d) * 100;
            if ($persen < 50) {
              $status = 'danger';
            }elseif ($persen < 80) {
              $status = 'warning';
            }elseif ($persen <= 100) {
              $status = 'success';
            }
            return '<div class="pull-right">&nbsp;<span class="label label-'.$status.'">'.number_format($persen,2).'%</span></div>
                    <div class="progress progress-sm active">
                      <div class="progress-bar progress-bar-'.$status.' progress-bar-striped" role="progressbar" aria-valuenow="'.number_format($persen,2).'" aria-valuemin="0" aria-valuemax="100" style="width: '.number_format($persen,2).'%">
                        <span class="sr-only">'.number_format($persen,2).'% Complete</span>
                      </div>
                    </div>';
          }
        }),
        array( 'db' => '(SELECT SUM(rabview.volume) from rabview 
                        where rabview.kdprogram = rkakl_full.KDPROGRAM 
                        and rabview.kdgiat = rkakl_full.KDGIAT 
                        and rabview.kdoutput = rkakl_full.KDOUTPUT 
                        and CASE when rabview.kdsoutput is not null then rabview.kdsoutput = rkakl_full.KDSOUTPUT ELSE TRUE END
                        and CASE when rabview.kdkmpnen is not null then rabview.kdkmpnen = rkakl_full.KDKMPNEN ELSE TRUE END 
                        and CASE when rabview.kdskmpnen is not null then rabview.kdskmpnen = rkakl_full.KDSKMPNEN ELSE TRUE END 
                      limit 1)', 'dt' => 9, 'formatter' => function($d,$row){
          if(is_null($row[9])){
            if(is_null($row[19])){
              return 0;
            }
            else {
              return number_format($row[19]);  
            }
          } else {
            return number_format($row[9]);
          }  
        }),
        array( 'db' => 'SATKEG','dt' => 10, 'formatter' => function($d,$row){
          if(is_null($row[17]) && is_null($row[9])){
            if (is_null($row[17]) && is_null($row[19])) {
              return '<div class="pull-right">&nbsp;<span class="label label-danger"> 0 %</span></div>';
            }
            else {
              $persen = ($row[19] / $row[17]) * 100;
              if ($persen < 50) {
                $status = 'danger';
              }elseif ($persen < 80) {
                $status = 'warning';
              }elseif ($persen <= 100) {
                $status = 'success';
              }
              return '<div class="pull-right">&nbsp;<span class="label label-'.$status.'">'.number_format($persen,2).'%</span></div>
                      <div class="progress progress-sm active">
                        <div class="progress-bar progress-bar-'.$status.' progress-bar-striped" role="progressbar" aria-valuenow="'.number_format($persen,2).'" aria-valuemin="0" aria-valuemax="100" style="width: '.number_format($persen,2).'%">
                          <span class="sr-only">'.number_format($persen,2).'% Complete</span>
                        </div>
                      </div>';
            }
          } elseif(is_null($row[17]) && !is_null($row[9])){
            $persen = ($row[9] / $row[17]) * 100;
            if ($persen < 50) {
              $status = 'danger';
            }elseif ($persen < 80) {
              $status = 'warning';
            }elseif ($persen <= 100) {
              $status = 'success';
            }
            return '<div class="pull-right">&nbsp;<span class="label label-'.$status.'">'.number_format($persen,2).'%</span></div>
                    <div class="progress progress-sm active">
                      <div class="progress-bar progress-bar-'.$status.' progress-bar-striped" role="progressbar" aria-valuenow="'.number_format($persen,2).'" aria-valuemin="0" aria-valuemax="100" style="width: '.number_format($persen,2).'%">
                        <span class="sr-only">'.number_format($persen,2).'% Complete</span>
                      </div>
                    </div>';
          } else {
            $persen = ($row[19] / $row[17]) * 100;
            if ($persen < 50) {
              $status = 'danger';
            }elseif ($persen < 80) {
              $status = 'warning';
            }elseif ($persen <= 100) {
              $status = 'success';
            }
            return '<div class="pull-right">&nbsp;<span class="label label-'.$status.'">'.number_format($persen,2).'%</span></div>
                    <div class="progress progress-sm active">
                      <div class="progress-bar progress-bar-'.$status.' progress-bar-striped" role="progressbar" aria-valuenow="'.number_format($persen,2).'" aria-valuemin="0" aria-valuemax="100" style="width: '.number_format($persen,2).'%">
                        <span class="sr-only">'.number_format($persen,2).'% Complete</span>
                      </div>
                    </div>';
          }
          // return '$a';
        }),
        array( 'db' => 'KDOUTPUT','dt' => 11, 'formatter' => function($d,$row){
          if(is_null($row[7])){
            if (is_null($row[18])) {
              return 0;
            }
            else {
              $sisa = $row[6] - $row[18];
              return number_format($sisa,2,',','.');  
            }
          } else {
            $sisa = $row[6] - $row[7];
            return number_format($sisa,2,',','.');
          }
          // return '$a';
        }),
        array( 'db' => 'KDOUTPUT',      'dt' => 12, 'formatter' => function($d,$row, $dataArray){
          $button = '<div class="col-md-12">';
          $button .= '<a href="'.$dataArray['url_rewrite'].'content/kegiatan-rinci/'.$row[16].'" class="btn btn-flat btn-primary btn-sm col-md-12" ><i class="fa fa-plus"></i>&nbsp; Tambah Kegiatan</a>';
          $button .= '<a id="btn-vol" href="#mdl-vol" class="btn btn-flat btn-warning btn-sm col-md-12" data-toggle="modal"><i class="fa fa-pencil"></i>&nbsp; Edit Volume</a>';
          $button .='</div>';
          return $button;
        }),

        //kode
        array( 'db' => 'KDSOUTPUT',      'dt' => 13),
        array( 'db' => 'KDKMPNEN',      'dt' => 14),
        array( 'db' => 'KDSKMPNEN',      'dt' => 15),
        array( 'db' => 'IDRKAKL',      'dt' => 16),
        array( 'db' => 'VOLKEG',      'dt' => 17),
        array( 'db' => '(SELECT SUM(rabview.jumlah) from rabview 
                        where rabview.kdprogram = rkakl_full.KDPROGRAM 
                        and rabview.kdgiat = rkakl_full.KDGIAT 
                        and rabview.kdoutput = rkakl_full.KDOUTPUT 
                        and CASE when rabview.kdsoutput is not null then rabview.kdsoutput = rkakl_full.KDSOUTPUT ELSE TRUE END
                        and CASE when rabview.kdkmpnen is not null then rabview.kdkmpnen = rkakl_full.KDKMPNEN ELSE TRUE END
                      limit 1)', 'dt' => 18, 'formatter' => function($d,$row){
          if(is_null($row[18])){
            return 0;
          } else {
            return number_format($row[18],0,".",".");
          }
        }),
        array( 'db' => '(SELECT SUM(rabview.volume) from rabview 
                        where rabview.kdprogram = rkakl_full.KDPROGRAM 
                        and rabview.kdgiat = rkakl_full.KDGIAT 
                        and rabview.kdoutput = rkakl_full.KDOUTPUT 
                        and CASE when rabview.kdsoutput is not null then rabview.kdsoutput = rkakl_full.KDSOUTPUT ELSE TRUE END
                        and CASE when rabview.kdkmpnen is not null then rabview.kdkmpnen = rkakl_full.KDKMPNEN ELSE TRUE END
                      limit 1)', 'dt' => 19, 'formatter' => function($d,$row){
          if(is_null($row[19])){
            return 0;
          } else {
            return number_format($row[19]);
          }
        }),
      );
      $where=" KDAKUN is not null AND (KDITEM is not null and NMITEM not like '>%') ";
      // if ($tahun != "") {
      //   $where = 'thang = "'.$tahun.'"';
      // }
      if ($direktorat != "") {
        if ($where == "") {
          $where .= 'KDGIAT = "'.$direktorat.'"';
        }else{
          $where .= 'AND KDGIAT = "'.$direktorat.'"';
        }
      }
      $group='KDGIAT, KDOUTPUT, KDSOUTPUT, KDKMPNEN, KDSKMPNEN';
      $order="ORDER BY KDGIAT ASC";
      $datatable->get_table_group($table, $key, $column, $where, $group, $dataArray, $order);
    break;
  case 'table-kegiatan':
    $table = "rabview";
    $key   = "id";
    $dataArray['url_rewrite'] = $url_rewrite; 
    $tahun = $_POST['tahun'];
    if ($_SESSION['direktorat'] == "") {
      $direktorat = $_POST['direktorat'];
    }else{
      $direktorat = $_SESSION['direktorat'];
    }
    $kdoutput = $_POST['kdoutput'];
    $kdsoutput = $_POST['kdsoutput'];
    $kdkmpnen = $_POST['kdkmpnen'];
    $kdskmpnen = $_POST['kdskmpnen'];

    $column = array(
      array( 'db' => 'id',      'dt' => 0 ),
      array( 'db' => 'deskripsi',  'dt' => 1),
      array( 'db' => 'tanggal',  'dt' => 2, 'formatter' => function( $d, $row ) {
        $arrbulan = array(
                '01'=>"Januari",
                '02'=>"Februari",
                '03'=>"Maret",
                '04'=>"April",
                '05'=>"Mei",
                '06'=>"Juni",
                '07'=>"Juli",
                '08'=>"Agustus",
                '09'=>"September",
                '10'=>"Oktober",
                '11'=>"November",
                '12'=>"Desember",
        );
        $pecahtgl1 = explode("-", $d);
        $tglawal = $pecahtgl1[2].' '.$arrbulan[$pecahtgl1[1]].' '.$pecahtgl1[0];
        $pecahtgl2 = explode("-", $row[15]);
        $tglakhir = $pecahtgl2[2].' '.$arrbulan[$pecahtgl2[1]].' '.$pecahtgl2[0];
        return $tglawal.' - '.$tglakhir;
      }),
      array( 'db' => 'lokasi',  'dt' => 3, 'formatter' => function($d,$row){
        return $row[14].', '.$d;
      }),
      array( 'db' => 'jumlah','dt' => 4, 'formatter' => function($d,$row){
        return 'Rp '.number_format($d,2,',','.');
      }),
      array( 'db' => 'status', 'dt' => 5, 'formatter' => function($d,$row){ 
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
      array( 'db' => 'status',  'dt' => 6, 'formatter' => function($d,$row, $dataArray){ 
        $button = '<div class="col-md-12">';
        if($_SESSION['level'] != 0 && ($d == 1 || $d == 4)){
          $button .= '<a id="btn-trans" href="'.$dataArray['url_rewrite'].'content/rab/edit/'.$row[0].'" class="btn btn-flat btn-warning btn-sm col-md-6" ><i class="fa fa-pencil"></i>&nbsp; Edit</a>';
          $button .= '<a id="btn-del" href="#delete" class="btn btn-flat btn-danger btn-sm col-md-6" data-toggle="modal"><i class="fa fa-close"></i>&nbsp; Delete</a>';
        }
        elseif($_SESSION['level'] != 0 && $d == 0){
          $button .= '<a style="margin:1px 2px;" class="btn btn-flat btn-sm btn-default col-md-12"><i class="fa fa-warning"></i> No available</a>';
        }
        elseif($_SESSION['level'] == 0){
          $button .= '<a style="margin:1px 2px;" class="btn btn-flat btn-sm btn-default col-md-12"><i class="fa fa-warning"></i> No available</a>';
        }
        $button .= '</div>';
        return $button;
      }),
      array( 'db' => 'volume',  'dt' => 7, 'formatter' => function($d, $row, $dataArray){
        return $d.' '.$row[8];
      }),
      array( 'db' => 'satuan',  'dt' => 8),
      array( 'db' => 'kdoutput',  'dt' => 9),
      array( 'db' => 'kdsoutput',  'dt' => 10),
      array( 'db' => 'kdkmpnen',  'dt' => 11),
      array( 'db' => 'kdskmpnen',  'dt' => 12),
      array( 'db' => 'pesan',  'dt' => 13),
      array( 'db' => 'tempat',  'dt' => 14),
      array( 'db' => 'tanggal_akhir',  'dt' => 15),
    );
    $where="";
    if ($tahun != "") {
      $where = 'thang = "'.$tahun.'"';
    }
    if ($direktorat != "") {
      if ($where == "") {
        $where .= 'kdgiat = "'.$direktorat.'"';
      }else{
        $where .= 'AND kdgiat = "'.$direktorat.'"';
      }
    }
    if ($kdoutput != "") {
      if ($where == "") {
        $where .= 'kdoutput = "'.$kdoutput.'"';
      }else{
        $where .= 'AND kdoutput = "'.$kdoutput.'"';
      }
    }
    if ($kdsoutput != "") {
      if ($where == "") {
        $where .= 'kdsoutput = "'.$kdsoutput.'"';
      }else{
        $where .= 'AND kdsoutput = "'.$kdsoutput.'"';
      }
    }
    if ($kdkmpnen != "") {
      if ($where == "") {
        $where .= 'kdkmpnen = "'.$kdkmpnen.'"';
      }else{
        $where .= 'AND kdkmpnen = "'.$kdkmpnen.'"';
      }
    }
    if ($kdskmpnen != "") {
      if ($where == "") {
        $where .= 'kdskmpnen = "'.$kdskmpnen.'"';
      }else{
        $where .= 'AND kdskmpnen = "'.$kdskmpnen.'"';
      }
    }
    $group='';
    $datatable->get_table_group($table, $key, $column,$where,$group,$dataArray);
    break;
  case 'getnpwp':
    $jenis = $data[3];
    $npwp = $mdl_rab->getnpwp($jenis);
    echo json_encode($npwp);
    break;
  case 'getout':
    $output = $rab->getout($_POST['prog'],$_POST['tahun'],$_POST['direktorat']);
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
    $rab->save($_POST);
    $flash  = array(
          'category' => "success",
          'messages' => "Data Kegiatan berhasil ditambahkan"
        );
        $utility->location("content/kegiatan-rinci/".$idrkakl,$flash);
    break;
  case 'edit':
    $mdl_rab->edit($_POST);
    $utility->load("content/rab","success","Data RAB berhasil diubah");
    break;
  case 'ajukan':
    $id_rabview = $_POST['id_rab_aju'];
    $akun = $mdl_rab->getakun($id_rabview);
    $error = false;
    for ($i=0; $i < count($akun); $i++) { 
      if ($akun[$i]->kdakun == "") {  //kode akun kosong
        $error = '2';
        $kderror[$i] = $akun[$i]->kdakun;
      }
    }
    if (!$error) {
      $status = '1';
      $mdl_rab->chstatus($id_rabview, $status);
      $utility->load("content/rab","success","Data RAB telah diajukan ke Bendahara Pengeluaran");
    }else{
      $kodeError = implode(", ", $kderror);
      if ($error == 1) {
        $utility->load("content/rab","warning","Proses tidak dilanjutkan. Kode Akun ".$kodeError." melebihi Pagu");
      }else{
        $utility->load("content/rab","error","Proses tidak dilanjutkan. Terdapat data yang kosong");
      }
    }
    break;
  case 'sahkan':
    $id_rabview = $_POST['id_rab_sah'];
    $akun = $mdl_rab->getakun($id_rabview);
    for ($i=0; $i < count($akun); $i++) { 
      if ($akun[$i]->kdakun == 521211) {  //belanja bahan
        $rab = $mdl_rab->getRabItem($akun[$i]);
        for ($j=0; $j < count($rab); $j++) { 
          $jum_rkakl = $mdl_rab->getJumRkakl($akun[$i], $rab[$j]);
          $realisasi = $jum_rkakl->realisasi;
          $usulan = $jum_rkakl->usulan;
          $total = $realisasi + $usulan;
          $item = $rab[$j]->noitem;
          $mdl_rab->moveRealisasi($akun[$i], $item, $total);
        }
      }elseif($akun[$i]->kdakun != ""){  // bukan belanja bahan
        $jum_rkakl = $mdl_rab->getJumRkakl($akun[$i]);
        $item = $jum_rkakl->noitem;
        $pecah_item = explode(",", $item);
        $banyakitem = count($pecah_item);

        for ($x=0; $x < $banyakitem; $x++) { 
          $nilai = $mdl_rab->getRealUsul($akun[$i], $pecah_item[$x]);
          $total = $nilai->realisasi + $nilai->usulan;
          $mdl_rab->moveRealisasi($akun[$i], $pecah_item[$x], $total);
        }
      }
    }
    $status = '2';
    $mdl_rab->chstatus($id_rabview, $status);
    $utility->load("content/rab","success","Data RAB telah disahkan");
    break;
  case 'revisi':
    $id_rabview = $_POST['id_rab_rev'];
    $status = '3';
    $pesan = $_POST['pesan'];
    $mdl_rab->chstatus($id_rabview, $status);
    $mdl_rab->pesanrevisi($id_rabview, $pesan);
    $utility->load("content/rab","success","Data RAB direvisi");
    break;
  case 'delete':
    $id_rabview = $_POST['id_rab_del'];
    $akun = $mdl_rab->getakun($id_rabview);
    $mdl_rab->deleterab($id_rabview);
    $utility->load("content/rab","success","Data RAB telah dihapus");
    break;
  default:
    $utility->location_goto(".");
  break;
}
?>
