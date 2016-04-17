$(document).ready(function() {
	$(".various").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: true,
		autoDimensions : true,
		width		: '70%',
		height		: 'auto',
		autoSize	: true,
		closeClick	: false,
		openEffect	: 'fade',
		closeEffect	: 'fade'
	});
	
	$(".file_upload").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '35%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'fade',
		closeEffect	: 'fade'
	});
});
                   
function addsum(class_name,update){
     var tot=0;
     var count = document.getElementsByClassName(class_name);
     var tmp = 0;
     for(i=0; i<count.length; i++){
          tmp = $(count[i]).val();
          if(tmp=='')
               tmp=0;
          tot = parseInt(tot) + parseInt(tmp);
     }
     document.getElementById(update).value=tot;
}

function countsum(class_name){
     var tot=0;
     var count = document.getElementsByClassName(class_name);
     var tmp = 0;
     for(i=0; i<count.length; i++){
          tmp = $(count[i]).val();
          if(tmp=='')
               tmp=0;
          // alert(tmp);
          tot = parseInt(tot) + parseInt(tmp);
     }
    return tot;
}
$(document).on('blur','.bln_ini',  function(){
     var bln_ini = $(this).attr('id'); 
     var temp=bln_ini.slice(-1);
     var parent_pagu=$(this).attr('parent'); 
     
     var pagu=$("#pagu_anggaran_"+parent_pagu).val();
     bln_ini=$('#bln_ini'+temp).val();
     var jml_bln_lalu=$('#jml_bln_lalu'+temp).val();
     var jml_bln_ini=parseInt(jml_bln_lalu)+parseInt(bln_ini);
     var realisasi_anggaran=(parseInt(jml_bln_ini)/parseInt(pagu))*100;
     var sisa_anggaran=parseInt(pagu)-parseInt(jml_bln_ini);
     if(jml_bln_ini>pagu){
          alert('Maaf realisasi lebih besar daripada pagu');
          $('#bln_ini'+temp).val('');
     }else{
          $('#jml_sd_bln_ini'+temp).val(jml_bln_ini);
          $('#realisasi_anggaran'+temp).val(realisasi_anggaran);
          $('#sisa_anggaran'+temp).val(sisa_anggaran);
          addsum('jml_bln_lalu','jml_sd_bln_lalu');
          addsum('bln_ini','jml_bln_ini');
          addsum('jml_sd_bln_ini','jml_sd_bln_ini');
          addsum('sisa_anggaran','jml_sisa_anggaran');
   
     }
     
});

function isi_nama_kegiatan(id_option,nama_kegiatan,id_button){
     var option_val 	= document.getElementById(id_option);
     var nama_val 	= document.getElementById(nama_kegiatan);
     var nama 		= option_val.value.split('_');

     var nilai=option_val.value;
          
     var temp_value=localStorage.getItem('data_value').split(",");
     var temp_judul=localStorage.getItem('data_judul').split(",");
     var index=temp_value.indexOf(nilai);
     temp_value.splice(index,1);
     temp_judul.splice(index,1);
          
     localStorage.setItem('data_value',temp_value);
     localStorage.setItem('data_judul',temp_judul);

     nama_val.innerHTML= nama[1]; 
     $("#"+id_button).attr('hasil',nama[0]);
	
}


