<?php 
	switch ($link[3]) {
    case 'add':
      $data = $purifier->purifyArray($_POST);
      $result = $triwulan->cekTriwulan($data);
      if ($result == 0) {
        $triwulan->addTriwulan($data);
        $flash  = array(
          'category' => "success",
          'messages' => "Data Triwulan berhasil ditambahkan"
        );
        $utility->location("content/triwulan",$flash);
      }
      else {
        $flash  = array(
          'category' => "warning",
          'messages' => "Maaf Data Triwulan sudah ada"
        );
        $utility->location("content/triwulan",$flash);
      }
    break;
    case 'table':
      $table      = "triwulan";
      $primaryKey = "id";
      $columns    = array(
        array( 'db' => 'id',         'dt' => 0 ),
        array( 'db' => 'nama',       'dt' => 2 ),
        array( 'db' => 'start_date', 'dt' => 3, 'formatter' => function( $d, $row ) {
          $arrbulan = array(
                  '01'=>"Januari", '02'=>"Februari", '03'=>"Maret", '04'=>"April", '05'=>"Mei", '06'=>"Juni",
                  '07'=>"Juli", '08'=>"Agustus", '09'=>"September", '10'=>"Oktober", '11'=>"November", '12'=>"Desember",
          );
          $pecahtgl = explode("-", $d);
          $tanggal = $pecahtgl[2].' '.$arrbulan[$pecahtgl[1]].' '.$pecahtgl[0];
          return $tanggal;
        }),
        array( 'db' => 'end_date',   'dt' => 4, 'formatter' => function( $d, $row ) {
          $arrbulan = array(
                  '01'=>"Januari", '02'=>"Februari", '03'=>"Maret", '04'=>"April", '05'=>"Mei", '06'=>"Juni",
                  '07'=>"Juli", '08'=>"Agustus", '09'=>"September", '10'=>"Oktober", '11'=>"November", '12'=>"Desember",
          );
          $pecahtgl = explode("-", $d);
          $tanggal = $pecahtgl[2].' '.$arrbulan[$pecahtgl[1]].' '.$pecahtgl[0];
          return $tanggal;
        }),
        array( 'db' => 'status',     'dt' => 5, 'formatter' => function( $d, $row ) {
          if ($d == 0) {
            return '<div class="label label-danger"><i class="fa fa-check-circle"></i> Tidak Aktif</div>';
          }
          else {
            return '<div class="label label-success"><i class="fa fa-warning"></i> Sedang Aktif</div>';
          }
        }),
        array( 'db' => 'status',     'dt' => 6, 'formatter' => function( $d, $row ) {
          if ($d == 0) {
            return '<div class="label label-danger"><i class="fa fa-check-circle"></i> Tidak Aktif</div>';
          }
          else {
            return '<div class="label label-success"><i class="fa fa-warning"></i> Sedang Aktif</div>';
          }
        }),
      );
      $datatable->get_rkakl_view($table, $primaryKey, $columns);
    break;
    case 'table2':
      $table      = "rkakl_full";
      $primaryKey = "idrkakl";
      $columns    = array(
        array( 'db' => 'idrkakl',    'dt' => 0 ),
        array( 'db' => 'kdgiat',     'dt' => 2 ),
        array( 'db' => 'nmgiat',     'dt' => 3 ),
        array( 'db' => '(SELECT rabview.STATUS FROM rabview WHERE rkakl_full.kdgiat = rabview.kdgiat)',   'dt' => 4, 'formatter' => function( $d, $row ) {
          if ($d == 1) {
            return '<div class="label label-success col-md-12"><i class="fa fa-check-circle"></i> Active</div>';
          }
          elseif ($d == 2) {
            return '<div class="label label-warning col-md-12"><i class="fa fa-warning"></i> Revised</div>';
          }
          elseif ($d != '') {
            return '<div class="label label-danger col-md-12"><i class="fa fa-check-circle"></i> Locked</div>';
          }
          else {
            return '<div class="label label-default col-md-12"><i class="fa fa-warning"></i> Not Available</div>';
          }
        }),
        array( 'db' => 'status',     'dt' => 5, 'formatter' => function( $d, $row ) {
          if ($row[3] == 1) {
            return '<a style="margin:1px 2px;" id="btn-viw" class="btn btn-flat btn-danger btn-xs col-md-12"><i class="fa fa-warning"></i> Lock</a>';
          }
          elseif ($row[3] == 2) {
            return '<a style="margin:1px 2px;" id="btn-viw" class="btn btn-flat btn-danger btn-xs col-md-12"><i class="fa fa-warning"></i> Lock</a>';
          }
          elseif ($row[3] != '') {
            return '<a style="margin:1px 2px;" id="btn-viw" class="btn btn-flat btn-warning btn-xs col-md-12"><i class="fa fa-warning"></i> Revise</a>';
          }
          else {
            return '<div class="label label-default col-md-12"><i class="fa fa-warning"></i> Not Available</div>';
          }
        })
      );
      $where="KDGIAT IS NOT NULL AND KDOUTPUT IS NULL AND KDSOUTPUT IS NULL AND KDKMPNEN IS NULL AND KDSKMPNEN IS NULL AND KDSKMPNEN IS NULL AND KDAKUN IS NULL AND KDITEM IS NULL";
      $datatable->get_table_group($table, $primaryKey, $columns, $where);
    break;
    default:
      $utility->location("content/triwulan");
    break;
	}
?>