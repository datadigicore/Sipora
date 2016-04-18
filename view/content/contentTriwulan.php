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
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title" style="margin-top:6px;">Tabel Triwulan</h3>
          </div>
          <div class="box-body">
            <?php include "view/include/contentAlert.php" ?>
            <table id="table" class="display nowrap table table-bordered table-striped" cellspacing="0" width="100%">
              <thead style="background-color:#2B91CF;color:white;">
                <tr>
                  <th>No</th>
                  <th>Nama</th>
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
  var editor; // use a global for the submit and return data rendering in the examples
 
$(document).ready(function() {
    editor = new $.fn.dataTable.Editor( {
            ajax: "../php/standalone.php",
            fields: [ {
                    label: "Status:",
                    name:  "enable",
                    type:  'radio',
                    options: [
                        { label: 'Enabled',  value: 'Enabled' },
                        { label: 'Disabled', value: 'Disabled' }
                    ]
                }, {
                    label: "Server IP address:",
                    name:  "server-ip"
                }, {
                    label:     "Polling period:",
                    name:      "poll-period"
                }, {
                    name: "protocol", // `label` since `data-editor-label` is defined for this field
                    type: "select",
                    options: [
                        { label: 'TCP', value: 'TCP' },
                        { label: 'UDP', value: 'UDP' }
                    ]
                }
            ]
        } );
     
        $('[data-editor-field]').on( 'click', function (e) {
            editor.inline( this, {
                buttons: '_basic'
            } );
        } );
    } );
</script>