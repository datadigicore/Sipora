// ================================================= Start Javascript Global ==================================================================
$(document).ready(function() {
     $("#userForm").validate({
           errorPlacement: function(error, element) {
    error.appendTo( element.parent("td").next("td") );
    return true;
  }
          
     });
   
});

function removePoint(value){
	var x = value.split('.');
	var y = "";	
	for(var i =0; i< x.length; i++){
		y += x[i];
	}		
	return parseInt(y);
}
// ================================================= End Javascript Global =====================================================================

// ================================================= Start Javascript yanga ada di modul Dana dekon ============================================

function tampil_provinsi_aktif(){
	var tahun_anggaran	= $("#thn").val();	
	$.ajax({
		url: "modul/mod_dana_dekon_provinsi/cek_tampil_provinsi_aktif.php",
		data: "tahun_anggaran=" + tahun_anggaran,
		success: function(data){
			$("#id_provinsi").html(data);
		}
	});	
}

function cek_sisa_anggaran_program_dekon(){
	var tahun_anggaran	= $("#thn").val();	
	$.ajax({
		url: "modul/mod_dana_dekon_provinsi/cek_sisa_anggaran_program_dekon.php",
		data: "tahun_anggaran=" + tahun_anggaran,
		success: function(data){
			$("#cetak_sisa_anggaran_program_dekon").html(data);
		}
	});	
}

function cek_dana_dekon(){
	var id_provinsi					= $("#id_provinsi").val();
	var tahun_anggaran				= $("#thn").val();
	var sisa_anggaran_program_dekon	= $("#sisa_anggaran_program_dekon").val();
	var pagu_anggaran				= $("#pagu_anggaran").val(); 	
	if (id_provinsi==''){
		alert("Harap pilih provinsi terlebih dahulu");
		document.getElementById('pagu_anggaran').value=0;
        $('#submit').attr('disabled','disabled');
        $('#submit').css("background","grey");		
	}else if (sisa_anggaran_program_dekon=='' || sisa_anggaran_program_dekon=='0'){		
		alert("Sisa pagu anggaran tidak mencukupi");
		document.getElementById('pagu_anggaran').value=0;	
        $('#submit').attr('disabled','disabled');
        $('#submit').css("background","grey");		
	}else if (pagu_anggaran=='' || pagu_anggaran==0){
		alert("Pagu anggaran harus diisi");
		$('#submit').attr('disabled','disabled');
        $('#submit').css("background","grey"); 		
	}else if(parseInt(pagu_anggaran) > parseInt(sisa_anggaran_program_dekon)){
		alert("Anggaran melebihi sisa anggaran program dekon");
		document.getElementById('pagu_anggaran').value=0;
        $('#submit').attr('disabled','disabled');
        $('#submit').css("background","grey");          		
	}else{
	    $('#submit').removeAttr('disabled');
        $('#submit').css("background","#386B12"); 
	}
	
}


// ================================================= End Javascript yang ada di modul Dana dekon ============================================

// ================================================= Start Javascript yanga ada di modul program dekon =================================================
function tampil_nama_dinas(){
	var tahun_anggaran	= $("#tahun_anggaran").val();
	var id_provinsi		= $("#id_provinsi").val(); 		
	$.ajax({
		url: "modul/mod_dekon/proses_tampil_nama_dinas.php",
		data: "tahun_anggaran=" + tahun_anggaran + "& id_provinsi=" + id_provinsi,
		success: function(data){
			$("#nama_dinas_dekon").show(); 
			$("#nama_dinas_dekon").html(data);
		}
	});
}

function sisa_pagu_anggaran_program(){
     var pagu_anggaran_program = document.getElementById('pagu_anggaran_program');
     var sisa_pagu_anggaran_dekon  = document.getElementById('sisa_pagu_anggaran_dekon');         
     if  (removePoint(pagu_anggaran_program.value) > sisa_pagu_anggaran_dekon.value) {
          alert('Maaf sisa pagu anggaran provinsi tidak mencukupi\nSisa pagu anggaran provinsi = '+sisa_pagu_anggaran_dekon.value);
          pagu_anggaran_program.value=0;         
          $('#submit').attr('disabled','disabled');
          $('#submit').css("background","grey");          
      }else{           
          $('#submit').removeAttr('disabled');
          $('#submit').css("background","#386B12");                           
      }
}
// ================================================= End Javascript yanga ada di modul program dekon =================================================

