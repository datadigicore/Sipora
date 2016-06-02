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
                <a href="#" class="list-group-item">Resource Taxing</a>
                <a href="#" class="list-group-item">Premier Niche Markets <span class="badge">New</span></a>
                <a href="#" class="list-group-item">Dynamically Innovate</a>
                <a href="#" class="list-group-item">Objectively Innovate</a>
                <a href="#" class="list-group-item">Proactively Envisioned</a>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="content-box-header dark-green">
                Berita Kementerian
              </div>
              <div class="list-group">
                <a href="#" class="list-group-item">Resource Taxing</a>
                <a href="#" class="list-group-item">Premier Niche Markets <span class="badge">New</span></a>
                <a href="#" class="list-group-item">Dynamically Innovate</a>
                <a href="#" class="list-group-item">Objectively Innovate</a>
                <a href="#" class="list-group-item">Proactively Envisioned</a>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="content-box">
              <div class="content-box-header dark-green">
                Berita Utama
              </div>
              <div class="content-box-body">
                <div class="row">
                  <article class="col-xs-12">
                    <div class="media">
                      <div class="media-body">
                        <h2 class="media-heading"><a href="#">Premier Niche Markets</a></h2>
                        <p>Phosfluorescently engage worldwide methodologies with web-enabled technology. Interactively coordinate proactive e-commerce via process-centric "outside the box" thinking. Completely pursue scalable customer service through sustainable potentialities.</p>            
                      <ul class="list-inline pull-right">
                        <li><a href="#">Selengkapnya</a></li>
                      </ul>
                      </div>
                    </div>
                  </article>
                </div>
                <hr>
                <div class="row">
                  <article class="col-xs-12">
                    <div class="media">
                      <div class="media-body">
                        <h2 class="media-heading"><a href="#">Proactively Envisioned</a></h2>
                        <p>Seamlessly visualize quality intellectual capital without superior collaboration and idea-sharing. Holistically pontificate installed base portals after maintainable products. Proactively envisioned multimedia based expertise and cross-media growth strategies.</p>
                      <ul class="list-inline pull-right">
                        <li><a href="#">Selengkapnya</a></li>
                      </ul>
                      </div>
                    </div>
                  </article>
                </div>
                <hr>      
                <div class="row">
                  <article class="col-xs-12">
                    <div class="media">
                      <div class="media-body">
                        <h2 class="media-heading"><a href="#">Completely Synergize</a></h2>
                        <p>Completely synergize resource taxing relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas. Dynamically innovate resource-leveling customer service for state of the art customer service.</p>  
                      <ul class="list-inline pull-right">
                        <li><a href="#">Selengkapnya</a></li>
                      </ul>
                      </div>
                    </div>
                  </article>
                </div>
                <hr>
                 <ul class="pagination pull-right" style="margin:0; margin-bottom:20px">
                  <li><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li><a href="#">5</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="panel panel-default">
              <div class="content-box-header dark-green">
                Pengumuman
              </div>
              <div class="panel-body">
                <form>
                  <div class="form-group">
                    <input type="text" class="form-control" id="uid" name="uid" placeholder="Username">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password">
                  </div>
                  <button type="submit" class="btn btn-default">Log In</button>
                </form>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="content-box-header dark-green">
                Agenda Kegiatan
              </div>
              <div class="panel-body">
                <div id='calendar'></div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="content-box-header dark-green">
                Sosial Media
              </div>
              <div class="list-group">
                <a href="#" class="list-group-item">Resource Taxing</a>
                <a href="#" class="list-group-item">Premier Niche Markets <span class="badge">New</span></a>
                <a href="#" class="list-group-item">Dynamically Innovate</a>
                <a href="#" class="list-group-item">Objectively Innovate</a>
                <a href="#" class="list-group-item">Proactively Envisioned</a>
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