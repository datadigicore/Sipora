<?php
  class modelRkakl extends mysql_db {
    public function insertRkakl($data) {
      $tanggal    = $data['tanggal'];
      $filename   = $data['filename'];
      $filesave   = $data['filesave'];
      $keterangan = $data['keterangan'];
      $tahun      = $data['tahun'];
      $status     = $data['status'];
      $no_dipa    = $data['no_dipa'];

      $query      = "UPDATE rkakl_view SET
        status    = '0' WHERE
        tahun     = '$tahun'
      ";
      $result = $this->query($query);
      $cek_versi = "SELECT MAX(versi) AS max_versi FROM rkakl_view WHERE tahun = '$tahun'";
      $result = $this->query($cek_versi);
      while ($fetch = $this->fetch_object($result)) {
        $versi = $fetch->max_versi;
      }
      if (isset($data['pesan'])) {
        $pesan = $data['pesan'];
        $query      = "UPDATE rkakl_view SET
          pesan    = '$pesan' 
          WHERE tahun     = '$tahun'
          AND versi       = '$versi'
        ";
        $result = $this->query($query);
      }else{
        $pesan = "";
      }

      if (empty($versi) && $versi !== '0') {
        $query      = "INSERT INTO rkakl_view SET
          tanggal   = '$tanggal',
          no_dipa   = '$no_dipa',
          filename  = '$filename',
          filesave  = '$filesave',
          keterangan= '$keterangan',
          tahun     = '$tahun',
          status    = '$status'
        ";
        $result = $this->query($query);
      }
      else{
        $newversi   = $versi+1;
        $query      = "INSERT INTO rkakl_view SET
          tanggal   = '$tanggal',
          no_dipa   = '$no_dipa',
          filename  = '$filename',
          filesave  = '$filesave',
          keterangan= '$keterangan',
          tahun     = '$tahun',
          status    = '$status',
          pesan     = '$pesan',
          versi     = '$newversi'
        ";
        $result = $this->query($query);
        return $result;
      }
    }

    public function checkThang($data) {
      $query  = "SELECT tahun FROM rkakl_view WHERE
        tahun = '$data'";
      $result = $this->query($query);
      return $result;
    }

    public function cekVersi($tahun){
      $cek_versi = "SELECT MAX(versi) AS max_versi FROM rkakl_view WHERE tahun = '$tahun'";
      $result = $this->query($cek_versi);
      while ($fetch = $this->fetch_object($result)) {
        $versi = $fetch->max_versi;
      }
      return $versi;
    }

    public function hapusLastInsRkaklView($tahun){
      $query  = "DELETE FROM rkakl_view WHERE versi = (SELECT max_versi FROM (SELECT MAX(versi) AS max_versi FROM rkakl_view) AS tmp) AND tahun = '$tahun'";
      $result = $this->query($query);
      $query  = "UPDATE rkakl_view SET status = '1' WHERE versi = (SELECT max_versi FROM (SELECT MAX(versi) AS max_versi FROM rkakl_view) AS tmp) AND tahun = '$tahun'";
      $result = $this->query($query);
    }

    public function updDelRowHadRealisasi($tahun){
      $query = "SELECT IDRKAKL, REALISASI FROM rkakl_full WHERE versi = (SELECT pre_versi FROM (SELECT MAX(versi)-1 AS pre_versi FROM rkakl_view) AS tmp) AND THANG = '$tahun'";
      $result = $this->query($query);
      while ($field = $this->fetch_object($result)) {
        $break            = explode('.', $field->IDRKAKL);
        $row['idrkakl']   = $break[0];
        $row['realisasi'] = floatval($field->REALISASI);
        $query2 = "SELECT IDRKAKL, JUMLAH, REALISASI FROM rkakl_full WHERE IDRKAKL LIKE '$row[idrkakl]%' AND JUMLAH != REALISASI AND versi = (SELECT pre_versi FROM (SELECT MAX(versi) AS pre_versi FROM rkakl_view) AS tmp2) AND THANG = '$tahun' ORDER BY IDRKAKL";
        $result2 = $this->query($query2);
        while ($field2 = $this->fetch_object($result2)) {
          $row2['idrkakl']   = $field2->IDRKAKL;
          $row2['jumlah']    = floatval($field2->JUMLAH);
          $row2['realisasi'] = floatval($field2->REALISASI);
          $totalRealisasi    = $row['realisasi']+$row2['realisasi'];
          $jumlahAnggaran    = $row2['jumlah']-$totalRealisasi;
          if ($jumlahAnggaran < 0) {
            while ($jumlahAnggaran < 0) {
              $newRealisasi = $totalRealisasi+$jumlahAnggaran;
              $query3 = "UPDATE rkakl_full SET REALISASI = '$newRealisasi' WHERE IDRKAKL = '$row2[idrkakl]' AND versi = (SELECT pre_versi FROM (SELECT MAX(versi) AS pre_versi FROM rkakl_view) AS tmp) AND THANG = '$tahun'";
              $result3 = $this->query($query3);
              $query2 = "SELECT IDRKAKL, JUMLAH, REALISASI FROM rkakl_full WHERE IDRKAKL LIKE '$row[idrkakl]%' AND JUMLAH != REALISASI AND versi = (SELECT pre_versi FROM (SELECT MAX(versi) AS pre_versi FROM rkakl_view) AS tmp2) AND THANG = '$tahun' ORDER BY IDRKAKL";
              $result2 = $this->query($query2);
              while ($field2 = $this->fetch_object($result2)) {
                $row2['idrkakl']   = $field2->IDRKAKL;
                $row2['jumlah']    = floatval($field2->JUMLAH);
                $row2['realisasi'] = floatval($field2->REALISASI);
                $totalRealisasi    = $row['realisasi']+$row2['realisasi'];
                $jumlahAnggaran    = $row2['jumlah']-$totalRealisasi;
              }
            }
            $newRealisasi = $totalRealisasi+$jumlahAnggaran;
            $query3 = "UPDATE rkakl_full SET REALISASI = '$newRealisasi' WHERE IDRKAKL = '$row2[idrkakl]' AND versi = (SELECT pre_versi FROM (SELECT MAX(versi) AS pre_versi FROM rkakl_view) AS tmp) AND THANG = '$tahun'";
            $result3 = $this->query($query3);
            return true;
          }
          else {
            $query3 = "UPDATE rkakl_full SET REALISASI = '$totalRealisasi' WHERE IDRKAKL = '$row2[idrkakl]' AND versi = (SELECT pre_versi FROM (SELECT MAX(versi) AS pre_versi FROM rkakl_view) AS tmp) AND THANG = '$tahun'";
            $result3 = $this->query($query3);
            return true;
          }
        }
      }
    }

    public function cekRealisasi($data){
      $query = "SELECT * FROM rkakl_full WHERE IDRKAKL = '$data' AND REALISASI IS NOT NULL";
      $result = $this->query($query);
      $data = array();
      if ($result->num_rows != 0) {
        while ($row = $this->fetch_object($result)) {
          $data['idrkakl']   = $row->IDRKAKL;
          $data['realisasi'] = $row->REALISASI;
        }
        return $data;
      }
      else {
        return $result->num_rows;
      }
    }

    public function cekRevisiStatus($tahun, $versi){
      $query  = "UPDATE rkakl_full SET STATUS = '0' WHERE THANG = '$tahun' AND VERSI < '$versi'";
      $result = $this->query($query);
    }

    public function importRkakl($data, $tahun=NULL) {
      $arrayCount = count($data);
      $string = "REPLACE INTO rkakl_full (IDRKAKL,THANG,KDDEPT,KDUNIT,KDPROGRAM,KDGIAT,NMGIAT,KDOUTPUT,NMOUTPUT,KDSOUTPUT,NMSOUTPUT,KDKMPNEN,NMKMPNEN,KDSKMPNEN,NMSKMPNEN,KDAKUN,NMAKUN,KDITEM,NMITEM,VOLKEG,SATKEG,HARGASAT,JUMLAH,REALISASI,USULAN,SDANA,STATUS,VERSI) VALUES ";
      $RKAKL[VERSI]   = $this->cekVersi($tahun);
      $RKAKL[THANG]   = $tahun;
      for ($i=2; $i <= $arrayCount; $i++) {
        $newvalue = '';
        $URAIAN   = trim($data[$i]["B"]," \t\n\r\0\x0B\xA0\x0D\x0A\x20");
        if (substr($URAIAN, 0, 1) == '-') {
          $REMCHAR = ltrim($URAIAN, '-');
          $URAIAN  = trim($REMCHAR," \t\n\r\0\x0B\xA0\x0D\x0A\x20");
        }
        $RKAKL[VOLUME] = trim($data[$i]["C"]," \t\n\r\0\x0B\xA0\x0D\x0A\x20");
        $RKAKL[SATUAN] = trim($data[$i]["D"]," \t\n\r\0\x0B\xA0\x0D\x0A\x20");
        $RKAKL[SATUAN] = stripslashes($RKAKL[SATUAN]);
        $RKAKL[HRGSAT] = trim($data[$i]["E"]," \t\n\r\0\x0B\xA0\x0D\x0A\x20");
        $RKAKL[JUMLAH] = trim($data[$i]["F"]," \t\n\r\0\x0B\xA0\x0D\x0A\x20");
        $RKAKL[STDANA] = trim($data[$i]["G"]," \t\n\r\0\x0B\xA0\x0D\x0A\x20");
        $KODE          = trim($data[$i]["A"]," \t\n\r\0\x0B\xA0\x0D\x0A\x20");
        $URAIAN        = str_replace("'", "", $URAIAN);
        $ELEMENT       = explode('.', $KODE);
        $FILTER        = array_filter($ELEMENT);
        if (ctype_digit($KODE) && $KODE >= '3000' && $KODE <= '10000') {
          unset($RKAKL[KDGIAT]);
          unset($RKAKL[NMGIAT]);
          unset($RKAKL[KDOUTP]);
          unset($RKAKL[NMOUTP]);
          unset($RKAKL[KDSOUT]);
          unset($RKAKL[NMSOUT]);
          unset($RKAKL[KDKMPN]);
          unset($RKAKL[NMKMPN]);
          unset($RKAKL[KDSKMP]);
          unset($RKAKL[NMSKMP]);
          unset($RKAKL[KDAKUN]);
          unset($RKAKL[NMAKUN]);
          $J = 0;
          unset($RKAKL[KDITEM]);
          unset($RKAKL[NMITEM]);
          $RKAKL[KDGIAT] = $KODE;
          $RKAKL[NMGIAT] = $URAIAN;
        }
        if (!empty($FILTER)) {
          if ($ELEMENT[0] == '092' && count($ELEMENT) == '3') {
            $RKAKL[KDDEPT] = $ELEMENT[0];
            $RKAKL[KDUNIT] = $ELEMENT[1]; 
            $RKAKL[KDPROG] = $ELEMENT[2];
            $RKAKL[NMPROG] = $URAIAN;
            $J = 0;
            unset($RKAKL[KDITEM]);
            unset($RKAKL[NMITEM]);
            unset($RKAKL[KDGIAT]);
            unset($RKAKL[NMGIAT]);
            unset($RKAKL[KDOUTP]);
            unset($RKAKL[NMOUTP]);
            unset($RKAKL[KDSOUT]);
            unset($RKAKL[NMSOUT]);
            unset($RKAKL[KDKMPN]);
            unset($RKAKL[NMKMPN]);
            unset($RKAKL[KDSKMP]);
            unset($RKAKL[NMSKMP]);
            unset($RKAKL[KDAKUN]);
            unset($RKAKL[NMAKUN]);
          }
          if ($ELEMENT[0] != '92' && count($ELEMENT) == '2') {
            $RKAKL[KDOUTP] = $ELEMENT[1];
            $RKAKL[NMOUTP] = $URAIAN;
            unset($RKAKL[KDSOUT]);
            unset($RKAKL[NMSOUT]);
            unset($RKAKL[KDKMPN]);
            unset($RKAKL[NMKMPN]);
            unset($RKAKL[KDSKMP]);
            unset($RKAKL[NMSKMP]);
            unset($RKAKL[KDAKUN]);
            unset($RKAKL[NMAKUN]);
            $J = 0;
            unset($RKAKL[KDITEM]);
            unset($RKAKL[NMITEM]);
          }
          if ($ELEMENT[0] != '92' && count($ELEMENT) == '3') {
            $RKAKL[KDSOUT] = $ELEMENT[2];
            $RKAKL[NMSOUT] = $URAIAN;
            unset($RKAKL[KDKMPN]);
            unset($RKAKL[NMKMPN]);
            unset($RKAKL[KDSKMP]);
            unset($RKAKL[NMSKMP]);
            unset($RKAKL[KDAKUN]);
            unset($RKAKL[NMAKUN]);
            $J = 0;
            unset($RKAKL[KDITEM]);
            unset($RKAKL[NMITEM]);
          }
        }
        if (ctype_digit($KODE) && $KODE >= '0' && $KODE <= '100') {
          $RKAKL[KDKMPN] = $KODE;
          $RKAKL[NMKMPN] = $URAIAN;
          unset($RKAKL[KDSKMP]);
          unset($RKAKL[NMSKMP]);
          unset($RKAKL[KDAKUN]);
          unset($RKAKL[NMAKUN]);
          $J = 0;
          unset($RKAKL[KDITEM]);
          unset($RKAKL[NMITEM]);
        }
        if (ctype_alpha($KODE)) {
          $RKAKL[KDSKMP] = $KODE;
          $RKAKL[NMSKMP] = $URAIAN;
          unset($RKAKL[KDAKUN]);
          unset($RKAKL[NMAKUN]);
          $J = 0;
          unset($RKAKL[KDITEM]);
          unset($RKAKL[NMITEM]);
        }
        if (ctype_digit($KODE) && $KODE >= '500000' && $KODE <= '600000') {
          $RKAKL[KDAKUN] = $KODE;
          $RKAKL[NMAKUN] = $URAIAN;
          $J = 0;
          unset($RKAKL[KDITEM]);
          unset($RKAKL[NMITEM]);
        }
        if ($KODE == '') {
          $J = $J + 1;
          $RKAKL[KDITEM] = $J;
          $RKAKL[NMITEM] = $URAIAN;
        }
        foreach($RKAKL as $key => $value){
          if("KD" == substr($key,0,2)){
            if ($value != "") {
              $newvalue .= $value.".";
            }
          }
        }
        $newvalue  = substr($newvalue,0,-1);
        $RKAKL[IDRKAKL] = $newvalue;
        if ($RKAKL[THANG] > date("Y")) {
          $RKAKL[STATUS] = 2;
        }
        elseif ($RKAKL[THANG] < date("Y")) {
          $RKAKL[STATUS] = 0;
        }
        else {
          $RKAKL[STATUS] = 1;
        }
        $string .= "('".$RKAKL[IDRKAKL]."','".$RKAKL[THANG]."','".$RKAKL[KDDEPT]."','".$RKAKL[KDUNIT]."','".$RKAKL[KDPROG]."','".$RKAKL[KDGIAT]."','".$RKAKL[NMGIAT]."','".$RKAKL[KDOUTP]."','".$RKAKL[NMOUTP]."','".$RKAKL[KDSOUT]."','".$RKAKL[NMSOUT]."','".$RKAKL[KDKMPN]."','".$RKAKL[NMKMPN]."','".$RKAKL[KDSKMP]."','".$RKAKL[NMSKMP]."','".$RKAKL[KDAKUN]."','".$RKAKL[NMAKUN]."','".$RKAKL[KDITEM]."','".$RKAKL[NMITEM]."','".$RKAKL[VOLUME]."','".$RKAKL[SATUAN]."','".$RKAKL[HRGSAT]."','".$RKAKL[JUMLAH]."','".$RKAKL[REALISASI]."','".$RKAKL[USULAN]."','".$RKAKL[STDANA]."','".$RKAKL[STATUS]."','".$RKAKL[VERSI]."'),";
      }
      $string = str_replace("''", "NULL", $string);
      $query  = substr($string,0,-1);
      $result = $this->query($query);
      if ($tahun == date("Y") && $RKAKL[VERSI] != 0) {
        $this->cekRevisiStatus($tahun, $RKAKL[VERSI]);
      }
      $query = "DELETE FROM rkakl_full WHERE KDITEM IS NULL";
      $result= $this->query($query);
      $query = "DELETE FROM rkakl_full WHERE NMITEM LIKE '>%'";
      $result= $this->query($query);
      $query  = "CREATE TABLE rkakl_full_".$tahun."_".$RKAKL[VERSI]."
        AS (SELECT * FROM rkakl_full)
      ";
      $result= $this->query($query);
      return $result;
    }
  }

?>
