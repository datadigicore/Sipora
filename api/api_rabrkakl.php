<?php
include '../config/application.php';
echo json_encode("value");
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
/* Array of database columns which should be read and sent back to DataTables. Use a space where
 * you want to insert a non-database field (for example a counter or static image)
 */
$aColumns = array('IDRKAKL','KDGIAT','NMGIAT','KDOUTPUT','NMOUTPUT','KDSOUTPUT','NMSOUTPUT','KDKMPNEN','NMKMPNEN','KDSKMPNEN','NMSKMPNEN');
$aColumnsHaving =array('IDRKAKL');
/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "IDRKAKL";
/* DB table to use */
$sTable = "rkakl_full as r";
$select=$_GET['select'];
$keyword=$_GET['keyword'];
$direktorat=$_GET['direktorat'];

// $universitas=$_GET['universitas'];
// $major=$_GET["major"];
// $faculty=$_GET["faculty"];
// $kategori=$_GET["kategori"];
// $type=$_GET["type"];
// $nomor=$_GET["nomor"];
// //$document=$_GET["document"];
// $sWhere = "";
// $sHaving = "";
// $level=$_SESSION["level"];
// $universitas_session=trim($_SESSION['unversitas']);
// $username_session=$_SESSION["user_name$ID"] ;
// if($level==0||$level==4){
//   $sWhere="";
// }else if($level==2){
//   $sWhere="Where U.kodeUniversitas='$universitas_session' ";
// }else if($level==3){
//   $sWhere="Where idmahasiswa='$username_session' ";
// }
// if($status!=""){
//   $sWhere="Where idstatus ='$status' ";
// }
// if($keyword!=""){
//   if($sWhere!="")
//     $sWhere.=" and namamahasiswa like '%$keyword%' ";
//   else
//     $sWhere="Where namamahasiswa like '%$keyword%' ";
// }
// if($major!=""){
//   if($sWhere!="")
//     $sWhere.=" and idjurusan='$major' ";
//   else
//     $sWhere="Where idjurusan = '$universitas' ";
// }
// if($faculty!=""){
//   if($sWhere!="")
//     $sWhere.=" and idfakultas='$faculty' ";
//   else
//     $sWhere="Where idfakultas= '$faculty' ";
// }
// if($kategori!=""){
//   if($sHaving!="")
//     $sHaving.=" and jenis_izin='$kategori' ";
//   else
//     $sHaving="having jenis_izin= '$kategori' ";
// }
// if($type!=""){
//   if($sWhere!="")
//     $sWhere.=" and ekstension='$type' ";
//   else
//     $sWhere="Where ekstension= '$type' ";
// }
// if($nomor!=""){
//   if($sWhere!="")
//     $sWhere.=" and nomor='$nomor' ";
//   else
//     $sWhere="Where nomor= '$nomor' ";
// }
/*
if($document!=""){
     if($sWhere!="")
          $sWhere.=" and ekstension='$document' ";
     else
     $sWhere="Where ekstension= '$document' ";
}*/
/*
 * Paging
 */
$sLimit = "";
if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
  $sLimit = "LIMIT " . intval($_GET['iDisplayStart']) . ", " .intval($_GET['iDisplayLength']);
}
/*
 * Ordering
 */
$sOrder = "";
if (isset($_GET['iSortCol_0'])) {
     $sOrder = "ORDER BY  ";
     for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
          if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
               //$sOrder .= "'" . $aColumns[intval($_GET['iSortCol_' . $i])] . "' " .
               $sOrder .= "" . $aColumns[intval($_GET['iSortCol_' . $i])] . " " .
                       ($_GET['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
          }
     }
     $sOrder = substr_replace($sOrder, "", -2);
     if ($sOrder == "ORDER BY") {
          $sOrder = "";
     }
}
// echo $sOrder;
/*
 * Filtering
 * NOTE this does not match the built-in DataTables filtering which does it
 * word by word on any field. It's possible to do here, but concerned about efficiency
 * on very large tables, and MySQL's regex functionality is very limited
 */
