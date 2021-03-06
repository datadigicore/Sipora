<?php
  require_once __DIR__ . "/../utility/database/mysql_db.php";

  class modelRabview extends mysql_db {

    public function insertRabview($data, $filename=""){
      $thang     = $data['thang'];
      $kdprogram = $data['kdprogram'];
      $kdgiat    = $data['kdgiat'];
      $kdoutput  = $data['kdoutput'];
      $kdsoutput = $data['kdsoutput'];
      $kdkmpnen  = $data['kdkmpnen'];
      $kdskmpnen = $data['kdskmpnen'];
      $idtriwulan = $data['idtriwulan'];
      $deskripsi = $data['deskripsi'];

      $date = str_replace('/', '-', $_POST['tanggal']);
      $pecahtgl  = date("d M Y", strtotime($date));
      $tanggal   = utilityCode::format_tanggal_db($pecahtgl);

      $date_end = str_replace('/', '-', $_POST['tanggal_akhir']);
      $pecahtglend  = date("d M Y", strtotime($date_end));
      $tanggal_akhir   = utilityCode::format_tanggal_db($pecahtglend);

      $tempat    = $data['tempat'];
      $lokasi    = $data['lokasi'];
      $volume    = $data['volume'];
      $satuan    = $data['satuan'];
      $jumlah    = $data['jumlah'];
      $jumlah  = explode(".", $jumlah);
      $jumlah  = implode("", $jumlah);
      $status    = $data['status'];
      $created_by = $_SESSION['id'];
      $created_at = date("Y-m-d H:i:s");

      $query = "INSERT INTO rabview SET
                thang     = '$thang',
                kdprogram = '$kdprogram',
                kdgiat    = '$kdgiat',
                kdoutput  = '$kdoutput',
                kdsoutput = '$kdsoutput',
                kdkmpnen  = '$kdkmpnen',
                kdskmpnen = '$kdskmpnen',
                idtriwulan = '$idtriwulan',
                deskripsi = '$deskripsi',
                tanggal   = '$tanggal',
                tanggal_akhir = '$tanggal_akhir',
                tempat    = '$tempat',
                lokasi    = '$lokasi',
                volume    = '$volume',
                satuan    = '$satuan',
                jumlah    = '$jumlah',
                status    = '$status',
                dokumen    = '$filename',
                created_by = '$created_by',
                created_at = '$created_at'
      ";

      $result = $this->query($query);

      $this->insertlograbview($this->insert_id($result), 'INSERT');

      return $result;
    }

    public function updateRabview($data, $filename=""){
      $id        = $data['id'];
      $thang     = $data['thang'];
      $kdprogram = $data['kdprogram'];
      $kdgiat    = $data['kdgiat'];
      $kdoutput  = $data['kdoutput'];
      $kdsoutput = $data['kdsoutput'];
      $kdkmpnen  = $data['kdkmpnen'];
      $kdskmpnen = $data['kdskmpnen'];
      $idtriwulan = $data['idtriwulan'];
      $deskripsi = $data['deskripsi'];

      $date = str_replace('/', '-', $_POST['tanggal']);
      $pecahtgl  = date("d M Y", strtotime($date));
      $tanggal   = utilityCode::format_tanggal_db($pecahtgl);

      $date_end = str_replace('/', '-', $_POST['tanggal_akhir']);
      $pecahtglend  = date("d M Y", strtotime($date_end));
      $tanggal_akhir   = utilityCode::format_tanggal_db($pecahtglend);

      $tempat    = $data['tempat'];
      $lokasi    = $data['lokasi'];
      $volume    = $data['volume'];
      $satuan    = $data['satuan'];
      $jumlah    = $data['jumlah'];
      $jumlah  = explode(".", $jumlah);
      $jumlah  = implode("", $jumlah);
      // $status    = $data['status'];
      $updated_by = $_SESSION['id'];
      $updated_at = date("Y-m-d H:i:s");

      $query = "UPDATE rabview SET
                thang     = '$thang',
                kdprogram = '$kdprogram',
                kdgiat    = '$kdgiat',
                kdoutput  = '$kdoutput',
                kdsoutput = '$kdsoutput',
                kdkmpnen  = '$kdkmpnen',
                kdskmpnen = '$kdskmpnen',
                idtriwulan = '$idtriwulan',
                deskripsi = '$deskripsi',
                tanggal   = '$tanggal',
                tanggal_akhir = '$tanggal_akhir',
                tempat    = '$tempat',
                lokasi    = '$lokasi',
                volume    = '$volume',
                satuan    = '$satuan',
                jumlah    = '$jumlah',
                dokumen   = '$filename',
                updated_by = '$updated_by',
                updated_at = '$updated_at'
                WHERE id = '$id'
      ";
      $result = $this->query($query);
      $this->insertlograbview($id, 'UPDATE');

      return $result;
    }

    public function deleteRabview($data){
      $id = $data['id'];
      $this->insertlograbview($id, 'DELETE');

      $query = "DELETE FROM rabview where id = '$id'";
      $result = $this->query($query);

      return $result;
    }

    public function insertlograbview($id, $tipe){
      $query = "SELECT * from rabview where id = '$id'";
      $result=$this->_fetch_object($query,1);

      $query = "INSERT INTO rabview_log SET ";
      foreach($result[0] as $key => $value) {
        if (!ctype_digit($key) && $key != 'id') {
          $query .= " $key = '$value' ,";
        }
      }
      $log_by = $_SESSION['id'];
      $log_at = date("Y-m-d H:i:s");

      $query .= " tipe = '$tipe'";
      // print_r($query);die;
      $result = $this->query($query);
    }

    public function cekpagu($idrkakl, $jumlah, $idtriwulan, $idrab=null){
      $valuelama = 0;
      if (!is_null($idrab)) {
        $query="SELECT * FROM `rabview` WHERE id = '$idrab'" ;
        $result=$this->_fetch_array($query,1);
        $valuelama = $result[0]['jumlah'];
      }

      $pecahid = explode(".", $idrkakl);
      $countarr = count($pecahid);
      unset($pecahid[$countarr-1]);
      unset($pecahid[$countarr-2]);
      $idrkakl = implode(".", $pecahid);

      $query = "SELECT COUNT(IDRKAKL) as banyak, 
                        KDPROGRAM, KDGIAT, KDOUTPUT, KDSOUTPUT, KDKMPNEN, KDSKMPNEN,
                        GROUP_CONCAT(IDRKAKL) as grupid, 
                        SUM(JUMLAH) as `JUMLAH`, 
                        SUM(TRIWULAN1) as `TRIWULAN1`, 
                        SUM(TRIWULAN2) as `TRIWULAN2`, 
                        SUM(TRIWULAN3) as `TRIWULAN3`, 
                        SUM(TRIWULAN4) as `TRIWULAN4` 
                FROM rkakl_full 
                WHERE IDRKAKL LIKE '".$idrkakl."%'  GROUP BY THANG,KDPROGRAM,KDGIAT,KDOUTPUT,KDSOUTPUT,KDKMPNEN,KDSKMPNEN";
      $result=$this->_fetch_array($query,1);

      $datarab["triwulan1"] = 0;
      $datarab["triwulan2"] = 0;
      $datarab["triwulan3"] = 0;
      $datarab["triwulan4"] = 0;

      $query="SELECT `id`, `thang`, `kdprogram`, `kdgiat`, `kdoutput`, `kdsoutput`, `kdkmpnen`, `kdskmpnen`, `deskripsi`, `tanggal`, `tanggal_akhir`, `tempat`, `lokasi`, `volume`, `satuan`, `jumlah`, `status`, `created_at`, `created_by`, `idtriwulan` 
              FROM `rabview` WHERE kdprogram = '".$result[0][KDPROGRAM]."' and kdgiat = '".$result[0][KDGIAT]."' and kdoutput = '".$result[0][KDOUTPUT]."' and kdsoutput = '".$result[0][KDSOUTPUT]."' and kdkmpnen = '".$result[0][KDKMPNEN]."' and kdskmpnen = '".$result[0][KDSKMPNEN]."'" ;
        $resultrab=$this->_fetch_array($query,1);

        if (!is_null($resultrab)) {
          foreach ($resultrab as $key => $value) {
            $id=$value['id'];
            $thang=$value['thang'];
            $idtriwulan=$value['idtriwulan'];
            $jumlahrab=$value['jumlah'];
            $datarab["triwulan$idtriwulan"] += $jumlahrab;
          }
        }

      $sisapagu = $result[0]['JUMLAH'] - (($datarab['triwulan1'] + $datarab['triwulan2'] + $datarab['triwulan3'] + $datarab['triwulan4']) - $valuelama);
      $jumlah  = explode(".", $jumlah);
      $jumlah  = implode("", $jumlah);
      // print_r($result[0]['JUMLAH']);echo "<br>";print_r($jumlah); die;
      if ($sisapagu < $jumlah) {
        return 'error';
      }else{

        if ($idtriwulan == 1) {
          $total = ( $result[0]['TRIWULAN1'] - $valuelama) + $jumlah;
        }elseif ($idtriwulan == 2) {
          $total = ( $result[0]['TRIWULAN2'] - $valuelama) + $jumlah;
        }elseif ($idtriwulan == 3) {
          $total = ( $result[0]['TRIWULAN3'] - $valuelama) + $jumlah;
        }elseif ($idtriwulan == 4) {
          $total = ( $result[0]['TRIWULAN4'] - $valuelama) + $jumlah;
        }

        $banyakitem = $result[0]['banyak'];
        $totalperitem = floor($total/$banyakitem);
        $sisaitem = $total % $banyakitem;
        $idrkaklgrup = explode(",", $result[0]['grupid']);
        for ($x=0; $x < $banyakitem; $x++) { 
          $id = $idrkaklgrup[$x];
          if ($sisaitem == 0) {
              $query = "UPDATE rkakl_full set TRIWULAN".$idtriwulan." = '".$totalperitem."' WHERE IDRKAKL = '".$id."' ";
              $result = $this->query($query);
          }else{
            if ($x == ($banyakitem-1)) {
                $totalperitem = $totalperitem + $sisaitem;
                $query = "UPDATE rkakl_full set TRIWULAN".$idtriwulan." = '".$totalperitem."' WHERE IDRKAKL = '".$id."' ";
                $result = $this->query($query);
            }else{
                $query = "UPDATE rkakl_full set TRIWULAN".$idtriwulan." = '".$totalperitem."' WHERE IDRKAKL = '".$id."' ";
                $result = $this->query($query);
            }
          }
        }
        return 'berhasil';
      }
    }

  }

?>
