<?php
  class modelEvaluasi extends mysql_db {
    public function readIdStruktur() {
      $query  = "SELECT id_struktur, title FROM strukturorganisasi WHERE unit='$_SESSION[unit]' AND sub_unit='$_SESSION[sub_unit]' AND sub_subunit ='$_SESSION[sub_subunit]'";
      $result = $this->query($query);
      $fetch  = $this->fetch_object($result);
      return $fetch;
    }
  }

?>