// ================================================= Start Javascript yanga ada di modul evaluasi pusat ======================================
function tampil_nama_program(){
	$("#nama_program_edit").hide();  	
	var kode_program = $("#kode_program").val();
		$.ajax({
			url: "proses_nama_program.php",
			data: "kode_program=" + kode_program,
			success: function(data){
				$("#nama_program").html(data);
			}
		});
}
// ================================================= End Javascript yanga ada di modul evaluasi pusat ========================================

function tampil_sisa_pagu(){
	var unit_lama					= $("#unit_lama").val();
	var sub_unit_lama				= $("#sub_unit_lama").val();
	var sub_subunit_lama			= $("#sub_subunit_lama").val();
	var pagu_anggaran_lama			= $("#pagu_anggaran_lama").val();
	var tahun_anggaran		 		= $("#tahun_anggaran").val();

	var unit_per_unit_kerja			= 0;
	var subunit_per_unit_kerja 		= 0;
	var sub_subunit_per_unit_kerja 	= 0;
	var unit_per_unit_kerja			= $("#unit_per_unit_kerja").val();
	var subunit_per_unit_kerja 		= $("#subunit_per_unit_kerja").val();
	var sub_subunit_per_unit_kerja 	= $("#sub_subunit_per_unit_kerja").val();
		$("#sisa_pagu_anggaran_per_unit_kerja_awal").hide();
		$.ajax({				
			url: "modul/mod_anggaran_per_unit_kerja/proses_sisa_pagu_per_unit_kerja.php",
			data: "tahun_anggaran=" + tahun_anggaran +"&unit_per_unit_kerja="+unit_per_unit_kerja+"&subunit_per_unit_kerja="+subunit_per_unit_kerja+"&sub_subunit_per_unit_kerja="+sub_subunit_per_unit_kerja+"&unit_lama="+unit_lama+"&sub_unit_lama="+sub_unit_lama+"&sub_subunit_lama="+sub_subunit_lama+"&pagu_anggaran_lama="+pagu_anggaran_lama,
			success: function(data){				
				$("#sisa_pagu_anggaran_per_unit_kerja").html(data);
			}
		});
}

function tampil_sisa_pagu_evaluasi_pusat(){
	var id_struktur_parent			= $("#id_struktur_parent").val();
	var id_struktur_child			= $("#id_struktur_child").val();
	var tahun_anggaran				= $("#tahun_anggaran").val();
	if (id_struktur_child==''){
		$("#pagu_anggaran_evaluasi_pusat_awal").show();  	
		$("#pagu_anggaran_evaluasi_pusat_asdep").hide(); 
	}
	else{ 		
		$("#pagu_anggaran_evaluasi_pusat_awal").hide(); 
		$("#pagu_anggaran_evaluasi_pusat_asdep").show(); 
		$.ajax({
			url: "modul/mod_evaluasi_pusat/proses_sisa_pagu_asdep.php",
			data: "tahun_anggaran=" + tahun_anggaran + "& id_struktur_parent=" + id_struktur_parent + "& id_struktur_child=" + id_struktur_child,
			success: function(data){
				$("#pagu_anggaran_evaluasi_pusat_asdep").html(data);
			}
		});

	}
}

function tampil_sisa_pagu_evaluasi_pusat_admin(){
	var unit				= $("#unit_per_unit_evaluasi").val();
	var sub_unit			= $("#subunit_per_unit_evaluasi").val();
	var sub_subunit			= $("#sub_subunit_per_unit_evaluasi").val();
	var tahun_anggaran		= $("#tahun_anggaran").val();
	if (unit==''){
		$("#pagu_anggaran_evaluasi_pusat_awal").show();  	
		$("#pagu_anggaran_evaluasi_pusat_asdep").hide(); 
	}
	else{ 		
		$("#pagu_anggaran_evaluasi_pusat_awal").hide(); 
		$("#pagu_anggaran_evaluasi_pusat_asdep").show(); 
		$.ajax({
			url: "modul/mod_evaluasi_pusat/proses_sisa_pagu_asdep_admin.php",
			data: "tahun_anggaran=" + tahun_anggaran + "& unit=" + unit + "& sub_unit=" + sub_unit + "& sub_subunit=" + sub_subunit,
			success: function(data){
				$("#pagu_anggaran_evaluasi_pusat_asdep").html(data);
			}
		});

	}
}


