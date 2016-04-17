  <div class="container-fluid">
    <div class="main">        
      <div class="row">
        <div class="col-sm-6">
          <div class="content-box">
            <div class="content-box-header dark-green">
              TARGET DAN REALISASI ANGGARAN PEMBANGUNAN TAHUN ANGGARAN 2015
            </div>
            <div class="content-box-body">
              <canvas id="canvas1"></canvas>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="content-box">
            <div class="content-box-header dark-green">
              TARGET DAN REALISASI ANGGARAN PEMBANGUNAN TAHUN ANGGARAN 2015
            </div>
            <div class="content-box-body">
              <canvas id="canvas2"></canvas>
            </div>
          </div>
        </div>
      </div> <!-- end of row -->


      <div class="row" style="display: none;">
        <div class="col-sm-12">
          <div class="content-box">
            <div class="content-box-header dark-green">
              2015
            </div>
            <div class="content-box-body">
              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#triwulan1" aria-controls="triwulan1" role="tab" data-toggle="tab">Triwulan I</a></li>
                <li role="presentation"><a href="#triwulan2" aria-controls="triwulan2" role="tab" data-toggle="tab">Triwulan II</a></li>
                <li role="presentation"><a href="#triwulan3" aria-controls="triwulan3" role="tab" data-toggle="tab">Triwulan III</a></li>
                <li role="presentation"><a href="#triwulan4" aria-controls="triwulan4" role="tab" data-toggle="tab">Triwulan IV</a></li>
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="triwulan1">1</div>
                <div role="tabpanel" class="tab-pane" id="triwulan2">2</div>
                <div role="tabpanel" class="tab-pane" id="triwulan3">3</div>
                <div role="tabpanel" class="tab-pane" id="triwulan4">4</div>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- end of row -->

    </div> <!-- end of main class -->
    <div class="footer">Powered By BBSDM Team : <b><a href='<?php echo $base_content ?>'>Susunan Redaksi</a></b> </div>
  </div><!-- end of container -->


  <!-- dummy chart js javascript -->
  <script>
    var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
    var ChartData = {
      labels : ["January","February","March","April","May","June","July"],
      datasets : [
        {
          label: "My First dataset",
          fillColor : "rgba(220,220,220,0.2)",
          strokeColor : "rgba(220,220,220,1)",
          pointColor : "rgba(220,220,220,1)",
          pointStrokeColor : "#fff",
          pointHighlightFill : "#fff",
          pointHighlightStroke : "rgba(220,220,220,1)",
          data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
        },
        {
          label: "My Second dataset",
          fillColor : "rgba(151,187,205,0.2)",
          strokeColor : "rgba(151,187,205,1)",
          pointColor : "rgba(151,187,205,1)",
          pointStrokeColor : "#fff",
          pointHighlightFill : "#fff",
          pointHighlightStroke : "rgba(151,187,205,1)",
          data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
        }
      ]
    }
  window.onload = function(){
    var ctx1 = document.getElementById("canvas1").getContext("2d");
    window.myLine = new Chart(ctx1).Line(ChartData, {
      responsive: true
    });
    var ctx2 = document.getElementById("canvas2").getContext("2d");
    window.myBar = new Chart(ctx2).Bar(ChartData, {
      responsive : true
    });
  }
  </script>
</body>
</html>