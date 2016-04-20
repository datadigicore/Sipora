<?php 
	switch ($link[3]) {
    case 'pusat':
      switch ($link[4]) {
        case 'table':
          $row        = $evaluasi->readIdStruktur();
          $table      = "main_program_pusat";
          $primaryKey = "id_program_pusat";
          $columns = array(
            array( 'db' => 't1.id_program_pusat', 'dt' => 0, 'field' => 'id_program_pusat' ),
            array( 'db' => 't1.kode_program',     'dt' => 2, 'field' => 'kode_program', 'formatter' => function($d,$row){return '0'.$d;} ),
            array( 'db' => 't1.nama_program',     'dt' => 3, 'field' => 'nama_program' ),
            array( 'db' => 't2.kode_kegiatan',    'dt' => 4, 'field' => 'kode_kegiatan' ),
            array( 'db' => 't2.nama_kegiatan',    'dt' => 5, 'field' => 'nama_kegiatan' ),
            array( 'db' => 't2.tahun_anggaran',   'dt' => 6, 'field' => '' ),
            array( 'db' => 't2.pagu_anggaran',    'dt' => 7, 'field' => 'pagu_anggaran', 'formatter' => function($d,$row){return 'Rp. '.number_format($d,2,",",".");} ),
            array( 'db' => 't2.tahun_anggaran',   'dt' => 8, 'field' => '', 'formatter' => function($d,$row){return 'Rp. '.number_format($d,2,",",".");} ),
            array( 'db' => 't2.tahun_anggaran',   'dt' => 9, 'field' => 'tahun_anggaran' ),
            array( 'db' => 't2.tahun_anggaran',   'dt' => 10, 'field' => '' ),
            array( 'db' => 't2.tahun_anggaran',   'dt' => 11, 'field' => '' ),
            array( 'db' => 't2.tahun_anggaran',   'dt' => 12, 'field' => '' )
          );
          $join = "FROM {$table} AS t1 INNER JOIN main_kegiatan_pusat AS t2";
          $where = 't1.status_delete = 0';
          $datatable->get_table($table, $primaryKey, $columns, $join, $where, $group, $order);
        break;
        default:
          $utility->location("content/import");
        break;
      }
    break;
    case 'dekon':
    	switch ($link[4]) {
        case 'table':
          $table      = "anggaran_kementerian";
          $primaryKey = "id_anggaran_kementerian";
          $columns = array(
            array( 'db' => 'id_anggaran_kementerian', 'dt' => 0 ),
            array( 'db' => 'sub_subunit',             'dt' => 1 ),
            array( 'db' => 'nama_unit',               'dt' => 2, 'formatter' => function($d,$row){
              if ($row['sub_subunit'] == 0) {
                return $d;
              }
              else {
                return "<img src='../static/img/blank.png' width='16'><img src='../static/img/enter.gif' width='16'> ".$d;
              }
            }),
            array( 'db' => 'pagu_anggaran',           'dt' => 3, 'formatter' => function($d,$row){return 'Rp. '.number_format($d,2,",",".");} ),
            array( 'db' => 'tahun_anggaran',          'dt' => 4 )
          );
          $order = 'unit,sub_unit,sub_subunit';
          $where = 'status_delete = 0';
          $datatable->get_table($table, $primaryKey, $columns, $join, $where, $group, $order);
        break;
        default:
          $utility->location("content/import");
        break;
      }
    break;
    default:
      $utility->location("content/import");
    break;
	}
?>