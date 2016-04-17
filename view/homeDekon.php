  <div class="container-fluid">
    <div class="main">    
      <div class="row"> 
        <div class="col-sm-12">
          <div id="modal" class="modal-window"></div>         
          <div class="content-box bg-skyblue">
            <div class='content-box-body'>
              <?php 
                $result                = $home->infoTriwulanDekon();
                $status_triwulan_dekon = 'Triwulan '.$result['status_triwulan'];
                $tanggal_akhir_dekon   = $utility->format_tanggal($result['tanggal_akhir']);
              ?>            
              <strong><p class="nomargin">Batas Akhir Pelaporan Evaluasi Dekon Triwulan <?php echo $status_triwulan_dekon ." : ". $tanggal_akhir_dekon ;?></p></strong>
            </div>
          </div>  
          <div class="content-box">
            <div class="content-box-header dark-green">
              Status Pencapaian Anggaran Dekon
            </div>    
            <div class='content-box-body'>
              <?php 
                $result                = $home->statusTriwulan();
                $status_triwulan_aktif = $result[0];
                $tahun_skg             = date('Y');
                $home->realisasiDekonProv($status_triwulan_aktif, $tahun_skg);
              ?>
            </div>           
          </div>
        </div>
      </div><!-- end of row -->
    </div><!-- end of main class -->
    <div class="footer">Powered By BBSDM Team : <b><a href='<?php echo $base_content ?>'>Susunan Redaksi</a></b> </div>
  </div><!-- end of container -->
</body>
</html>