<?php 
	switch ($link[3]) {
    case 'create':
      echo "CREATE HERE";
    break;
    case 'table':
      $table      = "triwulan";
      $primaryKey = "id";
      $columns    = array(
        array( 'db' => 'id',         'dt' => 0 ),
        array( 'db' => 'nama',       'dt' => 1 ),
        array( 'db' => 'start_date', 'dt' => 2, 'formatter' => function( $d, $row ) {
          $arrbulan = array(
                  '01'=>"Januari", '02'=>"Februari", '03'=>"Maret", '04'=>"April", '05'=>"Mei", '06'=>"Juni",
                  '07'=>"Juli", '08'=>"Agustus", '09'=>"September", '10'=>"Oktober", '11'=>"November", '12'=>"Desember",
          );
          $pecahtgl = explode("-", $d);
          $tanggal = $pecahtgl[2].' '.$arrbulan[$pecahtgl[1]].' '.$pecahtgl[0];
          return $tanggal;
        }),
        array( 'db' => 'end_date',   'dt' => 3, 'formatter' => function( $d, $row ) {
          $arrbulan = array(
                  '01'=>"Januari", '02'=>"Februari", '03'=>"Maret", '04'=>"April", '05'=>"Mei", '06'=>"Juni",
                  '07'=>"Juli", '08'=>"Agustus", '09'=>"September", '10'=>"Oktober", '11'=>"November", '12'=>"Desember",
          );
          $pecahtgl = explode("-", $d);
          $tanggal = $pecahtgl[2].' '.$arrbulan[$pecahtgl[1]].' '.$pecahtgl[0];
          return $tanggal;
        }),
        array( 'db' => 'status',     'dt' => 4, 'formatter' => function( $d, $row ) {
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
    default:
      $utility->location("content/triwulan");
    break;
	}
?>