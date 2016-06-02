  <div class="container-fluid">
    <div class="main">    
      <div class="row"> 
        <div class="col-sm-12">
          <div id="modal" class="modal-window"></div>
          <div class="col-sm-3">
            <div class="panel panel-default">
              <div class="content-box-header dark-green">
                Berita Terkait
              </div>
              <div class="list-group">
              <?php
              foreach ($arrBeritaTerkait[id] as $key => $value) { ?>
                <a href="#" class="list-group-item"><?php echo $arrBeritaTerkait[judul][$key] ?></a>
                <?php
              }

              ?>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="content-box-header dark-green">
                Berita Kementerian
              </div>
              <div class="list-group">
              <?php
              foreach ($arrBeritaKementerian[id] as $key => $value) { ?>
                <a target="_blank" href="<?php echo $arrBeritaKementerian[isi][$key] ?>" class="list-group-item"><?php echo $arrBeritaKementerian[judul][$key] ?></a>
                <?php
              }

              ?>
                
              </div>
            </div>
          </div>
          <div class="col-sm-9">
            <div class="content-box">
              <div class="content-box-header dark-green">
                <label><?php echo $arrBerita[tanggal][$key] ?></label>
              </div>
              <div class="content-box-body">
              <?php 
              foreach ($arrBerita[id] as $key => $value) { ?>
                
                <div class="row">
                  <article class="col-xs-12">
                    <div class="media">
                      <div class="media-body">
                        <h2 class="media-heading"><a href="#"><?php echo $arrBerita[judul][$key] ?></a></h2>
                        
                        <hr>
                        <p><?php echo $arrBerita[isi][$key] ?></p>            
                      <ul class="list-inline pull-right">
                      </ul>
                      </div>
                    </div>
                  </article>
                </div>
                <hr>
                <?php
              }

              ?>
                

                
              </div>
            </div>
          </div>
          
        </div>
      </div><!-- end of row -->
    </div><!-- end of main class -->
    <div class="footer">Powered By BBSDM Team : <b><a href='<?php echo $base_content ?>'>Susunan Redaksi</a></b></div>
  </div><!-- end of container -->
</body>
<script type="text/javascript">
  $(document).ready(function() {
    $('#calendar').fullCalendar({
      header: {
        left : '',
        center: 'title',
        right: 'prev,next'
      }
    })
  });
</script>
<style type="text/css">
  .fc h2 {
     font-size: 24px;
  }
</style>
</html>