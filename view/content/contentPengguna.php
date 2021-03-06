<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Data Pengguna
      <small>Management Control</small>
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-table"></i> Data Pengguna</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title" style="margin-top:6px;">Tabel Grup</h3>
            
            <a href="<?php echo $url_rewrite;?>content/addgroup" class="btn btn-flat btn-success btn-sm pull-right">Tambah Grup</a>
          </div>
          <div class="box-body">
            <?php include "view/include/contentAlert.php" ?>
            <table id="table-group" class="display nowrap table table-bordered table-striped" cellspacing="0" width="100%">
              <thead style="background-color:#2B91CF;color:white;">
                <tr>
                  <th>Id</th>
                  <th>Kode</th>
                  <th>Nama</th>
                  <th>Kewenangan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>  
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title" style="margin-top:6px;">Tabel Pengguna</h3>
            <a href="<?php echo $base_content;?>addpengguna" class="btn btn-flat btn-success btn-sm pull-right">Tambah Pengguna</a>
          </div>
          <div class="box-body">
            <?php include "view/include/contentAlert.php" ?>
            <table id="table" class="display nowrap table table-bordered table-striped" cellspacing="0" width="100%">
              <thead style="background-color:#2B91CF;color:white;">
                <tr>
                  <th>Id</th>
                  <th>Nama</th>
                  <th>Status</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Kewenangan</th>
                  <th>Nama Grup</th>
                  <th>Aksi</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>        
      </div>
    </div>
  </section>
