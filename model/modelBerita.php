<?php
  require_once __DIR__ . "/../utility/database/mysql_db.php";

  class modelBerita extends mysql_db {
    public function addBerita($data){

      $judul = $data['judul'];
      $date = str_replace('/', '-', $data['tanggal']);
      $pecahtgl  = date("d M Y", strtotime($date));
      $tanggal   = utilityCode::format_tanggal_db($pecahtgl);
      $isi = $data['isi'];
      $created_by = $_SESSION['id'];
      $created_at = date("Y-m-d H:i:s");
      $jenis = $data['jenis'];
      $status = 1;

      $query = "INSERT INTO berita SET
      judul = '$judul',
      tanggal = '$tanggal',
      isi = '$isi',
      created_by = '$created_by',
      created_at = '$created_at',
      jenis = '$jenis',
      status = '$status'";
      // echo $query;  
      $result = $this->query($query);
      return $result;
    }
    public function editBerita($data){
      $id         = $data['id'];
      $judul      = $data['judul'];
      $date       = str_replace('/', '-', $data['tanggal']);
      $pecahtgl   = date("d M Y", strtotime($date));
      $tanggal    = utilityCode::format_tanggal_db($pecahtgl);
      $isi        = $data['isi'];
      $created_by = $_SESSION['id'];
      $created_at = date("Y-m-d H:i:s");
      $jenis      = $data['jenis'];
      $status     = 1;
      $query      = "UPDATE berita SET
        judul      = '$judul',
        tanggal    = '$tanggal',
        isi        = '$isi',
        created_by = '$created_by',
        created_at = '$created_at',
        status     = '$status'
        WHERE id   = '$id'";
      $result = $this->query($query);
      return $result;
    }
    public function deleteBerita($id) {
      $query = "delete from berita where id='$id'";
      $result = $this->query($query);
      return $result;
    }
    public function addPengumuman($data){

      $isi = $data['isi'];
      $created_by = $_SESSION['id'];
      $created_at = date("Y-m-d H:i:s");
      $query = "SELECT * FROM pengumuman";
      $result = $this->query($query);
      if ($result->num_rows == 1) {
        $query = "UPDATE pengumuman SET
        isi = '$isi',
        created_by = '$created_by',
        created_at = '$created_at' where
        created_by = '$created_by'
        ";
        $result = $this->query($query);   
      }
      else {
        $query = "INSERT INTO pengumuman SET
        isi = '$isi',
        created_by = '$created_by',
        created_at = '$created_at'";
        $result = $this->query($query);   
      }
      return $result;
    }

    public function getBerita($jenis,$limit = 0,$id=NULL){
      $where = "";

      foreach ($jenis as $key => $value) {
        if($key!=0) {
          $where .= " OR ";
        }
        $where .= "jenis = $value";
      }
      if($id!==NULL){
        if($where != ""){
          $where .= " AND ";
        }
        foreach ($jenis as $key => $value) {
          if($key!=0) {
            $where .= " OR ";
          }
          $where .= "id = $value";
        }
      }
      $query  = "SELECT * FROM  berita where $where limit $limit";

      $result = $this->query($query);
      $i=0;
      while($fetch  = $this->fetch_object($result)) {
        $data['id'][] = $fetch->id;
        $data['judul'][] = $fetch->judul;
        $data['isi'][] = $fetch->isi;
        $data['tanggal'][] = $fetch->created_at;
        $i++;
      }
      return $data;
    }

    public function getPengumuman(){
      $query  = "SELECT * FROM  pengumuman";

      $result = $this->query($query);
      $i=0;
      while($fetch  = $this->fetch_object($result)) {
        $data['isi'][] = $fetch->isi;
        $i++;
      }
      return $data;
    }

    public function kdkegiatan(){
      $query  = "SELECT KDGIAT, NMGIAT FROM rkakl_full WHERE KDGIAT IS NOT NULL GROUP BY KDGIAT";
      $result = $this->query($query);
      while ($fetch = $this->fetch_array($result)) {
        echo "<option value='$fetch[KDGIAT]'>$fetch[KDGIAT] -- $fetch[NMGIAT]</option>";
      }
    }

    public function kdgrup(){
      $query  = "SELECT id, kode, nama FROM grup ";
      $result = $this->query($query);
      while ($fetch = $this->fetch_array($result)) {
        echo "<option value='$fetch[id]'>$fetch[kode] -- $fetch[nama]</option>";
      }
    }

    public function insertPengguna($data) {
      $nama       = $data['name'];
      $username   = $data['username'];
      $password   = $data['password'];
      $email      = $data['email'];
      $level      = $data['level'];
      $direktorat = $data['direktorat'];
      $grup = $data['grup'];
      $status     = $data['status'];

      $query      = "INSERT INTO pengguna SET
        nama      = '$nama',
        username  = '$username',
        password  = '$password',
        email     = '$email',
        level     = '$level',
        direktorat= '$direktorat',
        kdgrup    = '$grup',
        status    = '$status'
      ";

      $result = $this->query($query);
      return $result;
    }
    public function insertGroup($data) {
      $kode       = $data['kode'];
      $nama       = $data['name'];
      $kdprogram  = $data['kdprogram'];
      $direktorat = $data['direktorat'];
      $kdoutput   = $data['kdoutput'];

      $query      = "INSERT INTO grup SET
        kode      = '$kode',
        nama      = '$nama',
        kdprogram = '$kdprogram',
        direktorat= '$direktorat',
        kdoutput  = '$kdoutput'
      ";

      $result = $this->query($query);
      return $result;
    }
    public function updatePengguna($data) {
      $id         = $data['id'];
      $nama       = $data['name'];
      $username   = $data['username'];
      $password   = $data['password'];
      $email      = $data['email'];
      $keterangan = $data['keterangan'];

      $query       = "UPDATE pengguna SET
        nama       = '$nama',
        username   = '$username',
        password   = '$password',
        email      = '$email',
        keterangan = '$keterangan'
        WHERE id   = '$id'
      ";
      
      $result = $this->query($query);
      return $result;
    }

    public function updatePengguna2($data) {
      $id         = $data['id'];
      $nama       = $data['name'];
      $username   = $data['username'];
      $email      = $data['email'];

      $query       = "UPDATE pengguna SET
        nama       = '$nama',
        username   = '$username',
        email      = '$email'
        WHERE id   = '$id'
      ";
      
      $result = $this->query($query);
      $_SESSION['nama'] = $nama;
      $_SESSION['username'] = $username;
      $_SESSION['email'] = $email;
      return $result;
    }
    public function updatePass($data) {
      $id         = $data['id'];
      $newpassword       = $utility->sha512($data['newpassword']);
      $query       = "UPDATE pengguna SET
        password       = '$newpassword'
        WHERE id   = '$id'
      ";
      
      $result = $this->query($query);
      return $result;
    }

    public function getPass($data){
      $id         = $data['id'];
      $query  = "SELECT password from pengguna where id = '$id'";
      $result = $this->query($query);
      $fetch  = $this->fetch_object($result);
      return $fetch->password;
    }
    public function getGroup() {
      $query  = "SELECT kode, nama FROM  grup as r where status=1";
      $result = $this->query($query);
      $i=0;
      while($fetch  = $this->fetch_object($result)) {
        $data[$fetch->kode] = $fetch->nama;
        $i++;
      }
      return $data;
    }
    public function editPengguna($data) {
      foreach ($data as $key => $value) {
        $setdata .= "$key = '$value', ";
      }
      $setdata = rtrim($setdata,', ');
      $query = "update pengguna set $setdata where id='$data[id]'";
      $result = $this->query($query);
      return $result;
    }
    public function editGrup($data) {
      $id         = $data['id_data'];
      $kode       = $data['kode'];
      $nama       = $data['name'];
      $kdprogram  = $data['kdprogram'];
      $direktorat = $data['direktorat'];
      $kdoutput   = $data['kdoutput'];
      // foreach ($data as $key => $value) {
        // if($key == "kdprogram" || $key == "direktorat" || $key == "kdoutput"){
        //   $strKode='';
        //   foreach ($value as $nilai) {
        //     if($strKode==""){
        //       $strKode = $nilai;
        //     } else {
        //       $strKode = $strKode.",".$nilai;
        //     }
        //   }
        //   $value = $strKode;
        // }

      //   $setdata .= "$key = '$value', ";
      // }
      $setdata = rtrim($setdata,', ');
      $query = "update grup set kode = '$kode', nama = '$nama', kdprogram = '$kdprogram', direktorat = '$direktorat', kdoutput = '$kdoutput' where id='$id'";
      $result = $this->query($query);
      return $result;
    }
    public function deletePengguna($id) {
      $query = "delete from pengguna where id='$id'";
      $result = $this->query($query);
      return $result;
    }
    public function deleteGroup($id) {
      $query = "update grup set status=0 where kode='$id'";
      $result = $this->query($query);
      return $result;
    }
    public function activatePengguna($id) {
      $query = "update pengguna set status = 1 where id='$id'";
      $result = $this->query($query);
      return $result;
    }
    public function deactivatePengguna($id) {
      $query = "update pengguna set status = 0 where id='$id'";
      $result = $this->query($query);
      return $result;
    }
    public function readPengguna($data) {
      $where  = $this->where($data);
      $query  = "SELECT * from pengguna $where";
      $result = $this->query($query);
      $fetch  = $this->fetch_object($result);
      return $fetch;
    }
  }

?>
