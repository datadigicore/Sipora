<?php
  class modelTriwulan extends mysql_db {
    public function triwulanActive() {
      $query = "SELECT id, nama, status FROM triwulan WHERE status = 1";
      $result = $this->query($query);
      $fetch = $this->fetch_object($result);
      echo '<input type="text" class="form-control readonly" placeholder="Status Triwulan Saat Ini Belum Tersedia" value="'.$fetch->nama.'" required/>';
      echo '<input type="hidden" class="form-control" name="idtriwulan" value="'.$fetch->id.'" />';
      echo '<input type="hidden" class="form-control" name="status" value="'.$fetch->status.'" />';
    }
    public function prosentase($data) {
      $query  = "UPDATE triwulan SET prog_high = '$data[high]', prog_med = '$data[med]', prog_low = '$data[low]' WHERE id = '$data[id]'";
      $result = $this->query($query);
    }
    public function unlock($data) {
      $query  = "SELECT end_date FROM triwulan WHERE id = '$data[id]'";
      $result = $this->query($query);
      $fetch  = $this->fetch_object($result);
      $extract = explode('-', $fetch->end_date);
      if ($extract[1] != '00' && $extract[2] != '00') {
        $query  = "UPDATE triwulan SET status = '4' WHERE id = '$data[id]'";
        $result = $this->query($query);
        $query  = "UPDATE rabview SET status = '4' WHERE idtriwulan = '$data[id]'";
        $result = $this->query($query);
      }
    }
    public function activate($data) {
      $data[prev] = $data[id] - 1;
      $query      = "SELECT end_date FROM triwulan WHERE end_date = CURDATE() && id = '$data[prev]'";
      $result     = $this->query($query);
      if ($result->num_rows == 0) {
        $query    = "UPDATE triwulan SET status = '1', start_date = CURDATE() WHERE id = '$data[id]'";
        $result   = $this->query($query);
      }
      else {
        $query    = "UPDATE triwulan SET status = '1', start_date = CURDATE()+1 WHERE id = '$data[id]'";
        $result   = $this->query($query);
        $query  = "UPDATE rabview SET status = '0' WHERE idtriwulan = '$data[prev]'";
        $result = $this->query($query);
      }
    }
    public function deactivate($data) {
      $query      = "SELECT status FROM triwulan WHERE id = '$data[id]'";
      $result     = $this->query($query);
      $fetch      = $this->fetch_object($result);
      if ($fetch->status == 4) {
        $query  = "UPDATE triwulan SET status = '0' WHERE id = '$data[id]'";
        $result = $this->query($query);
        $query  = "UPDATE rabview SET status = '0' WHERE idtriwulan = '$data[id]'";
        $result = $this->query($query);
      }
      else {
        $query  = "SELECT start_date FROM triwulan WHERE (start_date = CURDATE() OR start_date = CURDATE()+1) && id = '$data[id]'";
        $result = $this->query($query);
        if ($result->num_rows == 0) {
          $query      = "UPDATE triwulan SET status = '0', end_date = CURDATE() WHERE id = '$data[id]'";
          $result     = $this->query($query);
          $query      = "UPDATE rabview SET status = '0' WHERE idtriwulan = '$data[id]'";
          $result     = $this->query($query);
          $data[next] = $data[id] + 1;
          $query      = "UPDATE triwulan SET status = '2' WHERE id = '$data[next]'";
          $result     = $this->query($query);
        }
      }
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
    public function gettriwulanactive() {
      $query  = "SELECT id, thang, nama FROM triwulan WHERE status = 1";
      $result = $this->query($query);
      $fetch  = $this->fetch_object($result);
      return $fetch;
    }
    public function getdirectoratactive($id,$thang) {
      $query  = "SELECT rabview.kdgiat,rkakl_full.nmgiat FROM rabview INNER JOIN rkakl_full ON rabview.kdgiat = rkakl_full.kdgiat where rabview.idtriwulan=$id AND rkakl_full.thang=$thang group by rabview.kdgiat";
      $result = $this->query($query);
      while ($fetch  = $this->fetch_array($result)) {
        $newfetch[$fetch[kdgiat]] = $fetch[nmgiat];
      }
      return $newfetch;
    }
    public function getdirectoratnactive($id,$thang) {
      $query  = "SELECT rabview.kdgiat,rkakl_full.nmgiat FROM rabview INNER JOIN rkakl_full ON rabview.kdgiat = rkakl_full.kdgiat where rabview.idtriwulan!=$id AND rkakl_full.thang=$thang group by rabview.kdgiat";
      $result = $this->query($query);
      while ($fetch  = $this->fetch_array($result)) {
        $newfetch[$fetch[kdgiat]] = $fetch[nmgiat];
      }
      return $newfetch;
    }
    public function addTriwulan($data) {
      $query   = "INSERT INTO triwulan (id,thang,nama,start_date,end_date,status) VALUES 
        ('','$data[thang]','Triwulan 1','$data[thang]-01-01','$data[thang]-00-00','1'),
        ('','$data[thang]','Triwulan 2','$data[thang]-00-00','$data[thang]-00-00','3'),
        ('','$data[thang]','Triwulan 3','$data[thang]-00-00','$data[thang]-00-00','3'),
        ('','$data[thang]','Triwulan 4','$data[thang]-00-00','$data[thang]-00-00','3')";
      $result  = $this->query($query);
      return $result;
    }
  }

?>
