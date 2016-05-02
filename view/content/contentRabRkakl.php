<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Data Rencana Kegiatan
      <small>Menu</small>
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-table"></i> <b>Data Kegiatan</b></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title" style="margin-top:6px;">Tabel Rencana Kegiatan</h3>
          </div>
          <div class="box-body">
            <?php include "view/include/contentAlert.php" ?>
            <div class="row">
              <div class="col-md-6">
                <table class="display table table-bordered table-striped">
                  <tr>
                    <td><label>Tahun</label></td>
                    <td>
                      <select class="form-control select2" name="tahun2" id="tahun2" required>
                        <?php $rab->getYear(); ?>
                      </select>
                    </td>
                  </tr>
                  <?php if ($_SESSION['direktorat'] == "") { ?>
                  <tr>
                    <td><label>Direktorat</label></td>
                      <td>
                        <select id="direktorat2" name="direktorat2" class="form-control" onchange="search()">
                          <option value="">Semua Direktorat</option>
                          <?php $rab->kdkegiatan(); ?>
                        </select>
                      </td>
                  </tr>
                  <?php } else{ ?>
                  <tr>
                    <td><label>Direktorat</label></td>
                    <td>
                      <label><?php echo $rab->kdkegiatanbyID($_SESSION['direktorat']);?></label>
                    </td>
                  </tr>
                  <?php } ?>
                </table>
              </div>
            </div>
            <table id="table" class="display table table-bordered table-striped " cellspacing="0" width="100%">
              <thead style="background-color:#2B91CF;color:white;">
                <tr>
                  <th>No</th>
                  <th width="15%">Direktorat</th>
                  <th width="10%">Output</th>
                  <th width="10%">Suboutput</th>
                  <th width="10%">Komponen</th>
                  <th width="10%">Subkomponen</th>
                  <th width="10%">Jumlah Pagu</th>
                  <th width="10%">Realisasi</th>
                  <th width="10%">Persentase Realisasi</th>
                  <th width="10%">Volume</th>
                  <th width="10%">Persentase Volume</th>
                  <th width="10%">Sisa Anggaran</th>
                  <th width="5%">Aksi</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<div class="modal fade" id="mdl-vol">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo $url_rewrite;?>process/rab/revisi" method="POST">
        <div class="modal-header" style="background-color:#2B91CF !important; color:white;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:white">×</span></button>
          <h4 class="modal-title">Dialog Box</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" id="id_rab_rev" name="id_rab_rev" value="" />
          <div class="form-group">
            <label>Maximum Volume Kegiatan Seluruh Kegiatan</label>
          </div>
          <div class="form-group">
            <label>Volume</label>
            <input type="text" id="volume" class="form-control" name="input-volume" value="" />
          </div>
          <!-- <div class="form-group">
            <label>Satuan</label>
            <input type="text" id="satuan" class="form-control" name="input-satuan" value="" />
          </div> -->
        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-flat btn-warning">Tidak</button>
          <button type="submit" class="btn btn-flat btn-success">Ya</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
