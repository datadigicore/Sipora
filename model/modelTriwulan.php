<?php
  class modelTriwulan extends mysql_db {
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
