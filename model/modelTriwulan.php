<?php
  class modelTriwulan extends mysql_db {
    public function autoUpdStatTriwulan() {
      $query   = "UPDATE triwulan SET status=0 WHERE CURDATE() > end_date";
      $result  = $this->query($query);
      $query   = "UPDATE triwulan SET status=1 WHERE CURDATE() < start_date";
      $result  = $this->query($query);
      $query   = "UPDATE triwulan SET status=1 WHERE CURDATE() BETWEEN start_date AND end_date";
      $result  = $this->query($query);
    }
    public function cekTahunAnggaran() {
      $query   = "SELECT THANG FROM rkakl_full GROUP BY THANG";
      $result  = $this->query($query);
      while ($fetch = $this->fetch_array($result)) {
        echo "<option value='$fetch[THANG]'>$fetch[THANG]</option>";
      }
    }
    public function cekTriwulan($data) {
      $query   = "SELECT thang, nama FROM triwulan where thang='$data[thang]'";
      $result  = $this->query($query);
      return $result->num_rows;
    }
    public function addTriwulan($data) {
      $query   = "INSERT INTO triwulan (id,thang,nama,start_date,end_date,status) VALUES 
        ('','$data[thang]','Triwulan 1','$data[thang]-01-01','$data[thang]-03-31',''),
        ('','$data[thang]','Triwulan 2','$data[thang]-04-01','$data[thang]-06-30',''),
        ('','$data[thang]','Triwulan 3','$data[thang]-07-01','$data[thang]-09-30',''),
        ('','$data[thang]','Triwulan 4','$data[thang]-10-01','$data[thang]-12-31','')";
      $result  = $this->query($query);
      return $result;
    }
    // public function addTriwulan($data) {
    //   $setdata = $this->setdata($data);
    //   $query   = "INSERT INTO triwulan set $setdata";
    //   $result  = $this->query($query);
    //   return $result;
    // }
  }

?>
