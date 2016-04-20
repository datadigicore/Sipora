<?php 
	switch ($link[3]) {
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
        array( 'db' => 'end_date',   'dt' => 4, 'formatter' => function( $d, $row ) {
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
        array( 'db' => 'status',     'dt' => 5, 'formatter' => function( $d, $row ) {
          if ($d == 1) {
            return '<div class="label label-success col-md-12"><i class="fa fa-warning"></i> Sedang Aktif</div>';
          }
          else {
            return '<div class="label label-danger col-md-12"><i class="fa fa-check-circle"></i> Tidak Aktif</div>';
          }
        }),
        array( 'db' => 'status',     'dt' => 6, 'formatter' => function( $d, $row ) {
          if ($d == 0) {
            return '<a style="margin:1px 2px;" id="btn-unl" class="btn btn-flat btn-warning btn-xs col-md-12"><i class="fa fa-check-circle"></i> Unlock</a>';
          }
          elseif ($d == 1) {
            return '<a style="margin:1px 2px;" id="btn-non" class="btn btn-flat btn-danger btn-xs col-md-12"><i class="fa fa-warning"></i> Non aktif</a>';
          }
          elseif ($d == 2) {
            return '<a style="margin:1px 2px;" id="btn-act" class="btn btn-flat btn-success btn-xs col-md-12"><i class="fa fa-warning"></i> Aktifkan</a>';
          }
          else {
            return '<a style="margin:1px 2px;" class="btn btn-flat btn-default btn-xs col-md-12"><i class="fa fa-warning"></i> No available</a>';
          }
        })
      );
      $datatable->get_rkakl_view($table, $primaryKey, $columns);
    break;
    default:
      $utility->location("content/triwulan");
    break;
	}
?>