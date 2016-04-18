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
        array( 'db' => 'start_date', 'dt' => 2 ),
        array( 'db' => 'end_date',   'dt' => 3 ),
        array( 'db' => 'status',     'dt' => 4),
      );
      $datatable->get_rkakl_view($table, $primaryKey, $columns);
    break;
    default:
      $utility->location("content/triwulan");
    break;
	}
?>