function cek_sisa_pagu(){
	var pagu_anggaran		= $("#pagu_anggaran").val();
	var sisa_pagu	 		= $("#sisa_anggaran").val();
     document.onkeyup=function(e){
 var e=window.event || e 
 var nilai=e.keyCode;

if(nilai <37 || nilai>40||nilai!=13){
//alert('masukk');
if (pagu_anggaran == 0 && pagu_anggaran!=''){
                     alert('Pagu Anggaran Tidak Boleh Bernilai 0');
                     $('#submit').attr('disabled','disabled');
                     $('#submit').css("background","grey");

               }
               else if (parseInt(pagu_anggaran) > parseInt(sisa_pagu)){
                     alert('Pagu Anggaran Melebihi Sisa Anggaran');
                     document.getElementById("pagu_anggaran").value='';
                     $('#submit').attr('disabled','disabled');
                     $('#submit').css("background","grey");		
                     $('#unit_per_unit_kerja').focus();
               }
               else if (parseInt(pagu_anggaran) <= parseInt(sisa_pagu)) {
                     $('#submit').removeAttr('disabled');
                     $('#submit').css("background","#386B12");
               }
    }
}

}

function check_realisasi(id_realisasi,id_kegiatan,id_progress,id_pagu,data_awal,sisa_pagu_aktif,progress_aktif){
	var real 			= $("#"+id_realisasi).val();
	var id_main 		= document.getElementById(id_kegiatan).value;
	var progress 		= document.getElementById(id_progress);
	var progress_aktif 	= document.getElementById(progress_aktif);
	var data_awal 		= document.getElementById(data_awal).value;
	var sisa_pagu_aktif = document.getElementById(sisa_pagu_aktif).value;
	var pagu 			= $("#"+id_pagu).val();
	
	$.ajax({
     type:"POST",
     url:"checking_progress.php",    
     data: "x_realisasi="+real+"&id_main_kegiatan="+id_main+"&id_pagu="+pagu+"&data_awal="+data_awal+"&sisa_pagu_aktif="+sisa_pagu_aktif, 
	 // {x_realisasi : realisasi, x_id_main_kegiatan : id_main_kegiatan
     success: function(data){                 
       
		if(data==0){
			var real = document.getElementById(id_realisasi);
			real.value 		= 0;
			progress.value	= progress_aktif.value;
			alert("Nilai Realisasi Melebihi Pagu\nSisa pagu anggaran = "+sisa_pagu_aktif);
		}
	 
     }
    });
		

}

