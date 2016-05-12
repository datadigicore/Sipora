<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Cetak Laporan
      <small>Menu</small>
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-file-text-o"></i> Cetak Laporan</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1">
        <div class="nav-tabs-custom">
          <ul class="nav nav-pills nav-justified" style="border-bottom: 1px solid #f4f4f4">
            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><b>Realisasi Anggaran dan Kinerja</b></a></li>
            <li ><a href="#tab_2" data-toggle="tab" aria-expanded="true"><b>Rekap Realisasi Daya Serap Per kegiatan</b></a></li>
            <li ><a href="#tab_3" data-toggle="tab" aria-expanded="true"><b>Rekap Total Realisasi Daya Serap</b></a></li>
          </ul>
          <div class="tab-content" style="padding:0 0;">
            <div class="tab-pane active" id="tab_1">
              <form class="form-horizontal" method="POST" action="<?php echo $base_process ?>laporan/Daya_Serap">
                <div class="row">
                  <div class="box-body well col-sm-6 col-sm-offset-3" style="padding-bottom:0;">
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Direktorat</label>
                      <div class="col-sm-8">
                      <select style="margin:5px auto" class="form-control select2" class="direktorat" name="direktorat" required>
                        <option value="" disabled selected>-- Pilih Direktorat --</option>
                        <?php $report->selectDirektorat(); ?>
                      </select>
                    </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Triwulan</label>
                      <div class="col-sm-8">
                        <select style="margin:5px auto" class="form-control" id="bulan" name="bulan" onchange="" >
                          <?php $report->selectTriwulan(); ?>
                        </select>
                    </div>               
                    </div>               
                  </div>
                </div>
                <div class="box-footer">
                  <div class="col-sm-9">
                    <button type="submit" class="btn btn-flat btn-success pull-right col-sm-2"><i class="fa fa-print"></i> Cetak</button>
                  </div>
                </div>        
              </form>
            </div>
            <div class="tab-pane" id="tab_2">
              <form class="form-horizontal" method="POST" action="<?php echo $base_process ?>laporan/Rekap_Daya_Serap">
                <div class="row">
                  <div class="box-body well col-sm-6 col-sm-offset-3" style="padding-bottom:0;">
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Direktorat</label>
                      <div class="col-sm-8">
                      <select style="margin:5px auto" class="form-control select2" class="direktorat" name="direktorat" required>
                        <option value="" disabled selected>-- Pilih Direktorat --</option>
                        <?php $report->selectDirektorat(); ?>
                      </select>
                    </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Triwulan</label>
                      <div class="col-sm-8">
                        <select style="margin:5px auto" class="form-control" id="bulan" name="bulan" onchange="" >
                          <?php $report->selectTriwulan(); ?>
                        </select>
                    </div>               
                    </div>               
                  </div>
                </div>
                <div class="box-footer">
                  <div class="col-sm-9">
                    <button type="submit" class="btn btn-flat btn-success pull-right col-sm-2"><i class="fa fa-print"></i> Cetak</button>
                  </div>
                </div>        
              </form>
            </div>
            <div class="tab-pane" id="tab_3">
              <form class="form-horizontal" method="POST" action="<?php echo $base_process ?>laporan/serapan">
                <div class="row">
                  <div class="box-body well col-sm-6 col-sm-offset-3" style="padding-bottom:0;">
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Direktorat</label>
                      <div class="col-sm-8">
                      <select style="margin:5px auto" class="form-control select2" class="direktorat" name="direktorat" required>
                        <option value="" disabled selected>-- Pilih Direktorat --</option>
                        <?php $report->selectDirektorat(); ?>
                      </select>
                    </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Triwulan</label>
                      <div class="col-sm-8">
                        <select style="margin:5px auto" class="form-control" id="bulan" name="bulan" onchange="" >
                          <?php $report->selectTriwulan(); ?>
                        </select>
                    </div>               
                    </div>               
                  </div>
                </div>
                <div class="box-footer">
                  <div class="col-sm-9">
                    <button type="submit" class="btn btn-flat btn-success pull-right col-sm-2"><i class="fa fa-print"></i> Cetak</button>
                  </div>
                </div>       
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script>
  $(document).ready(function() {
    kodeAkun("kode-akun");
    penerima("a");
    $("#add-more-akun").click(function(){
      $("#div-tambah-akun").show();
    });
    $("#buat-akun").click(function(){
      var val = $("#kode-akun").val();
      //$("#"+val).show();
      generateForm(val);
      $("#kode-akun").val('');
      $("#kode-akun option[value='"+val+"']").hide();
    });
    $(document).on("click",".btn-dismiss",function(){
      var val = $(this).attr("value");
      //alert(val);
      $("#"+val).remove();
      $("#kode-akun option[value='"+val+"']").show();
    });
    getdatepicker();
  });

  function getdatepicker(){
    $(".tanggal").datepicker({ 
      changeMonth: true,
      changeYear: true,
      format: 'dd/mm/yyyy' 
    });
  }


  function generateForm(kdAkun){
    var form_header = '<div class="row" id="'+kdAkun+'">'+
    '<div class="col-xs-12">'+
      '<div class="box">'+
        
        '<div class="box-body">'+
          
          '<div class="panel panel-default" >'+
                     '<div class="panel-heading te-panel-heading">'+
                          '<i class="glyphicon glyphicon-th-large"></i> <span>Belanja Honor Ouput Kegiatan</span>'+
                          '<button class="btn btn-danger btn-dismiss" id="close-'+kdAkun+'" value="'+kdAkun+'" ><i class="fa fa-close"></i></button>'+
                     '</div>'+

                     '<div class="clearfix"></div>'+

                     '<div class="panel-body">'+
                      
                      '<form action="#" method="POST" class="form-horizontal" name="form-'+kdAkun+'" id="form-'+kdAkun+'">';
        var isi ="";
        var form_footer= '<a class="btn btn-primary" type="submit" id="">Simpan Akun</a>'+
                      '</form>'+
                    '</div>'+
                    '</div>'+
        '</div>'+
      '</div>'+        
    '</div>'+
  '</div>';
        $.ajax({
          method: "GET",
          url: "<?php echo $url_rewrite?>/ajax/show_item.php",
          data: { kdAkun: kdAkun, }
        })
        .done(function( r ) {
            r=JSON.parse(r);
            if(r!=null){
              $.each( r, function( key, value ) {
                //alert( key + ": " + value );
                isi = isi+ '<div class="form-group ">'+
                               '<label class="col-md-3 control-label">'+value+'</label>'+
                               '<div class="col-md-9">'+
                                    '<input type="text" class="form-control" value="" id="'+kdAkun+'-'+key+'" name="'+kdAkun+'-'+key+'" placeholder="'+value+'">'+
                               '</div>'+
                          '</div>';
              });
              $("#panel-akun").append(form_header+isi+form_footer);
            } else {
              alert("Tidak terdapat item pada kode akun yang anda pilih");
            }
          });    
                          
        
  
  }
  function kodeAkun(idSelector){
      var id_rabfull = $('#id_rabfull').val();
      var isi ="<option>-- Pilih Kode Akun --</option>";
      $.ajax({
        method: "GET",
        url: "<?=$url_rewrite?>ajax/select_akun_SPTB.php",
        data: { 'id_rabfull': id_rabfull, }
      })
      .done(function(data){
        obj=JSON.parse(data);
        if(obj!=null){
          $.each( obj, function( key, value ) {
            isi = isi+ '<option value="'+key+'">'+key+' - '+value+'</option>';
          });
          $("#kode-akun").append(isi);
        }
      });
    }  

    function penerima(idSelector){
      var id_rabfull = $('#id_rabfull').val();
      var isi ="<option>-- Pilih Penerima --</option>";
      $.ajax({
        method: "GET",
        url: "<?=$url_rewrite?>ajax/list_orang.php",
        data: { 'id_rabfull': id_rabfull, }
      })
      .done(function(data){
        obj=JSON.parse(data);
        if(obj!=null){
          $.each( obj, function( key, value ) {
            isi = isi+ '<option value="'+key+'">'+value+'</option>';
          });
          $("#penerima").append(isi);
        }
      });
    }
  $(function () {
    $('#table').DataTable({
      "scrollX": true
    });
  });
</script>