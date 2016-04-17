<?php 
	switch ($link[3]) {
    case 'create':
      echo "CREATE HERE";
    break;
    case 'read':
    	echo "READ HERE";
    break;
    case 'update':
      $data = $purifier->purifyArray($_POST);
      $data['id'] = $_SESSION['id_user'];
      $result = $profile->update($data);
      if (!empty($result)) {
        $flash  = array(
          'category' => "success",
          'messages' => "Password Berhasil di Ubah"
        );
        $utility->location("content/profile", $flash);
      }
      else {
        $flash  = array(
          'category' => "error",
          'messages' => "Terjadi Kesalahan Saat Update Data"
        );
        $utility->location("content/profile", $flash); 
      }
    break;
    case 'delete':
      echo "DELETE HERE";
    break;
    default:
      $utility->location("content/import");
    break;
	}
?>