$(document).ready(function(){
     $('.pagu_anggaran').number( true, 0,',','.' ); 
     $('.anggaran_telah_revisi').number( true, 0,',','.' ); 
     $('.jml_bln_lalu').number( true, 0,',','.' ); 
     $('.bln_ini').number( true, 0,',','.' ); 
     $('.jml_sd_bln_ini').number( true, 0,',','.' ); 
     $('.realisasi_anggaran').number( true, 2,',','.' ); 
     $('.sisa_anggaran').number( true, 0,',','.' ); 
     $('#jml_pagu_anggaran').number( true, 0,',','.' ); 
     $('#jml_anggaran_realisasi').number( true, 0,',','.' ); 
     $('#jml_sd_bln_lalu').number( true, 0,',','.' ); 
     $('#jml_bln_ini').number( true, 0,',','.' ); 
     $('#jml_sd_bln_ini').number( true, 0,',','.' ); 
     $('#jml_sisa_anggaran').number( true, 0,',','.' );				
				
     $("body").on('keyup', '.pagu_anggaran, .anggaran_telah_revisi, .jml_bln_lalu, .bln_ini,.jml_sd_bln_ini, .realisasi_anggaran, .sisa_anggaran', function() { 
          $('.pagu_anggaran').number( true, 0,',','.' ); 
          $('.anggaran_telah_revisi').number( true, 0,',','.' ); 
          $('.jml_bln_lalu').number( true, 0,',','.' ); 
          $('.bln_ini').number( true, 0,',','.' ); 
          $('.jml_sd_bln_ini').number( true, 0,',','.' ); 
          $('.realisasi_anggaran').number( true, 2,',','.' ); 
          $('.sisa_anggaran').number( true, 0,',','.' ); 
          $('#jml_pagu_anggaran').number( true, 0,',','.' ); 
          $('#jml_anggaran_realisasi').number( true, 0,',','.' ); 
          $('#jml_sd_bln_lalu').number( true, 0,',','.' ); 
          $('#jml_bln_ini').number( true, 0,',','.' ); 
          $('#jml_sd_bln_ini').number( true, 0,',','.' ); 
          $('#jml_sisa_anggaran').number( true, 0,',','.' );
     });
				
				
     /* check if pagu over value */
     $(document).on('blur','.checkData',  function(){

          var parent = $(this).attr('parent');
          var nilaiPagu = new Array();
				
          $(".nilai_pagu_"+ parent).each ( function() {
               nilaiPagu.push(parseInt($(this).val()));
          });
          var id_prov = $('#id_provinsi').val();
				
          // loop variabelnya trus samain sama yg dari DB
          var nilai = 0;
					
          for (var i=0;i<nilaiPagu.length;i++){
							
               nilai += nilaiPagu[i];
          }
          var sisa =$('#pagu_total').val()- countsum('pagu_anggaran');
         
          if (sisa >=0){
                    var this_id = $(this).attr('id');
                    var no_parent = this_id.split('_');
                    temp=no_parent.pop();
                    $('#anggaran_telah_revisi'+temp).val($(this).val());
                    addsum('pagu_anggaran', 'jml_pagu_anggaran');
                    addsum('anggaran_telah_revisi', 'jml_anggaran_realisasi');
                    var status_nan=isNaN(nilai);
                    if (nilai!=''&& status_nan!=true){		
                         $.post('modul/mod_detail_evaluasi_dekon/check.php', {
                              check:true, 
                              nilai:nilai, 
                              prov:id_prov
                         }, function(data){


                              if (data != 0){
                                   $("#tambah_sub_kegiatan_"+no_parent[2]).attr("disabled","disabled");
                                   $('#submit').attr('disabled','disabled');
                                   $('#submit').css("background","grey");
                                   alert("Pagu melebihi pagu anggaran! \n Nilai Pagu Anggaran = Rp "+data);


                              } else {
                                   $("#tambah_sub_kegiatan_"+no_parent[2]).removeAttr("disabled");
                                   $('#submit').removeAttr('disabled');
                                   $('#submit').css("background","#386B12");
                              }
                              return false;

                         }, "JSON")
                    }
               $('#submit').removeAttr('disabled');
               $('#submit').css("background","#386B12");   
          }else{               
               alert('Maaf  sisa pagu anggaran tidak mencukupi');
               $('#submit').attr('disabled','disabled');
               $('#submit').css("background","grey");      
          }            
				
     });
				
     // Saat Tombol Tambah SATKER Di klik				
     $("#tambah_satker_dekon").on("click",function(){	
          var row_kode_kegiatan 	= parseInt(document.userForm.row_kode_kegiatan.value);
          jml 	  				= row_kode_kegiatan + 1;				
          var baris 	= '<tr id="parent_'+jml+'">\
									<input type=hidden class="id_dekon_" name="id_dekon_['+jml+']" id="id_dekon_'+jml+'" value="">\
									<td class="vcenter"><select name="kode_kegiatan['+jml+']" id="id_kode_kegiatan'+jml+'" class="id_kode_kegiatan" required onchange="isi_nama_kegiatan(\'id_kode_kegiatan'+jml+'\',\'program_kegiatan'+jml+'\',\'tambah_sub_kegiatan_'+jml+'\')" size="1"><option value="">-Kode-</option></select></td>\
									<td class="vcenter"><div style=\'overflow-x:scroll;overflow: auto;width:150px;\' row=1 cols=10 readonly name="nama_program['+jml+']" id="program_kegiatan'+jml+'" class="program_kegiatan"></div></td>\
									<td class="vcenter"></td>\
									<td class="vcenter"></td>\
									<td class="vcenter"></td>\
									<td class="vcenter"></td>\
									<td class="vcenter"></td>\
									<td class="vcenter"></td>\
									<td class="vcenter"></td>\
									<td class="vcenter"></td>\
									<td class="vcenter"></td>\
									<td class="vcenter"></td>\
									<td class="vcenter"></td>\
									<td class="vcenter">\
										<input type=hidden id="id_main_evaluasi_dekon'+jml+'" class="id_main_evaluasi_dekon"  name="id_main_evaluasi_dekon['+jml+']" value="">\
										<input type="button" class="tomboltambah_sub" value="+" id="tambah_sub_kegiatan_'+jml+'" hasil="" parent="parent_'+jml+'">\
										<a onclick="delrow_kode_kegiatan(\'parent_'+jml+'\')" style="cursor : pointer;"><image src="images/ico_delete_16.png" width="16" height="16" title="Hapus"></a></td>\
								  </tr>';
          $('#isi_kode_kegiatan_dekon > thead:last').append(baris);
                              
          var temp_value=localStorage.getItem('data_value').split(",");
          var temp_judul=localStorage.getItem('data_judul').split(",");
          
          
          var select=document.getElementById('id_kode_kegiatan'+jml);
          var index=0;
          for (i=0;i<temp_judul.length;i++){
                                   
               var opt = document.createElement('option');
               opt.value = temp_value[i];
               opt.innerHTML = temp_judul[i];
               select.appendChild(opt);

          }
                          
          //Untuk Mengisi Kode Kegiatan
          /*$.ajax({
						url: "proses_nama_kegiatan.php",				
						success: function(data){
							$("#id_kode_kegiatan"+jml).html(data);
						}
					});*/
		
          jml = row_kode_kegiatan + 1;	
          document.userForm.row_kode_kegiatan.value=jml;						
     });
     $("#hapus_kode_kegiatan_dekon").click(function(){
          var jml = parseInt(document.userForm.row_kode_kegiatan.value);
          if(jml > 1){
               $('#isi_kode_kegiatan_dekon > thead:last tr:last').remove();
               jml = jml - 1;
          }
          document.userForm.row_kode_kegiatan.value=jml;
     });
				
     $('.tomboltambah_sub').live('click', function(){
          var row_sub_kode_kegiatan 	= parseInt(document.userForm.row_sub_kode_kegiatan.value);
          var parent_kode 			= $(this).attr('hasil');
          var parent_id 			= $(this).attr('parent');
          var parent_no = parent_id.split("_");
          if(parent_kode == ''){
               alert('Pilih Kode Satker Terlebih Dahulu');
               return false;
          }else{
             //  var parent_kode 		= parseInt($(this).attr('hasil'));
          }
          jml 	  					= row_sub_kode_kegiatan + 1;		
          jml_parent					= jml - 1;
          var baris 	 = '<tr id="sub_'+parent_no[1]+"_"+jml+'">\
								<td class="vcenter"><input type="hidden" class="id_main_kode_kegiatan_" name="id_main_kode_kegiatan_['+jml+']" id="id_main_kode_kegiatan_'+jml+'" size="1" value="'+parent_kode+'">\
													<input type="hidden" class="id_main_evaluasi_dekon_" name="id_main_evaluasi_dekon_['+jml+']" id="id_main_evaluasi_dekon_'+jml+'" size="1" value="">\
													<input type="text" required placeholder="Sub Kode" name="sub_kode_kegiatan['+jml+']" id="sub_kode_kegiatan'+jml+'" class="sub_kode_kegiatan" size="5" >\
								</td>\
								<td class="vcenter"><input type="text" required name="nama_kegiatan['+jml+']" id="nama_kegiatan'+jml+'" class="nama_kegiatan" size="20"></td>\
								<td class="vcenter"><input type="text" required name="pagu_anggaran['+jml+']" id="pagu_anggaran_'+parent_no[1]+"_"+jml+'" class="nilai_pagu_'+parent_kode+' checkData pagu_anggaran" size="7" parent="'+parent_kode+'"></td>\
								<td class="vcenter"><input type="text" required name="anggaran_telah_revisi['+jml+']" id="anggaran_telah_revisi'+jml+'" class="anggaran_telah_revisi" size="7" readonly></td>\
								<td class="vcenter"><input type="text" required readonly name="jml_bln_lalu['+jml+']" id="jml_bln_lalu'+jml+'" class="jml_bln_lalu" size="7" value="0"></td>\
								<td class="vcenter"><input type="text" required name="bln_ini['+jml+']" id="bln_ini'+jml+'" parent="'+parent_no[1]+"_"+jml+'" class="bln_ini" size="7"></td>\
								<td class="vcenter"><input type="text" required readonly name="jml_sd_bln_ini['+jml+']" id="jml_sd_bln_ini'+jml+'" class="jml_sd_bln_ini" size="7" value="0"></td>\
								<td class="vcenter"><input type="text" required readonly name="realisasi_anggaran['+jml+']" id="realisasi_anggaran'+jml+'" class="realisasi_anggaran" size="5" value="0"></td>\
								<td class="vcenter"><input type="text" required name="sisa_anggaran['+jml+']" id="sisa_anggaran'+jml+'" class="sisa_anggaran" size="7" readonly></td>\
								<td class="vcenter"><input type="text" required name="target_kegiatan['+jml+']" id="target_kegiatan'+jml+'" class="target_kegiatan" size="5"></td>\
								<td class="vcenter"><input type="text" required name="output_kegiatan['+jml+']" id="output_kegiatan'+jml+'" class="output_kegiatan" size="5"></td>\
								<td class="vcenter"><input type="text" required name="waktu_tempat['+jml+']" id="waktu_tempat'+jml+'" class="waktu_tempat" size="5"></td>\
								<td class="vcenter"><input type="text" required name="kendala['+jml+']" id="kendala'+jml+'" class="kendala" size="5"></td>\
								<td class="vcenter"><a onclick="delrow_kode_kegiatan(\'sub_'+parent_no[1]+"_"+jml+'\')" style="cursor : pointer;"><image src="images/ico_delete_16.png" width="16" height="16" title="Hapus"></a></td>\
							  </tr>';
          $(baris).insertAfter($(this).closest('tr'));
          jml = row_sub_kode_kegiatan + 1;	
          document.userForm.row_sub_kode_kegiatan.value=jml;
					
     });
});

