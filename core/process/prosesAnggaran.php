<?php 
	switch ($link[3]) {
    case 'programkementerian':
      switch ($link[4]) {
        case 'table':
          $table      = "main_program_pusat";
          $primaryKey = "id_program_pusat";
          $columns = array(
            array( 'db' => 'id_program_pusat', 'dt' => 0 ),
            array( 'db' => 'kode_program',     'dt' => 2 ),
            array( 'db' => 'nama_program',     'dt' => 3 ),
            array( 'db' => 'pagu_anggaran',    'dt' => 4, 'formatter' => function($d,$row){return 'Rp. '.number_format($d,2,",",".");} ),
            array( 'db' => 'tahun_anggaran',   'dt' => 5 )
          );
          $datatable->get_table($table, $primaryKey, $columns, $join, $where, $group, $order);
        break;
        default:
          $utility->location("content/import");
        break;
      }
    break;
    case 'perunitkerja':
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
                return "<img src='../../static/img/blank.png' width='16'><img src='../../static/img/enter.gif' width='16'> ".$d;
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
    case 'programdekon':
      switch ($link[4]) {
        case 'table':
          $table      = "program_dekon";
          $primaryKey = "id_program_dekon";
          $columns = array(
            array( 'db' => 't1.id_program_dekon', 'dt' => 0 ),
            array( 'db' => 't1.kode_kegiatan',    'dt' => 2 ),
            array( 'db' => 't1.program_kegiatan', 'dt' => 3 ),
            array( 'db' => 't2.title',            'dt' => 4 ),
            array( 'db' => 't1.anggaran',         'dt' => 5, 'formatter' => function($d,$row){return 'Rp. '.number_format($d,2,",",".");} ),
            array( 'db' => 't1.tahun_anggaran',   'dt' => 6 )
          );
          $join = "FROM {$table} AS t1 LEFT JOIN strukturorganisasi AS t2 ON (t1.unit = t2.unit AND t1.sub_unit = t2.sub_unit AND t1.sub_subunit = t2.sub_subunit)";
          $where = 't1.status_delete = 0';
          $datatable->get_table($table, $primaryKey, $columns, $join, $where, $group, $order);
        break;
        default:
          $utility->location("content/import");
        break;
      }
    break;
    case 'dekonprovinsi':
      switch ($link[4]) {
        case 'table':
          $table      = "program_dekon";
          $primaryKey = "id_program_dekon";
          $columns = array(
            array( 'db' => 't1.id_program_dekon', 'dt' => 0 ),
            array( 'db' => 't1.kode_kegiatan',    'dt' => 2 ),
            array( 'db' => 't1.program_kegiatan', 'dt' => 3 ),
            array( 'db' => 't2.title',            'dt' => 4 ),
            array( 'db' => 't1.anggaran',         'dt' => 5, 'formatter' => function($d,$row){return 'Rp. '.number_format($d,2,",",".");} ),
            array( 'db' => 't1.tahun_anggaran',   'dt' => 6 )
          );
          $join = "FROM {$table} AS t1 LEFT JOIN strukturorganisasi AS t2 ON (t1.unit = t2.unit AND t1.sub_unit = t2.sub_unit AND t1.sub_subunit = t2.sub_subunit)";
          $where = 't1.status_delete = 0';
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