$(document).ready(function(){
  $("#info_isi_kemenpora").hide();  
  $("#info_isi_dispora").hide();
  $("#info_isi_kemenpora_edit").show(); 
  $("#info_isi_dispora_edit").show();  
  $("#file_dokumentasi").hide();  		  
  $("#file_laporan").hide();  		
  $("#file_dokumentasi_edit").show();  	  
  $("#file_laporan_edit").show();  	  
  $("#isi_adakahperubahan").hide(); 

   $("#user").change(function(){
		// tampilkan animasi loading saat pengecekan ke database
    $('#pesan').html("<img src='jquery/loader.gif' title='Proses' alt='proses'/> checking ...");	
    var user  = $("#user").val();     
    $.ajax({
     type:"POST",
     url:"checking.php",    
     data: "user=" + user,
     success: function(data){                 
       if((data==0) && (user!='')){
          $("#pesan").html('<img src="jquery/tick.png" title="OK" alt="OK"> Username belum digunakan');
 	      $('#user').css('border', '3px #090 solid');	
		  $('#submit').removeAttr('disabled');
          $('#submit').css("background","#386B12");
       }  
       else if((data!=0) && (user!='')){
          $("#pesan").html('<img src="jquery/cross.png" title="Terpakai" alt="Terpakai"> Username sudah dipakai');       
 	      $('#user').css('border', '3px #C33 solid');		
		  $('#submit').attr('disabled','disabled');
		  $('#submit').css("background","grey");	
       }else{
          $("#pesan").html(' [Username wajib diisi untuk Login] ');
          $('#user').css('border', '3px #C33 solid');		       
       }
     }
    }); 
	})  
	
   $("#kode_kegiatan_evaluasi").change(function(){	
    var kode_kegiatan_evaluasi  = $("#kode_kegiatan_evaluasi").val();  
    var kode_kegiatan_lama		= $("#kode_kegiatan_lama").val();  
    var kode_program_evaluasi   = $("#kode_program").val();  
    var tahun_anggaran		  	= $("#tahun_anggaran").val();  
    var unit				  	= $("#unit_per_unit_evaluasi").val();  
    var sub_unit				= $("#subunit_per_unit_evaluasi").val();  
    var sub_subunit				= $("#sub_subunit_per_unit_evaluasi").val(); 
    var id_struktur_parent		= $("#id_struktur_parent").val(); 
    var id_struktur_child		= $("#id_struktur_child").val(); 
	
	if (unit==''){
		alert("Isikan unit terlebih dahulu");
		$('#submit').attr('disabled','disabled');		
		$('#submit').css("background","grey");
		$('#kode_kegiatan_evaluasi').attr('value','');		
	}else if (sub_unit==''){
		alert("Isikan sub unit terlebih dahulu");
		$('#submit').attr('disabled','disabled');
		$('#submit').css("background","grey");		
		$('#kode_kegiatan_evaluasi').attr('value','');
	}else if (sub_subunit==''){
		alert("Isikan sub sub unit terlebih dahulu");
		$('#submit').attr('disabled','disabled');
		$('#submit').css("background","grey");		
		$('#kode_kegiatan_evaluasi').attr('value','');
	}else if (kode_program_evaluasi==''){
		alert("Isikan kode program terlebih dahulu");
		$('#submit').attr('disabled','disabled');
		$('#submit').css("background","grey");		
		$('#kode_kegiatan_evaluasi').attr('value','');
	}
	else{
		// tampilkan animasi loading saat pengecekan ke database
		$('#pesan_kode_kegiatan').html("<img src='jquery/loader.gif' title='Proses' alt='proses'/> checking ...");	
		$.ajax({
		 type:"POST",
		 url:"checking_kode_kegiatan_evaluasi.php",    
		 data: "kode_kegiatan_evaluasi="+kode_kegiatan_evaluasi+"&kode_program_evaluasi="+kode_program_evaluasi+"&tahun_anggaran="+tahun_anggaran+"&unit="+unit+"&sub_unit="+sub_unit+"&sub_subunit="+sub_subunit+"&id_struktur_parent="+id_struktur_parent+"&id_struktur_child="+id_struktur_child+"&kode_kegiatan_lama="+kode_kegiatan_lama,
		 success: function(data){
		   if((data==0) && (kode_kegiatan_evaluasi!='')){
			  $("#pesan_kode_kegiatan").html('<img src="jquery/tick.png" title="OK" alt="OK"> Kode Kegiatan belum digunakan');
			  $('#kode_kegiatan_evaluasi').css('border', '3px #090 solid');	
			  $('#submit').removeAttr('disabled');
			  $('#submit').css("background","#386B12");
		   }
		   else if((data!=0) && (kode_kegiatan_evaluasi!='')){
			  $("#pesan_kode_kegiatan").html('<img src="jquery/cross.png" title="Terpakai" alt="Terpakai"> Kode Kegiatan sudah dipakai');
			  $('#kode_kegiatan_evaluasi').css('border', '3px #C33 solid');		
			  $('#submit').attr('disabled','disabled');
			  $('#submit').css("background","grey");
		   }else{
			  $("#pesan_kode_kegiatan").html(' [Kode Kegiatan wajib diisi untuk Login] ');
			  $('#kode_kegiatan_evaluasi').css('border', '3px #C33 solid');		       
		   }
		 }
		}); 
	}
	})  	
	  
  $("#unit_per_unit_kerja").change(function(){
    var unit_per_unit_kerja = $("#unit_per_unit_kerja").val();   
    $.ajax({
        url: "proses_subunit_per_unit_kerja.php",
        data: "unit_per_unit_kerja=" + unit_per_unit_kerja,
        success: function(data){
            // jika data sukses diambil dari server, tampilkan di <select id=subunit>
			$("#sub_subunit_per_unit_kerja").html("<option value='0'>-</option>");
            $("#subunit_per_unit_kerja").html(data);
        }
    });
  });
  
  $("#subunit_per_unit_kerja").change(function(){
    var subunit_per_unit_kerja = $("#subunit_per_unit_kerja").val();
	var unit_per_unit_kerja = $("#unit_per_unit_kerja").val();
    $.ajax({	
        url: "proses_sub_subunit_per_unit_kerja.php",
        data: "subunit_per_unit_kerja=" + subunit_per_unit_kerja +"& unit_per_unit_kerja=" + unit_per_unit_kerja,
        success: function(data){
            $("#sub_subunit_per_unit_kerja").html(data);
        }
    });
  });  

	  
  $("#unit_per_unit_evaluasi").change(function(){
    var unit_per_unit_evaluasi = $("#unit_per_unit_evaluasi").val();
    $.ajax({
        url: "proses_subunit_per_unit_evaluasi.php",
        data: "unit_per_unit_evaluasi=" + unit_per_unit_evaluasi,
        success: function(data){
            // jika data sukses diambil dari server, tampilkan di <select id=subunit>
			$("#sub_subunit_per_unit_evaluasi").html("<option value='0'>-</option>");
            $("#subunit_per_unit_evaluasi").html(data);
        }
    });
  });
  
  $("#subunit_per_unit_evaluasi").change(function(){
    var unit_per_unit_evaluasi = $("#unit_per_unit_evaluasi").val();
	var subunit_per_unit_evaluasi = $("#subunit_per_unit_evaluasi").val();
    $.ajax({
        url: "proses_sub_subunit_per_unit_evaluasi.php",
        data: "subunit_per_unit_evaluasi=" + subunit_per_unit_evaluasi + "& unit_per_unit_evaluasi=" + unit_per_unit_evaluasi,
        success: function(data){
            $("#sub_subunit_per_unit_evaluasi").html(data);
        }
    });
  }); 

  
  $("#unit").change(function(){
    var unit = $("#unit").val();
    $.ajax({
        url: "proses_subunit.php",
        data: "unit=" + unit,
        success: function(data){
            // jika data sukses diambil dari server, tampilkan di <select id=subunit>
			$("#sub_subunit").html("<option value='0'>-</option>");
            $("#subunit").html(data);
        }
    });
  });
  
  $("#id_dispora").change(function(){
    var id_dispora = $("#id_dispora").val();
    $.ajax({
        url: "proses_alamat.php",
        data: "id_dispora=" + id_dispora,
        success: function(data){
            $("#kontak").html(data);
			$("#edit_kontak").hide();  	  		
        }
    });
  });  
  
  $("#id_provinsi").change(function(){
    var id_provinsi = $("#id_provinsi").val();
    $.ajax({
        url: "proses_namadinas.php",
        data: "id_provinsi=" + id_provinsi,
        success: function(data){
            $("#namadinas").html(data);
			$("#edit_namadinas").hide();  	  		
        }
    });
  });    
  
  $("#subunit").change(function(){
    var subunit = $("#subunit").val();
    var unit 	= $("#unit").val();
    $.ajax({
        url: "proses_sub_subunit.php",
        data: "subunit=" + subunit +"&unit="+unit, 
        success: function(data){
            $("#sub_subunit").html(data);
        }
    });
  });  

  $("#status_triwulan").change(function(){
    var status_triwulan = $("#status_triwulan").val();
    var tabel 			= $("#tabel").val();
    var kategori 		= $("#kategori").val();
    var tahun_lama		= $("#tahun_lama").val();
    var st_lama		= $("#st_lama").val();
    $.ajax({
        url: "proses_validasi_tahun.php",
        data: "status_triwulan=" + status_triwulan +"&tabel="+tabel +"&kategori="+kategori +"&tahun_lama="+tahun_lama +"&st_lama="+st_lama,
        success: function(data){
            $("#tahun_triwulan").html(data);
        }
    });
  });  
  
//Akhir Ready Function  
}); 