//$sWhere = "";
if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
     $sWhere = "WHERE (";
     for ($i = 0; $i < count($aColumns); $i++) {
        if(!in_array($aColumns[$i], $aColumnsHaving)){
          if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true") {
               $sWhere .= "" . $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
          }
        }
     }
     $sWhere = substr_replace($sWhere, "", -3);
     $sWhere .= ')';
}
// if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
//      $sHaving = "HAVING (";
//      for ($i = 0; $i < count($aColumnsHaving); $i++) {
//           if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true") {
//                $sHaving .= "`" . $aColumnsHaving[$i] . "` LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
//           }
//      }
//      $sHaving = substr_replace($sHaving, "", -3);
//      $sHaving .= ')';
// }
/* Individual column filtering */
for ($i = 0; $i < count($aColumns); $i++) {
     if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
          if ($sWhere == "") {
               $sWhere = "WHERE ";
          } else {
               $sWhere .= " AND ";
          }
          $sWhere .= "`" . $aColumns[$i] . "` LIKE '%" . mysql_real_escape_string($_GET['sSearch_' . $i]) . "%' ";
     }
}
/*
 * SQL queries
 * Get data to display
 */
/*
$sQuery ="select SQL_CALC_FOUND_ROWS M.namamahasiswa as namamahasiswa,
                    M.namamahasiswa2 as namamahasiswa,
                    U.namauniversitas as namauniversitas,
                    I.status_idstatus as status_idstatus,
               M.alamat as alamat , M.kode as kode
               from mahasiswa M left  join  ijin I on I.mahasiswa_idmahasiswa=M.idmahasiswa
               left join universitas U on U.iduniversitas=M.universitas_iduniversitas
                $sWhere
  $sOrder
  $sLimit
       " ;*/
$query="SELECT `id`, `thang`, `kdprogram`, `kdgiat`, `kdoutput`, `kdsoutput`, `kdkmpnen`, `kdskmpnen`, `deskripsi`, `tanggal`, `tanggal_akhir`, `tempat`, `lokasi`, `volume`, `satuan`, `jumlah`, `status`, `created_at`, `created_by`, `idtriwulan` FROM `rabview` " ;

$result=$db->_fetch_array($query,1);
$rabview =array();
$key_stack=array();

foreach ($result as $key => $value) {
  $id=$value['id'];
  $thang=$value['thang'];
  $kdprogram=$value['kdprogram'];
  $kdgiat=$value['kdgiat'];
  $kdoutput=$value['kdoutput'];
  $kdsoutput=$value['kdsoutput'];
  $kdkmpnen=$value['kdkmpnen'];
  $kdskmpnen=$value['kdskmpnen'];
  $jumlah=$value['jumlah'];
  $key="$kdprogram-$kdgiat-$kdoutput-$kdsoutput-$kdkmpnen-$kdskmpnen";
  $key_stack[]=$key;
  $rabview["$kdprogram-$kdgiat-$kdoutput-$kdsoutput-$kdkmpnen-$kdskmpnen"]['key']=$key;
  $rabview["$kdprogram-$kdgiat-$kdoutput-$kdsoutput-$kdkmpnen-$kdskmpnen"]['jumlah'] += $jumlah;
}
// $sQuery="select I.nomor,S.*,M.kode,M.tgl_update,
//                M.namamahasiswa as namamahasiswa ,M.idmahasiswa,M.tot_ekstension,M.LamaIjin,M.kategori_institusi,M.nama_sekolah,M.nama_institusi,M.universitas_iduniversitas as universitas_iduniversitas,
//                I.status_idstatus as status_idstatus  ,M.ekstension as ekstension , '' as tempat_kerja, M.alamat as alamat, '0' as jenis_izin
//                from mahasiswa M left  join  ijin I on I.mahasiswa_idmahasiswa=M.idmahasiswa
//                left join status S on S.idstatus=I.status_idstatus $sWhere $sHaving
//                union
//                select I.nomor,S.*,M.kode,M.tgl_update,
//                M.namamahasiswa as namamahasiswa ,M.idmahasiswa,M.tot_ekstension,M.LamaIjin,M.kategori_institusi,M.nama_sekolah,M.nama_institusi,M.universitas_iduniversitas as universitas_iduniversitas,
//                I.status_idstatus as status_idstatus  ,M.ekstension as ekstension ,M.nama_tempat_kerja as tempat_kerja, M.alamat as alamat, '1' as jenis_izin
//                from pekerja M left  join  ijin I on I.mahasiswa_idmahasiswa=M.idmahasiswa
//                left join status S on S.idstatus=I.status_idstatus
//                 $sWhere $sHaving $sOrder $sLimit";
$sQuery="SELECT IDRKAKL, KDDEPT,KDUNIT, KDPROGRAM, KDGIAT, KDOUTPUT, KDSOUTPUT, KDKMPNEN, KDSKMPNEN, NMGIAT, NMOUTPUT, NMSOUTPUT, NMKMPNEN, NMSKMPNEN, VOLKEG, SATKEG, JUMLAH 
        from rkakl_full group by  KDDEPT,KDUNIT, KDPROGRAM, KDGIAT, KDOUTPUT, KDSOUTPUT, KDKMPNEN, KDSKMPNEN ORDER BY IDRKAKL ASC";
