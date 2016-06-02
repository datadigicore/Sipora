<?php
  class modelHome extends mysql_db {
    public function cekJabatanDispora() {
      $query  = "SELECT nama_provinsi FROM provinsi WHERE id_provinsi='$_SESSION[id_provinsi]'";
      $result = $this->query($query);
      $fetch  = $this->fetch_array($result);
      $title  = 'Dispora '.$fetch['nama_provinsi'];
      return $title;
    }
    public function cekJabatanKemenpora() {
      $query  = "SELECT title FROM strukturorganisasi WHERE unit='$_SESSION[unit]' AND sub_unit='$_SESSION[sub_unit]' AND sub_subunit='$_SESSION[sub_subunit]'";
      $result = $this->query($query);
      $fetch  = $this->fetch_array($result);
      $title  = $fetch['title'];
      return $title;
    }
    public function infoTriwulanByKategori($kategori) {
      $query  = "SELECT status_triwulan FROM setting_system WHERE kategori='$kategori' AND status_delete=0 AND status_aktif='1'";
      $result = $this->query($query);
      $fetch  = $this->fetch_array($result);
      $status = 'Triwulan'.$fetch['status_triwulan']; 
      return $status;
    }
    public function infoTriwulanPusat() {
      $query  = "SELECT tanggal_akhir, status_triwulan FROM setting_system WHERE kategori='Pusat' AND status_delete=0 AND status_aktif='1'";
      $result = $this->query($query);
      $fetch  = $this->fetch_array($result);
      return $fetch;
    }
    public function statusTriwulan() {
      $query  = "SELECT status_triwulan FROM setting_system WHERE status_aktif=1 AND kategori='Pusat' AND status_aktif='1' AND status_delete=0";
      $result = $this->query($query);
      $fetch  = $this->fetch_array($result);
      return $fetch;
    }
    public function infoTriwulanDekon() {
      $query  = "SELECT tanggal_akhir, status_triwulan FROM setting_system WHERE kategori='Dekon' AND status_delete=0 AND status_aktif='1'";
      $result = $this->query($query);
      $fetch  = $this->fetch_array($result);
      return $fetch;
    }
    public function realisasiDeputi($no_triwulan,$tahun){
      if(!empty($no_triwulan)){
        $query="SELECT S.title,S.unit,S.sub_unit,S.sub_subunit,M.JML_PENYERAPAN,M.id_struktur_parent,M.id_struktur_child, M.komentar, A.pagu_anggaran FROM strukturorganisasi S 
              left join (select id_struktur_parent,komentar, id_struktur_child,sum(triwulan$no_triwulan"."_realisasi) as JML_PENYERAPAN 
              from main_kegiatan_pusat where tahun_anggaran='$tahun' and status_delete = 0 group by id_struktur_parent) M on M.id_struktur_parent=S.id_struktur                     
              left join (select pagu_anggaran,unit,sub_unit,sub_subunit  
              from anggaran_kementerian  where sub_unit!=0 and sub_subunit=0 and tahun_anggaran='$tahun' and status_delete = 0) A
              on A.unit=S.unit and A.sub_unit=S.sub_unit and A.sub_subunit=S.sub_subunit 
              where S.sub_unit!=0 and S.sub_subunit=0 group by S.unit,S.sub_unit,S.sub_subunit order by S.sub_unit";
        $result = $this->query($query);
        $no_acak=  rand(0, 1000);
        echo "<center><h2>Data Evaluasi Pusat Tingkat Deputi Tahun $tahun <br />Triwulan $no_triwulan</h2></center>
        <table class=\"table table-striped table-hover CSSTableGenerator  highchart\"  data-graph-container-before=\"1\" id=\"table_$no_acak\" data-graph-type=\"column\">
        <thead>
        <tr>
        <th>Nama Unit</th>
        <th>Pagu Anggaran</th>
        <th>Realisasi Anggararan<br/> Triwulan $no_triwulan</th>        
        </tr>
        </thead>
        <tbody>";
        while($row = $this->fetch_array($result)) {
        echo "<tr>
          <td> <a href='report_pagu_asdep.php?unit=$row[unit]&sub_unit=$row[sub_unit]&id=$row[id_struktur_parent]'>$row[title]</a></td>
          <td style='text-align: right;'>$row[pagu_anggaran]</td>
          <td style='text-align: left;'>$row[JML_PENYERAPAN]</td>         
        </tr>";
        }
        echo "</tbody></table>"; 
        echo "<script>$(document).ready(function() {
        $('#table_$no_acak.highchart').highchartTable();
        });</script>";
      }
    }
    public function realisasiDekonProv($no_triwulan,$tahun){
      if ($no_triwulan == '1'){
        $realisasi = 'realisasi_anggaran_1 + realisasi_anggaran_2 + realisasi_anggaran_3';
      }
      elseif($no_triwulan == '2'){
        $realisasi = 'realisasi_anggaran_4 + realisasi_anggaran_5 + realisasi_anggaran_6';
      }
      elseif($no_triwulan == '3'){
        $realisasi = 'realisasi_anggaran_7 + realisasi_anggaran_8 + realisasi_anggaran_9';
      }
      else{
        $realisasi = 'realisasi_anggaran_10 + realisasi_anggaran_11 + realisasi_anggaran_12';
      }
      $query="SELECT P.id_provinsi, P.nama_provinsi, D.pagu_tr, D.id_provinsi,MP.pagu_anggaran FROM provinsi P
              LEFT JOIN (SELECT id_provinsi,komentar, SUM($realisasi) AS pagu_tr FROM  `main_kegiatan_dekon` 
              WHERE status_delete = 0 and tahun_anggaran = $tahun GROUP BY id_provinsi)D ON D.id_provinsi = P.id_provinsi
              LEFT JOIN (SELECT id_provinsi, pagu_anggaran FROM  `main_pagu_dekon` 
              WHERE tahun_anggaran = $tahun AND status_delete =0) MP ON MP.id_provinsi = P.id_provinsi order by P.id_provinsi";
      $result =  $this->query($query);
      $no_acak=  rand(0, 1000);
      echo "<center><h2>Data Evaluasi Dekon Tingkat Provinsi Tahun $tahun Triwulan $no_triwulan</h2></center>
          <table class=\"table table-striped table-hover CSSTableGenerator  highchart\"  data-graph-container-before=\"1\" id=\"table_$no_acak\" 
          data-graph-legend-width=\"50\" data-graph-xaxis-labels-font-size=\"0%\" data-graph-type=\"bar\">
          <thead>
          <tr>
          <th>Nama Provinsi</th>
          <th>Pagu Anggaran</th>
          <th>Realisasi Anggararan<br/> Triwulan $no_triwulan</th>        
          <th>Komentar</th>       
          </tr>
          </thead><tbody>";
      while($row = $this->fetch_array($result)){
      ?>
      <tr>
      <td><?php echo $row['nama_provinsi']?></td>
      <td><?php echo $row['pagu_anggaran'];?></td>
      <td ><?php echo $row['pagu_tr'];?></td> 
      <td ><?php echo $row['komentar'];?></td> 
      </tr>
      <?php
      }
      echo "</tbody>
      </table>
      <script>
        $(document).ready(function() {
          $('#table_$no_acak.highchart').highchartTable();
        });
      </script>";
    }
  }
?>