function info_laporan(){
   var isi_laporan= document.myform.laporan.value;
   if (isi_laporan=='Ada'){
		$("#file_laporan").show();  	
		$("#file_laporan_edit").show();  	  		
	}else{
		$("#file_laporan").hide();  		
		$("#file_laporan_edit").hide();  	  		
	}
   document.myform.laporan.value=isi_laporan;
}

function info_dokumentasi(){
   var isi_dokumen = document.myform.dokumentasi.value;
   if (isi_dokumen=='Ada'){
		$("#file_dokumentasi").show();  	
		$("#file_dokumentasi_edit").show();  	
	}else{
		$("#file_dokumentasi").hide();  		
		$("#file_dokumentasi_edit").hide();  			
	}
}
   
function info_jabatan(){
   var isi = document.myform.jabatan.value;
   if (isi=='Kemenpora'){
		$("#info_isi_kemenpora").show();  	
		$("#info_isi_dispora").hide();  
		$("#info_isi_kemenpora_edit").show(); 
		$("#info_isi_dispora_edit").hide();  		
   }else if (isi=='' || isi=='Administrator'){
		$("#info_isi_kemenpora").hide();  	
		$("#info_isi_dispora").hide();  
		$("#info_isi_kemenpora_edit").hide(); 
		$("#info_isi_dispora_edit").hide();  
   }else{
		$("#info_isi_kemenpora").hide();  	
		$("#info_isi_dispora").show();  
		$("#info_isi_kemenpora_edit").hide(); 
		$("#info_isi_dispora_edit").show();  		
   }
   document.myform.jabatan.value=isi;              
}
               
function info_adakahperubahan(){
   var ada_perubahan = document.userForm.ada_perubahan.value;
   if (ada_perubahan=='Ada'){
		$("#isi_adakahperubahan").show();  	
	}else{
		$("#isi_adakahperubahan").hide();  		
	}
}