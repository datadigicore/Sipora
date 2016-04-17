<?php
  class modelAnggaran extends mysql_db {
    public function readKodeNamaOrganisasi() {
      $query  = "SELECT kode_organisasi, nama_organisasi, tahun_anggaran FROM setting_system WHERE status_aktif=1 AND status_delete = 0";
      $result = $this->query($query);
      $fetch  = $this->fetch_object($result);
      return $fetch;
    }
  }

?>
