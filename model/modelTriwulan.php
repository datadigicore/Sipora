<?php
  class modelTriwulan extends mysql_db {
    public function cekTahunAnggaran() {
      $query   = "SELECT THANG FROM rkakl GROUP BY THANG";
      $result  = $this->query($query);
      while ($fetch = $this->fetch_array($result)) {
        echo "<option value='$fetch[THANG]'>$fetch[THANG]</option>";
      }
    }
    public function cekTriwulan($data) {
      $query   = "SELECT thang, nama FROM triwulan where thang='$data[thang]' AND nama='$data[nama]'";
      $result  = $this->query($query);
      return $result->num_rows;
    }
    public function addTriwulan($data) {
      $setdata = $this->setdata($data);
      $query   = "INSERT INTO triwulan set $setdata";
      $result  = $this->query($query);
      return $result;
    }
  }

?>