$rResult = $DB->query($sQuery);
/* Data set length after filtering */
$sQuery = "
    SELECT FOUND_ROWS()
  ";
$rResultFilterTotal = $DB->query($sQuery);
$aResultFilterTotal = $DB->fetch_array($rResultFilterTotal);
$iFilteredTotal = $aResultFilterTotal[0];
/* Total data set length */
$sQuery = "
    SELECT COUNT(`" . $sIndexColumn . "`)
    FROM   $sTable
  ";
$rResultTotal = $DB->query($sQuery);
$aResultTotal = $DB->fetch_array($rResultTotal);
$iTotal = $aResultTotal[0];
/*
 * Output
 */
$output = array(
    "sEcho" => intval($_GET['sEcho']),
    "iTotalRecords" => $iTotal,
    "iTotalDisplayRecords" => $iFilteredTotal,
    "aaData" => array()
);
//echo "<pre>";
while ($row = $DB->fetch_array($rResult)) {
     $row = array();
     //print_r($aRow);
     $jenis_izin =$aRow['jenis_izin'];
     $tempat_kerja = $aRow['tempat_kerja'];
     $id=$aRow['kode'];
     $idmhs=$aRow["idmahasiswa"];
     $nomorLOR = $aRow["nomor"];
     $namamahasiswa=$aRow["namamahasiswa"];
     $namamahasiswa2=$aRow["namamahasiswa2"];
     //$universitas=$aRow[""];
     $kategoriInstitusi=$aRow["kategori_institusi"];
     $namaInstitusi=$aRow["nama_institusi"];
     $namaSekolah=$aRow["nama_sekolah"];
     $status=$aRow["namastatus"];
     $id_status=$aRow["idstatus"];
     $alamat=$aRow["alamat"];
     $status_doc=$aRow["ekstension"];
    // $lamaijin=$aRow["LamaIjin"];
    // $tot_ekstension=$aRow["tot_ekstension"];
    //  $tgl_update=$UTILITY->format_tanggal_ind($aRow["tgl_update"]);
    //  if($status_doc==0)
    //       $text_doc="Baru";
    //  else
    //       $text_doc="Perpanjangan ";
    // $kunci=$aRow["kunci"];
    // $tgl_verifikasi_kampus=$UTILITY->format_tanggal_ind($aRow["tgl_verifikasi_kampus"]);
    // if($kunci!=1){
    //   if($status_doc==0){
    //     if($jenis_izin == '0'){
    //       $edit="<a href=\"$url_rewrite"."content/student/edit/$id \" class=\"btn btn-success btn-xs\" title=\"Edit\">Edit</a>";
    //     } else {
    //       $edit="<a href=\"$url_rewrite"."content/worker/edit/$id \" class=\"btn btn-success btn-xs\" title=\"Edit\">Edit</a>";
    //     }      
    //   }else {
    //     // if($jenis_izin == '0'){
    //     //   $edit="<a href=\"$url_rewrite"."content/ekstension/edit/$id \" class=\"btn btn-success btn-xs\" title=\"Edit\">Edit</a>";
    //     // }else{
    //     //   $edit="<a href=\"$url_rewrite"."content/worker-ekstension/edit/$id \" class=\"btn btn-success btn-xs\" title=\"Edit\">Edit</a>";
    //     // }
    //     $edit="";
    //   }
    //     $delete="<a href=\"#\" class=\"btn btn-danger btn-xs\" onClick=\"confirm_delete('$url_rewrite"."proses/student/hstudent/$id') \"title=\"Hapus\">Hapus</a>";
    // }else{
    //   $edit="<a href=\"$url_rewrite"."content/student/view/$id \" class=\"btn btn-success btn-xs\" title=\"View\">View</a>";
    //   $delete="";
    // }
    // $download="<a href=\"$url_rewrite"."zip/download/$id \" class=\"btn btn-success btn-xs\" title=\"Download\">Download Berkas</a>";
    // $ekstension="";
    // if($id_status=="4" and $tot_ekstension<4){
    //   if($jenis_izin == '0'){
    //     $ekstension="<a href=\"$url_rewrite"."content/ekstension/edit/$id \" class=\"btn btn-primary btn-xs\" title=\"Perpanjangan\">Perpanjangan</a>";
    //   } else {
    //     $ekstension="<a href=\"$url_rewrite"."content/worker-ekstension/edit/$id \" class=\"btn btn-primary btn-xs\" title=\"Perpanjangan\">Perpanjangan</a>";
      
    //   }
    // }
    
    //   $permit="<a href=\"$url_rewrite"."content/student/permit/$idmhs \" class=\"btn btn-info btn-xs\" title=\"Surat Unit Utama\">LOR</a>";
    // if($jenis_izin == '0'){
    // $verification="<a href=\"$url_rewrite"."content/permit/$id \" class=\"btn btn-warning btn-xs\" title=\"Verifikasi\">Verifikas</a>";
    // } else {
    //  $verification="<a href=\"$url_rewrite"."content/permit-worker/$id \" class=\"btn btn-warning btn-xs\" title=\"Verifikasi\">Verifikasi</a>"; 
    // }
    // $report= "<a  href=\"$url_rewrite"."content/report/report/$id\" class=\"btn btn-primary btn-xs\" title=\"Laporan\">Laporan</a>";
    // if($id_status==4||$id_status==3)
    //   $cetak_berkas="<a  href=\"$url_rewrite"."content/report/final/$id\" class=\"btn btn-primary btn-xs\" title=\"Cetak Laporan\">Cetak Laporan</a>";
    // else {
    //   $cetak_berkas="";
    // }
    // //$view="<a href=\"$url_rewrite"."content/student/view/$id \" class=\"btn btn-info btn-xs\" title=\"View\">Detail</a>";
    // if($jenis_izin == '0'){
    //       $view="<a href=\"$url_rewrite"."content/student/view/$id \" class=\"btn btn-info btn-xs\" title=\"Detail\">Detail</a>";
    //     } else {
    //       $view="<a href=\"$url_rewrite"."content/worker/view/$id \" class=\"btn btn-info btn-xs\" title=\"Detail\">Detail</a>";
    //     } 
    // if($select=="true"){
    //   $row[]="";
    //   $row[]=$idmhs;
    // }
    // if($jenis_izin=='0'){
    //   $row[]='<span class="label label-primary">Izin Belajar</span>';
    // } else if($jenis_izin=='1'){
    //   $row[]='<span class="label label-success">Izin Bekerja</span>';
    // } else {
    //   $row[]='';
    // }
    // if($nomorLOR!=""){
    //   $row[]="$nomorLOR";
    // } else {
    //   $row[]='<span class="label label-danger">Belum Ada</span>';
    // }
    // $row[]="$namamahasiswa $namamahasiswa2";
    // //$row[]="$alamat";
    // //$row[]="$universitas";
    // if($jenis_izin==0){
    //   if($kategoriInstitusi=="DIKDASMEN"){
    //     $row[]="$namaSekolah";
    //   } else if($kategoriInstitusi=="PAUD") {
    //     $row[]="$namaInstitusi";
    //   } else {
    //     $row[]='<span class="label label-danger">Belum Diisi</span>';
    //   }
    // } else if($jenis_izin==1){
    //     $row[]= "$tempat_kerja";
    // } else {
    //     $row[]='<span class="label label-danger">Belum Diisi</span>';
    // }
    // $row[]="$status";
    // $row[]="$text_doc";
    // $row[]="$tgl_update";
    // $row[]="$lamaijin";
    // $row[]='<div class="text-center">'.$tot_ekstension.' Kali</div>';
    
    // if($select!="true"){
    //   if($_SESSION["level$ID"]=="1")
    //     $row[] =$view." ".$edit." ".$verification." ".$ekstension;
    //   else if($_SESSION["level$ID"]=="4")
    //     $row[] =$view." ".$report. " ".$ekstension." ".$cetak_berkas." ".$download;
    //   else
    //     $row[] =$edit."  ".$delete." ".$report. " ".$ekstension." ".$cetak_berkas." ".$download;
    // }
    $output['aaData'][] = $row;
} //End while
echo json_encode($output);
?>