function cek_element(keyword,table)
{
    
     var  nilai=getElementsByIdStartsWith(table, "tr", keyword);
     var panjang=nilai.length;
     return panjang;
}
function getElementsByIdStartsWith(container, selectorTag, prefix) {
     var items = [];
     var hasil='';
     var myPosts = document.getElementById(container).getElementsByTagName(selectorTag);
     for (var i = 0; i < myPosts.length; i++) {
          //omitting undefined null check for brevity
          if (myPosts[i].id.lastIndexOf(prefix, 0) === 0) {
               //items.push(myPosts[i]);
               hasil=myPosts[i].id;
          }
     }
     return hasil;
}

function delrow_kode_kegiatan(id,id_kegiatan){
     var r=confirm("Hapus Baris Ini?");
     var temp=id.split("_");
     var status_parent=0;
 var data_id_cek_box_parent=0;
     if(temp[0]=='parent'){
          status_parent=1;
          data_id_cek_box_parent=temp[1];
          var hasil=cek_element("sub_"+data_id_cek_box_parent, "isi_kode_kegiatan_dekon");
     
     }
     else var hasil=0;
     temp=temp[1];
     if(hasil==0){
          var temp_value=localStorage.getItem('data_value').split(",");
          var temp_judul=localStorage.getItem('data_judul').split(",");
          if(r==true){	
               if(status_parent==1){
               var data=$('#id_kode_kegiatan'+data_id_cek_box_parent).val();
              // alert('#id_kode_kegiatan'+data_id_cek_box_parent);
               if(data!=""){
                    temp=data.split("_");
                    temp=temp[0];
                    var panjang=temp_value.length;
                    if(panjang==1 && temp_value[0]==""){
                         temp_value=data;
                         temp_judul=temp;
                    }else{
                         var index=temp_value.indexOf(data);
                         if(index==-1){
                              temp_value.push(data);
                              temp_judul.push(temp);
                         }
                    }
                    localStorage.setItem('data_value',temp_value);
                    localStorage.setItem('data_judul',temp_judul);
               }
               }
               //alert(data);
               $('#'+id).remove();
               $.ajax({
                    type:"POST",
                    url: "modul/mod_detail_evaluasi_dekon/delete.php",
                    data: "id="+id_kegiatan,
                    success: function(data){                 					   
                    /*	if(data==0){
                                                   alert("Data Berhasil di Hapus");							
                                             }*/					 
                    }

               });
                  addsum('pagu_anggaran', 'jml_pagu_anggaran');
          addsum('anggaran_telah_revisi', 'jml_anggaran_realisasi');
                addsum('jml_bln_lalu','jml_sd_bln_lalu');
          addsum('bln_ini','jml_bln_ini');
          addsum('jml_sd_bln_ini','jml_sd_bln_ini');
          addsum('sisa_anggaran','jml_sisa_anggaran');
          }
     }
     else{
          alert("Hapus terlelbih dahulu data kegiatan yang masih ada.");
     }
          
}