</div>
<div class="modal fade" id="editModalGroup">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="<?php echo $base_process;?>pengguna/edit-group" id="edit-group-form">
        <div class="modal-header" style="background-color:#2B91CF !important; color:white;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:white">×</span></button>
          <h4 class="modal-title">Edit Grup</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="id-group"></input>
          <div class="form-group">
            <input type="text" class="form-control" id="kode" name="kode" placeholder="Kode Grup" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="nama-group" name="name" placeholder="Nama Grup" required>
          </div>
          
          <!-- <div class="form-group">
            <select class="form-control" id="kdprogram" name="kdprogram" required>
              <option value="" disabled selected>-- Pilih Kode Program --</option>
              <?php foreach ($kdprog as $value){ ?>
                  <option value="<?php echo $value ?>"><?php echo $value ?></option>
                     

                   <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <select class="form-control" id="direktorat" name="direktorat" required>
              <option value="" disabled selected>-- Pilih Direktorat --</option>
            </select>
          </div> -->
          <div class="well" data-toggle="tooltip" data-placement="top" title="Kode Direktorat" >

                <div class="row text-center" data-toggle="popover" data-placement="left" data-content="Isi Kode Program" id="row-kdprogram">
                  <label>Kode Program</label>
                </div>
                <div class="row text-center">
                  <?php foreach ($kdprog as $value){ ?>
                     <div class=" col-md-4 ">
                      <div class="checkbox">
                        <label><input type="checkbox" value="<?php echo $value ?>" name="kdprogram[]" class="kdprog" data-toggle="toggle"> <?php echo $value ?></label>
                      </div>
                    </div>

                   <?php } ?>
                   
                    
                </div>
              </div> 
              <div class="well" data-toggle="tooltip" data-placement="top" title="Kode Direktorat" >

                <div class="row text-center" data-toggle="popover" data-placement="left" data-content="Isi Kode Direktorat" id="row-direktorat">
                  <label>Direktorat</label>
                </div>
                <div class="row text-center" id="kdgiat-div">
                  
                   
                    
                </div>
              </div>
          <div class="well" data-toggle="tooltip" data-placement="top" title="Kode Output">

                <div class="row text-center" data-toggle="popover" data-placement="left" data-content="Isi Kode Output" id="row-kdoutput">
                  <label>Kode Output</label>
                </div>
                <div class="row text-center" id="kdoutput-div">
                  
                   
                    
                </div>
              </div>
          
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-flat btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="<?php echo $base_process;?>pengguna/edit">
        <div class="modal-header" style="background-color:#2B91CF !important; color:white;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:white">×</span></button>
          <h4 class="modal-title">Edit Pengguna</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="id"></input>
          <div class="form-group">
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required>
          </div>
          <div class="form-group">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
          </div>
          <div class="form-group">
            <div class="checkbox " style="position:absolute;margin:6px;right:16px;background:white;">
              <input type="checkbox" id="checkuser">  
            </div>
            <input type="text" class="form-control" id="username" name="username" placeholder="Username" disabled>
          </div>
          <div class="form-group">
            <div class="checkbox " style="position:absolute;margin:6px;right:16px;background:white;">
              <input type="checkbox" id="checkpass">
            </div>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" disabled>
          </div>
          <div class="form-group">
            <select class="form-control" id="level" name="level" required>
              <option value="" disabled selected>-- Pilih Kewenangan --</option>
              <option value="2">Operator</option>
              <option value="3">Asisten Operator</option>
            </select>
          </div>
          <div class="form-group">
            <select class="form-control" name="direktorat" data-toggle="tooltip" data-placement="top" title="Group" id="group-select" required>
              <option value="" disabled selected>-- Pilih Grup --</option>
              <?php foreach ($group as $key => $value){ ?>
              <option value="<?php echo $key ?>"><?php echo $key." - ".$value ?></option>
                 

               <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <select class="form-control" id="status" name="status" required>
              <option value="" disabled selected>-- Pilih Status Akun --</option>
              <option value="1">Aktif</option>
              <option value="0">Tidak Aktif</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-flat btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="hapusModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="<?php echo $base_process;?>pengguna/delete">
        <div class="modal-header" style="background-color:#d33724 !important; color:white;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:white">×</span></button>
          <h4 class="modal-title">Hapus Pengguna</h4>
        </div>
        <div class="modal-body">
          <p>Anda yakin ingin menghapus pengguna ini?</p>
          <input type="hidden" name="id" id="modid"></input>
          <table>
            <tr>
              <td>Nama</td>
              <td>&nbsp;:&nbsp;</td>
              <td id="modnama"></td>
            </tr>
            <tr>
              <td>Email</td>
              <td>&nbsp;:&nbsp;</td>
              <td id="modemail"></td>
            </tr>
            <tr>
              <td>Kewenangan</td>
              <td>&nbsp;:&nbsp;</td>
              <td id="modkewenangan"></td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-flat btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="hapusModalGroup">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="<?php echo $base_process;?>pengguna/deletegroup">
        <div class="modal-header" style="background-color:#d33724 !important; color:white;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:white">×</span></button>
          <h4 class="modal-title">Hapus Group</h4>
        </div>
        <div class="modal-body">
          <p>Anda yakin ingin menghapus group ini?</p>
          <input type="hidden" name="id" id="modidgroup"></input>
          <table>
            <tr>
              <td>Kode</td>
              <td>&nbsp;:&nbsp;</td>
              <td id="modkodegroup"></td>
            </tr>
            <tr>
              <td>Nama</td>
              <td>&nbsp;:&nbsp;</td>
              <td id="modnamagroup"></td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-flat btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  $(function () {


    $(document).on('change','.kdprog', function(){
      chDirektorat();
    });

    $(document).on('change','.kdgiat', function(){
      chOutput();
    });

    $('#checkuser').on('ifChecked', function(){
      $("#username").removeAttr("disabled");
      $("#username").attr("required",true);
    });
    $('#checkpass').on('ifChecked', function(){
     $("#password").removeAttr("disabled");
     $("#password").attr("required",true);
    });
    $('#checkuser').on('ifUnchecked', function(event){
      $("#username").attr("disabled",true);
    });
    $('#checkpass').on('ifUnchecked', function(){
     $("#password").attr("disabled",true);
    });
    var table = $("#table").DataTable({
      "oLanguage": {
        "sInfoFiltered": ""
      },
      "processing": true,
      "serverSide": true,
      "scrollX": true,
      "ajax": {
        "url": "<?php echo $base_process;?>pengguna/table",
        "type": "POST"
      },
      "columnDefs" : [
        {"targets" : 0,
         "visible" : false},
        {"targets" : 1},
        {"targets" : 2},
        {"targets" : 3},
        {"targets" : 4},
        {"targets" : 5},
        {"targets" : 6},
        {"orderable": false,
         "data": null,
         "defaultContent":  '<div class="text-center">'+
                              '<a style="margin:0 2px;" id="btn-edt" href="#editModal" class="btn btn-flat btn-success btn-sm" data-toggle="modal"><i class="fa fa-edit"></i> Edit</a>'+
                              '<a style="margin:0 2px;" id="btn-del" href="#hapusModal" class="open-deleteProject btn btn-flat btn-danger btn-sm" data-toggle="modal"><i class="fa fa-trash-o"></i> Hapus</a>'+
                            '</div>',
         "targets": 7 },
         {"targets" : 8,
         "visible" : false},
      ],
      "order": [[ 0, "desc" ]]
    });
    var table_group = $("#table-group").DataTable({
      "oLanguage": {
        "sInfoFiltered": ""
      },
      "processing": true,
      "serverSide": true,
      "scrollX": true,
      "ajax": {
        "url": "<?php echo $url_rewrite;?>process/pengguna/table-group",
        "type": "POST"
      },
      "columnDefs" : [
        {"targets" : 0,
         "visible" : false},
        {"targets" : 1},
        {"targets" : 2},
        {"targets" : 3,"visible" : false},
        {"orderable": false,
         "data": null,
         "defaultContent":  '<div class="text-center">'+
                              '<a style="margin:0 2px;" id="btn-edt-group" href="#editModalGroup" class="btn btn-flat btn-success btn-sm" data-toggle="modal"><i class="fa fa-edit"></i> Edit</a>'+
                              '<a style="margin:0 2px;" id="btn-del-group" href="#hapusModalGroup" class="open-deleteProject btn btn-flat btn-danger btn-sm" data-toggle="modal"><i class="fa fa-trash-o"></i> Hapus</a>'+
                            '</div>',
         "targets": 4 },
      ],
      "order": [[ 0, "desc" ]]
    });
    $(document).on("click", "#nonaktif", function (){
      var tr = $(this).closest('tr');
      tabrow = table.row( tr );
      row_id = tabrow.data()[0];
      $.ajax({
        type: "post",
        url : "<?php echo $base_process;?>pengguna/activate",
        data: {key:row_id},
        success: function(data)
        {
          table.draw();
        }
      });
      return false;
    });
    $(document).on("click", "#aktif", function (){
      var tr = $(this).closest('tr');
      tabrow = table.row( tr );
      row_id = tabrow.data()[0];
      $.ajax({
        type: "post",
        url : "<?php echo $base_process;?>pengguna/deactivate",
        data: {key:row_id},
        success: function(data)
        {
          table.draw();
        }
      });
      return false;
    });
    $(document).on("click", "#btn-edt", function (){
      var tr = $(this).closest('tr');
      tabrow = table.row( tr );
      $("#id").val(tabrow.data()[0]);
      $("#nama").val(tabrow.data()[1]);
      $("#username").val(tabrow.data()[3]);
      $("#email").val(tabrow.data()[4]);
      $("#level").val(tabrow.data()[7]);
      $("#status").val(tabrow.data()[8]);
    });
    $(document).on("click", "#btn-edt-group", function (){
      $( ".kdprog" ).attr("checked",false);
      $( "#kdgiat-div" ).html("");
      $( "#kdoutput-div" ).html("");

      var kdprogram = [];
      var kdgiat =[];
      var kdoutput = [];
      var tr = $(this).closest('tr');
      var tabrow = table_group.row( tr );
      var kewenangan = tabrow.data()[3].split(",");

      // alert(JSON.stringify(tabrow.data()));
      $.each(kewenangan,function(i, val){
        var splitted = val.split("-");
          
          if($.inArray(splitted[0],kdprogram)==-1){
            kdprogram.push(splitted[0]);
          }
          if($.inArray(splitted[1],kdgiat)==-1){
            kdgiat.push(splitted[0]+'-'+splitted[1]);
          }
          if($.inArray(splitted[2],kdoutput)==-1){
            kdoutput.push(splitted[2]);
          }

        
      });
      // alert(JSON.stringify(tabrow.data()));
      $.each(kdprogram,function(i, val){
        $('.kdprog[value="'+val+'"]').attr('checked',true);
      });
      // alert(JSON.stringify(kdgiat));
      chDirektorat(kdprogram,kdgiat);

      chOutput(kdprogram,kdgiat,kewenangan);

      $("#id-group").val(tabrow.data()[0]);
      $("#kode").val(tabrow.data()[1]);
      $("#nama-group").val(tabrow.data()[2]);
    });

    $(document).on("click", "#btn-del", function (){
      var tr = $(this).closest('tr');
      tabrow = table.row( tr );
      $("#modid").val(tabrow.data()[0]);
      $("#modnama").text(tabrow.data()[1]);
      $("#modemail").text(tabrow.data()[4]);
      $("#modkewenangan").text(tabrow.data()[5]);
    });
    $(document).on("click", "#btn-del-group", function (){

      var tr = $(this).closest('tr');
      tabrow = table_group.row( tr );
      // alert(JSON.stringify(tabrow));
      $("#modidgroup").val(tabrow.data()[1]);
      $("#modnamagroup").html(tabrow.data()[2]);
      $("#modkodegroup").html(tabrow.data()[1]);
      // alert(tabrow.data()[1]);
    });
  });


  function chDirektorat(kdprog=[],direktorat=[]){

    var values=[];
    if(kdprog.length==0){
      $.each($('input:checkbox.kdprog:checked'), function() {
      values.push($(this).val());
        // or you can do something to the actual checked checkboxes by working directly with  'this'
        // something like $(this).hide() (only something useful, probably) :P
      });
    } else {
      $.each(kdprog, function(i, val) {
      values.push(val);
        // or you can do something to the actual checked checkboxes by working directly with  'this'
        // something like $(this).hide() (only something useful, probably) :P
      });
    }
    
    if(values.length!=0){
      $.ajax({
        type: "POST",
        url: "<?php echo $base_process;?>kegiatan/getDirektorat",
        data: { 'prog' : values
              },
        success: function(data){
          var obj = jQuery.parseJSON(data);
          var ckbx = '';
          // alert(JSON.stringify(direktorat));
          for (var i = 0; i < obj.KDGIAT.length; i++) {
            // $ckbx = $ckbx + '<option value="'+obj.KDGIAT[i]+'"">'+obj.KDGIAT[i]+' - '+obj.NMGIAT[i]+'</option>';
            if($.inArray(obj.KDPROGRAM[i]+'-'+obj.KDGIAT[i],direktorat)==-1){
              ckbx+=' <div class=" col-md-4 ">'+
                      '<div class="checkbox">'+
                        '<label><input type="checkbox" class="kdgiat" name="direktorat[]" value="'+obj.KDPROGRAM[i]+'-'+obj.KDGIAT[i]+'"> '+obj.KDGIAT[i]+' - '+obj.NMGIAT[i]+' ('+obj.KDPROGRAM[i]+')</label>'+
                      '</div>'+
                    '</div>';
            } else {
                ckbx+=' <div class=" col-md-4 ">'+
                      '<div class="checkbox">'+
                        '<label><input type="checkbox" class="kdgiat" name="direktorat[]" value="'+obj.KDPROGRAM[i]+'-'+obj.KDGIAT[i]+'" checked> '+obj.KDGIAT[i]+' - '+obj.NMGIAT[i]+' ('+obj.KDPROGRAM[i]+')</label>'+
                      '</div>'+
                    '</div>';
            }
            
          };
          $('#kdgiat-div').html(ckbx);

          
          // alert(tabrow.data()[7]);
          // if(direktorat!=null)
          // $("#direktorat").val(direktorat);
          // $('.kdgiat').iCheck({
          //    checkboxClass: 'icheckbox_square-blue'
          // });
        }
      });
      
    } else {
      $('#kdgiat-div').html('');
      $('#kdoutput-div').html("");
    }
    
  }

  function chOutput(kdprog=[],direktorat=[],kdoutput=[]){
    var values=[];
    var values2=[];
    var arrKdoutput = [];
    if(kdprog.length==0){
      $.each($('input:checkbox.kdprog:checked'), function() {
        values.push($(this).val());
        // or you can do something to the actual checked checkboxes by working directly with  'this'
        // something like $(this).hide() (only something useful, probably) :P
      });
    } else {
      $.each(kdprog, function(i, val) {
        values.push(val);
        // or you can do something to the actual checked checkboxes by working directly with  'this'
        // something like $(this).hide() (only something useful, probably) :P
      });
    }

    if(direktorat.length==0){
      $.each($('input:checkbox.kdgiat:checked'), function() {
        values2.push($(this).val());
        // or you can do something to the actual checked checkboxes by working directly with  'this'
        // something like $(this).hide() (only something useful, probably) :P
      });
    } else {
      $.each($(direktorat), function(i,val) {
        values2.push(val);
        // or you can do something to the actual checked checkboxes by working directly with  'this'
        // something like $(this).hide() (only something useful, probably) :P
      });
    }
    
    // alert(values2);
    // if(kdoutput!=null){
    //   arrKdoutput = kdoutput.split(",");

    // }
    // alert(JSON.stringify(arrKdoutput));
    // alert(JSON.stringify(kdoutput));
    if(values.length!=0 && values2.length!=0){
      $.ajax({
        type: "POST",
        url: "<?php echo $base_process;?>kegiatan/getout2",
        data: { 'prog' : values,
                'direktorat' :values2
              },
        success: function(data){
          // alert(JSON.stringify(jQuery.parseJSON(data)));
          var obj = jQuery.parseJSON(data);
          var ckbx = "";
          for (var i = 0; i < obj.KDOUTPUT.length; i++) {
            var val =  obj.KDPROGRAM[i]+'-'+obj.KDGIAT[i]+'-'+obj.KDOUTPUT[i];
            if($.inArray(val,kdoutput)==-1){

              ckbx= ckbx+' <div class=" col-md-4 ">'+
                      '<div class="checkbox">'+
                        '<label><input type="checkbox" id="kdoutput" class="kdoutput" name="kdoutput[]" value="'+obj.KDPROGRAM[i]+'-'+obj.KDGIAT[i]+'-'+obj.KDOUTPUT[i]+'"> '+obj.KDOUTPUT[i]+' - '+obj.NMOUTPUT[i]+' ('+obj.KDPROGRAM[i]+'-'+obj.KDGIAT[i]+')</label>'+
                      '</div>'+
                    '</div>';
            } else {


              ckbx= ckbx+' <div class=" col-md-4 ">'+
                      '<div class="checkbox">'+
                        '<label><input type="checkbox" id="kdoutput" class="kdoutput" name="kdoutput[]" value="'+obj.KDPROGRAM[i]+'-'+obj.KDGIAT[i]+'-'+obj.KDOUTPUT[i]+'" checked> '+obj.KDOUTPUT[i]+' - '+obj.NMOUTPUT[i]+' ('+obj.KDPROGRAM[i]+'-'+obj.KDGIAT[i]+')</label>'+
                      '</div>'+
                    '</div>';
            }
          };
          $('#kdoutput-div').html(ckbx);

          // $('.kdoutput').iCheck({
          //    checkboxClass: 'icheckbox_square-blue'
          // });
        }
      });
      
    } else {
      $('#kdoutput-div').html("");
    }
    
  }
</script>