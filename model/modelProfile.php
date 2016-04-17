<?php
  class modelProfile extends mysql_db {
    public function update($data) {
      $newpassword = md5($data['newpassword']);
      $query  = "UPDATE pengguna SET password='$newpassword' WHERE id_user = '$data[id]'";
      $result = $this->query($query);
      return $result;
    }
  }

?>