var table;
  $(document).ready(function() {
    table = $("#table").DataTable({
      "info":true,
        "oLanguage": {
          "sInfoFiltered": ""
        },
        "processing": true,
        "serverSide": true,
        "scrollX": true,
        "ajax": {
          "url": "<?php echo $url_rewrite;?>process/kegiatan/table-rkakl",
          "type": "POST",
          "data": { }
        },
        <?php if ($_SESSION['direktorat'] == "") { ?>
          "columnDefs" : [
            {"targets" : 0,
             "visible" : false},
            {"targets" : 1},
            {"targets" : 2},
            {"targets" : 3},
            {"targets" : 4},
            {"targets" : 5},
            {"targets" : 6},
          ],
        <?php }else{?>
          "columnDefs" : [
            {"targets" : 0,
             "visible" : false},
            {"targets" : 1,
              "visible" : false},
            {"targets" : 2},
            {"targets" : 3},
            {"targets" : 4},
            {"targets" : 5},
            {"targets" : 6},
          ],
        <?php } ?>
        "order": [[ 0, "desc" ]]
    });
  });
  $(function () {
     // $( "#datepicker" ).datepicker({
     //    changeMonth: true,
     //    changeYear: true,
     //    format: 'dd/mm/yyyy'
     //  });

    // var tahun = $('#tahun2').val();
    // var direktorat = $('#direktorat2').val();

  /*.rowGrouping({
                iGroupingColumnIndex: 0,
                sGroupingColumnSortDirection: "asc",
                iGroupingOrderByColumnIndex: 0,
                                            bExpandableGrouping: true,
      });*/
    // table = $("#table").DataTable({
    //     "processing": true,
    //     "serverSide": true,
    //     "scrollX": true,
    //     "ajax": {
    //       "url": "<?php echo $base_process;?>kegiatan/table-rkakl",
    //       "type": "POST",
    //       "data": {'tahun':tahun,
    //                 'direktorat':direktorat }
    //     },
    //     <?php if ($_SESSION['direktorat'] == "") { ?>
    //       "columnDefs" : [
    //         {"targets" : 0,
    //           "visible" : false},
    //         {"targets" : 1,
    //           "visible" : false},
    //         {"targets" : 2},
    //         {"targets" : 3},
    //         {"targets" : 4},
    //         {"targets" : 5},
    //         {"targets" : 6,
    //          "searchable" :false},
    //         {"targets" : 7,
    //          "searchable" :false},
    //         {"targets" : 8,
    //          "searchable" :false},
    //         {"targets" : 9,
    //          "searchable" :false},
    //       ],
    //       "drawCallback": function ( settings ) {
    //         var api  = this.api();
    //         var rows = api.rows( {page:'current'} ).nodes();
    //         var last = null;
    //         api.column(1, {page:'current'} ).data().each( function ( group, i ) {
    //             if ( last !== group ) {
    //                 $(rows).eq( i ).before(
    //                     '<tr class="group" style="background-color:#00FF80;"><td colspan="11">'+group+'</td></tr>'
    //                 );
    //                 last = group;
    //             }
    //         } );
    //     },
    //     <?php }else{?>
    //       "columnDefs" : [
    //         {"targets" : 0,
    //           "visible" : false},
    //         {"targets" : 1,
    //           "visible" : false},
    //         {"targets" : 2,
    //           "visible" : false},
    //         {"targets" : 3},
    //         {"targets" : 4},
    //         {"targets" : 5},
    //         {"targets" : 6,
    //          "searchable" :false},
    //         {"targets" : 7,
    //          "searchable" :false},
    //         {"targets" : 8,
    //          "searchable" :false},
    //         {"targets" : 9,
    //          "searchable" :false},
    //       ],
    //       "drawCallback": function ( settings ) {
    //         var api = this.api();
    //         var rows = api.rows( {page:'current'} ).nodes();
    //         var last=null;
 
    //         api.column(2, {page:'current'} ).data().each( function ( group, i ) {
    //             if ( last !== group ) {
    //                 $(rows).eq( i ).before(
    //                     '<tr class="group" style="background-color:#00FF80;"><td colspan="11">'+group+'</td></tr>'
    //                 );
 
    //                 last = group;
    //             }
    //         } );
    //     },
    //     <?php } ?>
    //     "order": [[ 0, "desc" ]]        
    // });
    
    $(document).on("click", "#btn-vol", function (){
      var tr = $(this).closest('tr');
      tabrow = table.row(tr);
      // alert();
      volume =tabrow.data()[17]; 
      satuan =tabrow.data()[10]; 
      $("#volume").val(volume);
      $("#satuan").val(satuan);

    });
  });
  
  // function search(){
  //   var tahun = $('#tahun2').val();
  //   var direktorat = $('#direktorat2').val();
  //   table.destroy();
  //   table = $("#table").DataTable({
  //       "processing": true,
  //       "serverSide": true,
  //       "scrollX": true,
  //       "ajax": {
  //         "url": "<?php echo $url_rewrite;?>api/api_rabrkakl.php",
  //         "type": "POST",
  //         "data": {'tahun':tahun,
  //                   'direktorat':direktorat }
  //       },
  //       <?php if ($_SESSION['direktorat'] == "") { ?>
  //         "columnDefs" : [
  //           {"targets" : 0,
  //             "visible" : false},
  //           {"targets" : 1,
  //             "visible" : false},
  //           {"targets" : 2},
  //           {"targets" : 3},
  //           {"targets" : 4},
  //           {"targets" : 5},
  //           {"targets" : 6,
  //            "searchable" :false},
  //           {"targets" : 7,
  //            "searchable" :false},
  //           {"targets" : 8,
  //            "searchable" :false},
  //           {"targets" : 9,
  //            "searchable" :false},
  //         ],
  //         "drawCallback": function ( settings ) {
  //           var api = this.api();
  //           var rows = api.rows( {page:'current'} ).nodes();
  //           var last=null;
 
  //           api.column(1, {page:'current'} ).data().each( function ( group, i ) {
  //               if ( last !== group ) {
  //                   $(rows).eq( i ).before(
  //                       '<tr class="group" style="background-color:#00FF80;"><td colspan="11">'+group+'</td></tr>'
  //                   );
 
  //                   last = group;
  //               }
  //           } );
  //       },
  //       <?php }else{?>
  //         "columnDefs" : [
  //           {"targets" : 0,
  //             "visible" : false},
  //           {"targets" : 1,
  //             "visible" : false},
  //           {"targets" : 2,
  //             "visible" : false},
  //           {"targets" : 3},
  //           {"targets" : 4},
  //           {"targets" : 5},
  //           {"targets" : 6,
  //            "searchable" :false},
  //           {"targets" : 7,
  //            "searchable" :false},
  //           {"targets" : 8,
  //            "searchable" :false},
  //           {"targets" : 9,
  //            "searchable" :false},
  //         ],
  //         "drawCallback": function ( settings ) {
  //           var api = this.api();
  //           var rows = api.rows( {page:'current'} ).nodes();
  //           var last=null;
 
  //           api.column(2, {page:'current'} ).data().each( function ( group, i ) {
  //               if ( last !== group ) {
  //                   $(rows).eq( i ).before(
  //                       '<tr class="group" style="background-color:#00FF80;"><td colspan="11">'+group+'</td></tr>'
  //                   );
 
  //                   last = group;
  //               }
  //           } );
  //       },
  //       <?php } ?>
  //       "order": [[ 0, "desc" ]]        
  //   });
  // }
</script>
