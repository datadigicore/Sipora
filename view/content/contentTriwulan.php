<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Data Triwulan
      <small>Management Control</small>
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-table"></i> Data Triwulan</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-sm-3 col-sm-offset-1">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title" style="margin-top:6px;">Tambah Triwulan</h3>
          </div>
          <div class="box-body">
            <?php include "view/include/contentAlert.php" ?>
            <form method="POST" action="<?php echo $base_process;?>pengguna/add">
            <div class="row">
              <div class="col-md-12">
                <div class="box-body well form-horizontal">
                  <?php include "view/include/contentAlert.php" ?>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label>Status Triwulan</label>
                      <select class="form-control">
                        <option>Triwulan 1</option>
                        <option>Triwulan 2</option>
                        <option>Triwulan 3</option>
                        <option>Triwulan 4</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label>Tahun Anggaran</label>
                      <select class="form-control" required>
                        <?php $earliest_year = date('Y');
                        echo '<option  value="" disabled selected>-- Pilih Tahun Anggaran --</option>';
                        foreach (range(date('Y'), $earliest_year+1) as $x) {
                          echo '<option value="'.$x.'">'.$x.'</option>';
                        }?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label>Tanggal Awal</label>
                      <input type="text" class="form-control" id="tanggalAwal" name="tanggalAwal" placeholder="dd/mm/yyyy">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label>Tanggal Akhir</label>
                      <input type="text" class="form-control" id="tanggalAkhir" name="tanggalAkhir" placeholder="dd/mm/yyyy">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="box-footer">
                  <button type="submit" class="btn btn-success pull-right">Tambah Data</button>
                </div>
              </div>
            </div>
          </form>
          </div>
        </div>        
      </div>
      <div class="col-sm-7">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title" style="margin-top:6px;">Tabel Triwulan</h3>
            <div class="pull-right">
            <select class="form-control" onchange="search()">
              <option value="">-- Semua Tahun --</option>
              <option selected>2016</option>
            </select>
            </div>
          </div>
          <div class="box-body">
            <?php include "view/include/contentAlert.php" ?>
            <table id="table" class="display nowrap table table-bordered table-striped" cellspacing="0" width="100%">
              <thead style="background-color:#2B91CF;color:white;">
                <tr>
                  <th>No</th>
                  <th>Nama Triwulan</th>
                  <th>Tanggal Awal</th>
                  <th>Tanggal Akhir</th>
                  <th>Status</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>        
      </div>
    </div>
  </section>
</div>
<script type="text/javascript">
  var table = $(".table").DataTable({
      "oLanguage": {
        "sInfoFiltered": ""
      },
      "processing": true,
      "serverSide": true,
      "scrollX": true,
      "ajax": {
        "url": "<?php echo $base_process;?>triwulan/table",
        "type": "POST"
      },
      "columnDefs" : [
        {"targets" : 0},
        {"targets" : 1},
        {"targets" : 2},
        {"targets" : 3},
        {"targets" : 4},
      ],
      "order": [[ 0, "asc" ]]
    });
    $("#tanggalAwal").datepicker({
      autoclose  : true,
      monthNames : [ "Januari", "Pebruari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember" ],
      changeMonth: true,
      dateFormat : 'dd/mm/yy',
      onClose: function(selectedDate) {
        $("#tanggalAkhir").datepicker("option", "minDate", selectedDate);
      }
    });
    $("#tanggalAkhir").datepicker({ 
      autoclose  : true,
      monthNames : [ "Januari", "Pebruari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember" ],
      changeMonth: true,
      dateFormat : 'dd/mm/yy'
    });
</script>