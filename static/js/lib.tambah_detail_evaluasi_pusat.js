function removePoint(value){
	var x = value.split('.');
	var y = "";	
	for(var i =0; i< x.length; i++){
		y += x[i];
	}		
	return parseInt(y);
}

function addsum_pusat(class_name,update){
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

function progres_anggaran(data){
	var data_full=data.id;
	var no=data_full.split("_");
	no=no[1];
	//untuk dapet id
	var id_pagu_anggaran="pagu_anggaran_"+no;
	var id_progress="progress_"+no;
	var id_sisa_pagu_anggaran_		="sisa_pagu_anggaran_"+no;
	var realisasi_lama				="realisasi_lama_"+no;
	var realisasi_kini				="realisasi_kini_"+no;
	//untuk dapat value
	var nilai_pagu_anggaran	=$("#"+id_pagu_anggaran).val();
	var progress_lama		=$("#"+id_progress).val();
	var realisasi_lama		=$("#"+realisasi_lama).val();
	var realisasi			= removePoint(data.value);	
	var nilai_pagu_anggaran	= removePoint(nilai_pagu_anggaran);				
	var realisasi_kini		= $("#"+realisasi_kini).val();
			
	//cek apakah realisasi melebihi pagu
	if (realisasi > nilai_pagu_anggaran){
		alert("Anggaran realisasi melebihi pagu anggaran");	
		// Jika realisasi baru diinput pada triwulan tersebut dan di triwulan sebelumnya tidak ada maka nilai = 0
		if (realisasi_kini==''){
			data.value = 0;
			$('#submit').attr('disabled','disabled');
			$('#submit').css("background","grey");				
		// Jika realisasi yang diinput berbeda dengan realisasi triwulan lama maka nilai = tetap realisasi_kini
		}else if(realisasi_kini!=realisasi_lama){
			data.value = realisasi_kini;
			$('#submit').removeAttr('disabled');
			$('#submit').css("background","#386B12");
		// Jika realisasi baru diinput pada triwulan tersebut dan di triwulan sebelumnya telah ada maka nilai = realisasi_lama
		}else{
			data.value = realisasi_lama;
			$('#submit').removeAttr('disabled');
			$('#submit').css("background","#386B12");
		}
	//cek apakah realisasi yang diinput kurang dari realisasi pada triwulan sebelumnya
	}else if (realisasi < realisasi_lama){
		alert("Anggaran realisasi tidak boleh kurang dari Anggaran realisasi sebelumnya");	
		// Jika realisasi baru diinput pada triwulan tersebut dan di triwulan sebelumnya tidak ada maka nilai = 0
		if ((realisasi_kini==0) || (realisasi_kini=='')){
			data.value = realisasi_lama;
			$('#submit').attr('disabled','disabled');
			$('#submit').css("background","grey");				
		// Jika realisasi yang diinput berbeda dengan realisasi triwulan lama maka nilai = tetap realisasi_kini
		}else if(realisasi_kini!=realisasi_lama){
			data.value = realisasi_kini;
			$('#submit').removeAttr('disabled');
			$('#submit').css("background","#386B12");
		// Jika realisasi baru diinput pada triwulan tersebut dan di triwulan sebelumnya telah ada maka nilai = realisasi_lama
		}else{
			data.value = realisasi_lama;
			$('#submit').removeAttr('disabled');
			$('#submit').css("background","#386B12");
		}			
	}else{
	    $('#submit').removeAttr('disabled');
		$('#submit').css("background","#386B12");
		// Proses cetak progress
		var progress = (realisasi / nilai_pagu_anggaran) * 100;
		var progress_cetak = parseFloat(progress).toFixed(2);		
		document.getElementById(id_progress).value= progress_cetak;	
	}
	//memunculkan total realisasi
	addsum_pusat("realisasi","jml_realisasi");					
}

function progres_anggaran_kinerja(data){
	var data_full=data.id;
	var no=data_full.split("_");
	no=no[2];
	//untuk dapet id
	var id_kinerja_target		="kinerja_target_"+no;
	var id_kinerja_progress		="kinerja_progress_"+no;
	var id_sisa_kinerja_target	="sisa_kinerja_target_"+no;
	var kinerja_realisasi_lama	="kinerja_realisasi_lama_"+no;
	
	//untuk dapat value
	var nilai_kinerja_target	= $("#"+id_kinerja_target).val();
	var nilai_kinerja_progress	= $("#"+id_kinerja_progress).val();
	var kinerja_realisasi_lama	=$("#"+kinerja_realisasi_lama).val();
	var realisasi_kinerja		= removePoint(data.value);	
	
	//Ambil sisa kinerja target
	var nilai_sisa_kinerja_target	= $("#"+id_sisa_kinerja_target).val();
	
	//cek apakah realisasi_kinerja melebihi kinerja target
	if (realisasi_kinerja > nilai_kinerja_target){
		alert("Kinerja realisasi melebihi target");
		if (nilai_sisa_kinerja_target==''){
			data.value = 0;
			$('#submit').attr('disabled','disabled');
			$('#submit').css("background","grey");				
		}else{
			data.value = nilai_kinerja_target-nilai_sisa_kinerja_target;			
			$('#submit').removeAttr('disabled');
			$('#submit').css("background","#386B12");
		}		
	}else if ((realisasi_kinerja < kinerja_realisasi_lama)){
		alert("Kinerja Realisasi tidak boleh kurang dari Kinerja realisasi sebelumnya");
		if (nilai_sisa_kinerja_target==''){
			data.value = 0;
			$('#submit').attr('disabled','disabled');
			$('#submit').css("background","grey");				
		}else{
			data.value = nilai_kinerja_target-nilai_sisa_kinerja_target;
			$('#submit').removeAttr('disabled');
			$('#submit').css("background","#386B12");
		}	
	}else{
	    $('#submit').removeAttr('disabled');
		$('#submit').css("background","#386B12");	
		var progress 			=(realisasi_kinerja / nilai_kinerja_target) * 100;
		var progress_cetak		= parseFloat(progress).toFixed(2);		
		document.getElementById(id_kinerja_progress).value= progress_cetak;	
	}
	//memunculkan total kinerja realisasi
	addsum_pusat("kinerja_realisasi","jml_kinerja_realisasi");		
}

//FUNGSI UNTUK CEK PAGU ANGGARAN
function cek_pagu_anggaran(class_name,update,data){
		var data_full=data.id;
		var no=data_full.split("_");
		no=no[2];
	
		var tot=0;
		var row   = parseInt(document.userForm.row.value);
        var count = document.getElementsByClassName(class_name);
		var tmp = 0;
        for(i=0; i<count.length; i++){
			tmp = $(count[i]).val();
			if(tmp=='')
			tmp=0;
            tot = parseInt(tot) + parseInt(tmp);
        }
		var indek		 		  = i-1;
		var total_pagu_anggaran   = parseInt(document.userForm.total_pagu_anggaran_new.value);	
		var sisa_pagu 	 		  = total_pagu_anggaran - tot;
		if(class_name != 'pagu_anggaran'){
			document.getElementById(update).value=tot;
		} else {
			if(sisa_pagu < 0){
				alert("Anggaran melebihi total pagu anggaran yang disediakan");	
				data.value='';		
				document.getElementById(update).value='';
				$('#submit').attr('disabled','disabled');
				$('#submit').css("background","grey");
			} else {
				document.getElementById(update).value=tot;
				$('#submit').removeAttr('disabled');
				$('#submit').css("background","#386B12");
			}
		}
	progres_anggaran(this);
}

//FUNGSI UNTUK CEK ANGGARAN TELAH REVISI
function cek_anggaran_revisi(class_name,data){
		var data_full=data.id;
		var no=data_full.split("_");
		no=no[3];
		var pagu_anggaran_baris_ini		="pagu_anggaran_"+no;			
		var pagu_anggaran_baris_ini		= $("#"+pagu_anggaran_baris_ini).val();
		var realisasi_anggaran_baris_ini	="realisasi_"+no;			
		var realisasi_anggaran_baris_ini	= $("#"+realisasi_anggaran_baris_ini).val();
		var anggaran_telah_revisi		= removePoint(data.value);		
		
		var tot=0;
		var row   = parseInt(document.userForm.row.value);
        var count = document.getElementsByClassName(class_name);
		var tmp = 0;
        for(i=0; i<count.length; i++){
			tmp = $(count[i]).val();
			if(tmp=='')
			tmp=0;
            tot = parseInt(tot) + parseInt(tmp);
        }
		var total_pagu_anggaran   = parseInt(document.userForm.total_pagu_anggaran_new.value);

		var sisa_pagu 	 		  = total_pagu_anggaran - (tot- parseInt(pagu_anggaran_baris_ini)+anggaran_telah_revisi);
			if (document.getElementById("pagu_anggaran_"+no).value == ''){
				alert("Isikan pagu anggaran terlebih dahulu");	
				data.value='0';		
			}else if(sisa_pagu < 0){
				alert("Anggaran telah revisi melebihi total pagu anggaran yang disediakan");	
				data.value=document.getElementById("pagu_anggaran_"+no).value;		
			} else if((anggaran_telah_revisi < realisasi_anggaran_baris_ini) && (anggaran_telah_revisi!=0)){
				alert("Anggaran telah revisi harus lebih dari atau sama dengan realisasi anggaran");	
				data.value='0';				
			}else if((anggaran_telah_revisi==0) || (anggaran_telah_revisi=='')){
				data.value='0';
			}else{
				document.getElementById("pagu_anggaran_"+no).value=anggaran_telah_revisi;			
			}
			addsum_pusat("pagu_anggaran","jml_pagu_anggaran");		
}

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

$(document).ready(function(){
				$('.pagu_anggaran').number( true, 0,',','.' );				
				$('.anggaran_telah_revisi').number( true, 0,',','.' );
				$('.realisasi').number( true, 0,',','.' );
				$('.kinerja_target').number( true, 0,',','.' );
				$('.kinerja_realisasi').number( true, 0,',','.' );								
				$('#jml_pagu_anggaran').number( true, 0,',','.' );				
				$('#jml_realisasi').number( true, 0,',','.' );							
				$('#jml_kinerja_target').number( true, 0,',','.' );				
				$('#jml_kinerja_realisasi').number( true, 0,',','.' );				
				
				$("body").on('keyup', '.pagu_anggaran,.realisasi,.anggaran_telah_revisi,.kinerja_target,.kinerja_realisasi,.progress,.kinerja_progress', function() { 
					$('.pagu_anggaran').number( true, 0,',','.' ); 
					$('.anggaran_telah_revisi').number( true, 0,',','.' ); 
					$('.realisasi').number( true, 0,',','.' ); 
					$('.kinerja_target').number( true, 0,',','.' ); 
					$('.kinerja_realisasi').number( true, 0,',','.' ); 
					$('#jml_pagu_anggaran').number( true, 0,',','.' ); 
					$('#jml_realisasi').number( true, 0,',','.' ); 
					$('#jml_kinerja_target').number( true, 0,',','.' ); 
					$('#jml_kinerja_realisasi').number( true, 0,',','.' ); 
				});
				
				$("#tambah_detail_evaluasi_pusat").on("click",function(){
					
					var row 			= parseInt(document.userForm.row.value);
					var kode_kegiatan 	= document.userForm.kode_kegiatan.value;
					jml 	  			= row + 1;
					var baris 	= '<tr id="'+jml+'"><input type=hidden class="id_main_kegiatan" name="id_main_kegiatan['+jml+']" id="id_main_kegiatan_'+jml+'">\
													<input type="hidden" id="data_awal_['+jml+']" value="0">\
									<td class="vcenter"><input type=hidden name="no['+jml+']" required value="'+jml+'" id="no_'+jml+'" size="1" readonly>'+jml+'</td>\
									<td class="vcenter">'+kode_kegiatan+'.<input type=text name="sub_kode_kegiatan['+jml+']" required size="7"></td>\
									<td class="vcenter"><input type=text class="indikator_kinerja_utama" name="indikator_kinerja_utama['+jml+']"  required size="7"></td>\
									<td class="vcenter"><input type=text id="pagu_anggaran_'+jml+'" placeholder="number" class="pagu_anggaran" name="pagu_anggaran['+jml+']" onblur="cek_pagu_anggaran(\'pagu_anggaran\',\'jml_pagu_anggaran\',this)\" required size="7"></td>\
									<td class="vcenter"></td>\
									<td class="vcenter"><input type=text disabled id="anggaran_telah_revisi_'+jml+'" placeholder="number" class="anggaran_telah_revisi" name="anggaran_telah_revisi['+jml+']" onblur="cek_anggaran_revisi(\'pagu_anggaran\',this)" size="9"></td>\
									<td class="vcenter"><input type="hidden" id="sisa_pagu_anggaran_'+jml+'" class="sisa_pagu_anggaran" value=""><input type=text id="realisasi_'+jml+'" onblur="progres_anggaran(this);" placeholder="number" class="realisasi" name="realisasi['+jml+']" required size="7"></td>\
									<td class="vcenter"><input type=text id="progress_'+jml+'" placeholder="number" class="progress" readonly name="progress['+jml+']" size="7" required></td>\
									<td class="vcenter"><input type=text id="kinerja_target_'+jml+'" onblur="addsum_pusat(\'kinerja_target\',\'jml_kinerja_target\')\" placeholder="number" class="kinerja_target" name="kinerja_target['+jml+']" required size="7"></td>\
									<td class="vcenter"><input type="hidden" id="sisa_kinerja_target_'+jml+'" class="sisa_kinerja_target" value=""><input type=text id="kinerja_realisasi_'+jml+'" onchange="progres_anggaran_kinerja(this);" placeholder="number"  class="kinerja_realisasi" name="kinerja_realisasi['+jml+']" required size="9"></td>\
									<td class="vcenter"><input type=text id="kinerja_progress_'+jml+'" placeholder="number" readonly class="kinerja_progress" name="kinerja_progress['+jml+']" size="7" required ></td>\
									<td class="vcenter"><input type=text class="waktu_tempat" name="waktu_tempat['+jml+']" required size="18"></td>\
									<td class="vcenter"><textarea class="keterangan" name="keterangan['+jml+']" required row="2" cols="38"></textarea></td>\
									<td class="vcenter"><a onclick="delRow('+jml+')" style="cursor : pointer;"><image src="images/ico_delete_16.png" width="16" height="16" title="Hapus"></a></td>\
								  </tr>';
					$('#isi_detail_evaluasi_pusat > thead:last').append(baris);					
					jml = row + 1;	
					document.userForm.row.value=jml;
						
				});
				$("#hapus_detail_evaluasi_pusat").click(function(){
					var jml = parseInt(document.userForm.row.value);				
					if(jml > 1){
						$('#isi_detail_evaluasi_pusat > thead:last tr:last').remove();
						jml = jml - 1;
					}					
					document.userForm.row.value=jml;									
				});						
});

function delRow(id,id_kegiatan,kategori){
	var r=confirm("Hapus Baris Ini?");
	if(r==true){
		var jml = parseInt(document.userForm.row.value);
		if(jml > 1){
			$('#'+id+'').remove();
			$.ajax({
				 type:"POST",
				 url: "modul/mod_detail_evaluasi_pusat/delete.php",
				 data: "id="+id_kegiatan+"&kategori="+kategori,
				 success: function(data){                 
					   
						if(data==0){
							alert("Data Berhasil di Hapus");
							
						}
					 
					 }
				});
		}
		// document.userForm.row.value=jml;
	} else {
		return false;
	}
}