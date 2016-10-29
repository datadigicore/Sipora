<?php
  require_once __DIR__ . "/../utility/database/mysql_db.php";

  class modelVolume extends mysql_db {

    public function insertVolume($data){
      $thang     = $data['thang'];
      $kdprogram = $data['kdprogram'];
      $kdgiat    = $data['kdgiat'];
      $kdoutput  = $data['kdoutput'];
      $kdsoutput = $data['kdsoutput'];
      $kdkmpnen  = $data['kdkmpnen'];
      $kdskmpnen = $data['kdskmpnen'];

      $vol_target    = $data['vol_target'];
      $vol_real1    = $data['vol_real1'];
      $vol_real2    = $data['vol_real2'];
      $vol_real3    = $data['vol_real3'];
      $vol_real4    = $data['vol_real4'];

      // if ($data['idtriwulan'] == "1") {
      //   $tambahan = "vol_real1 = '$vol_real', ";
      // }elseif ($data['idtriwulan'] == "2") {
      //   $tambahan = "vol_real2 = '$vol_real', ";
      // }elseif ($data['idtriwulan'] == "3") {
      //   $tambahan = "vol_real3 = '$vol_real', ";
      // }elseif ($data['idtriwulan'] == "4") {
      //   $tambahan = "vol_real4 = '$vol_real', ";
      // }
      
      $satuan    = $data['satuan'];

      $created_by = $_SESSION['id'];
      $created_at = date("Y-m-d H:i:s");

      $query = "INSERT INTO volume SET
                thang     = '$thang',
                kdprogram = '$kdprogram',
                kdgiat    = '$kdgiat',
                kdoutput  = '$kdoutput',
                kdsoutput = '$kdsoutput',
                kdkmpnen  = '$kdkmpnen',
                kdskmpnen = '$kdskmpnen',

                vol_target = '$vol_target',
                vol_real  = '$vol_real1',
                vol_real2  = '$vol_real2',
                vol_real3  = '$vol_real3',
                vol_real4  = '$vol_real4',
                satuan    = '$satuan',

                created_by = '$created_by',
                created_at = '$created_at'
      ";
      $result = $this->query($query);

      return $result;
    }

    public function updateVolume($data){
      $id        = $data['id_volume'];
      $thang     = $data['thang'];
      $kdprogram = $data['kdprogram'];
      $kdgiat    = $data['kdgiat'];
      $kdoutput  = $data['kdoutput'];
      $kdsoutput = $data['kdsoutput'];
      $kdkmpnen  = $data['kdkmpnen'];
      $kdskmpnen = $data['kdskmpnen'];

      $vol_target    = $data['vol_target'];
      $vol_real1    = $data['vol_real1'];
      $vol_real2    = $data['vol_real2'];
      $vol_real3    = $data['vol_real3'];
      $vol_real4    = $data['vol_real4'];

      // if ($data['idtriwulan'] == "1") {
      //   $tambahan = "vol_real1 = '$vol_real', ";
      // }elseif ($data['idtriwulan'] == "2") {
      //   $tambahan = "vol_real2 = '$vol_real', ";
      // }elseif ($data['idtriwulan'] == "3") {
      //   $tambahan = "vol_real3 = '$vol_real', ";
      // }elseif ($data['idtriwulan'] == "4") {
      //   $tambahan = "vol_real4 = '$vol_real', ";
      // }

      $satuan    = $data['satuan'];
      // $status    = $data['status'];
      $updated_by = $_SESSION['id'];
      $updated_at = date("Y-m-d H:i:s");

      $query = "UPDATE volume SET
                thang     = '$thang',
                kdprogram = '$kdprogram',
                kdgiat    = '$kdgiat',
                kdoutput  = '$kdoutput',
                kdsoutput = '$kdsoutput',
                kdkmpnen  = '$kdkmpnen',
                kdskmpnen = '$kdskmpnen',

                vol_target = '$vol_target',
                vol_real  = '$vol_real1',
                vol_real2  = '$vol_real2',
                vol_real3  = '$vol_real3',
                vol_real4  = '$vol_real4',
                satuan    = '$satuan',

                updated_by = '$updated_by',
                updated_at = '$updated_at'
                WHERE id = '$id'
      ";
      $result = $this->query($query);

      return $result;
    }

    /*public function deleteVolume($data){
      $id = $data['id'];

      $query = "DELETE FROM volume where id = '$id'";
      $result = $this->query($query);

      return $result;
    }*/

    /*public function insertlogvolume($id){
      $query = "SELECT * from volume where id = '$id'";
      $result=$this->_fetch_array($query,1);

      $query = "INSERT INTO volume_log SET ";
      foreach($result[0] as $key => $value) {
        if (!ctype_digit($key)) {
          $query .= " $key = '$value' ,";
        }
      }
    }*/

  }

?>
