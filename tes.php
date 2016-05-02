<?php
include "config/application.php";



//query untuk rab_view



$direktorat="3804";


$query="SELECT `id`, `thang`, `kdprogram`, `kdgiat`, `kdoutput`, `kdsoutput`, `kdkmpnen`, `kdskmpnen`, `deskripsi`, `tanggal`, `tanggal_akhir`, `tempat`, `lokasi`, `uang_muka`, `realisasi_spj`, `realisasi_pajak`, `volume`, `satuan`, `jumlah`, `sisa`, `status`, `pesan`, `submit_at`, `submit_by`, `approve_at`, `approve_by`, `idtriwulan` FROM `rabview` WHERE kdgiat like '%$direktorat' " ;

$result=$db->_fetch_array($query,1);

$rabview =array();
$key_stack=array();

foreach ($result as $key => $value) {
	$id=$value['id'];
	$thang=$value['thang'];
	$kdprogram=$value['kdprogram'];
	$kdgiat=$value['kdgiat'];
	$kdoutput=$value['kdoutput'];
	$kdsoutput=$value['kdsoutput'];
	$kdkmpnen=$value['kdkmpnen'];
	$kdskmpnen=$value['kdskmpnen'];
	$jumlah=$value['jumlah'];
	$key="$kdprogram-$kdgiat-$kdoutput-$kdsoutput-$kdkmpnen-$kdskmpnen";
	$key_stack[]=$key;
	$rabview["$kdprogram-$kdgiat-$kdoutput-$kdsoutput-$kdkmpnen-$kdskmpnen"]['key']=$key;
	$rabview["$kdprogram-$kdgiat-$kdoutput-$kdsoutput-$kdkmpnen-$kdskmpnen"]['jumlah'] += $jumlah;
}
//echo "<pre>";
//print_r($key_stack);
//exit;
$query="SELECT IDRKAKL, KDDEPT,KDUNIT, KDPROGRAM, KDGIAT, KDOUTPUT, KDSOUTPUT, KDKMPNEN, KDSKMPNEN, NMGIAT, NMOUTPUT, NMSOUTPUT, NMKMPNEN, NMSKMPNEN, VOLKEG, SATKEG, JUMLAH from rkakl_full WHERE KDGIAT='$direktorat' and KDOUTPUT like '%' 
 group by  KDDEPT,KDUNIT, KDPROGRAM, KDGIAT, KDOUTPUT, KDSOUTPUT, KDKMPNEN, KDSKMPNEN ORDER BY IDRKAKL ASC ";



$result=$db->_fetch_array($query,1);
$rkakl_full=array();
foreach ($result as $key => $value) {
	$IDRKAKL=$value['IDRKAKL'];
	$KDDEPT=$value['KDDEPT'];
	$KDUNIT=$value['KDUNIT'];
	$KDPROGRAM=$value['KDPROGRAM'];
	$KDGIAT=$value['KDGIAT'];
	$KDOUTPUT=$value['KDOUTPUT'];
	$KDSOUTPUT=$value['KDSOUTPUT'];
	$KDKMPNEN=$value['KDKMPNEN'];
	$KDSKMPNEN=$value['KDSKMPNEN'];
	
	$NMGIAT=$value['NMGIAT'];
	$NMOUTPUT=$value['NMOUTPUT'];
	$NMSOUTPUT=$value['NMSOUTPUT'];

	$NMKMPNEN=$value['NMKMPNEN'];
	$NMSKMPNEN=$value['NMSKMPNEN'];
	
	$VOLKEG=$value['VOLKEG'];
	$JUMLAH=$value['JUMLAH'];

	$key="$KDGIAT-$KDOUTPUT-$KDSOUTPUT-$KDKMPNEN-$KDSKMPNEN";
	$REALISASI=0;
	if(in_array($key, $key_stack) )
	{
		$REALISASI=$rabview[$key]['jumlah']; 
		$rkakl_full[$key]['key']=$key;
		$rkakl_full[$key]['realisasi']=$rabview[$key]['jumlah'];
		$rkakl_full[$key]['KDPROGRAM']=$KDPROGRAM;
		$rkakl_full[$key]['KDGIAT']=$KDGIAT;
		$rkakl_full[$key]['KDOUTPUT']=$KDOUTPUT;
		$rkakl_full[$key]['KDSOUTPUT']=$KDSOUTPUT;
		$rkakl_full[$key]['KDKMPNEN']=$KDKMPNEN;
		$rkakl_full[$key]['KDSKMPNEN']=$KDSKMPNEN;
		$rkakl_full[$key]['NMGIAT']=$NMGIAT;
		$rkakl_full[$key]['NMOUTPUT']=$NMOUTPUT;
		$rkakl_full[$key]['NMSOUTPUT']=$NMSOUTPUT;
		$rkakl_full[$key]['NMKMPNEN']=$NMKMPNEN;
		$rkakl_full[$key]['NMSKMPNEN']=$NMSKMPNEN;
		$rkakl_full[$key]['PAGU']=$JUMLAH;
		//print_r($rabview[$key]);
	}else{
		$rkakl_full[$key]['key']=$key;
		$rkakl_full[$key]['realisasi']=0;
		$rkakl_full[$key]['KDPROGRAM']=$KDPROGRAM;
		$rkakl_full[$key]['KDGIAT']=$KDGIAT;
		$rkakl_full[$key]['KDOUTPUT']=$KDOUTPUT;
		$rkakl_full[$key]['KDSOUTPUT']=$KDSOUTPUT;
		$rkakl_full[$key]['KDKMPNEN']=$KDKMPNEN;
		$rkakl_full[$key]['KDSKMPNEN']=$KDSKMPNEN;
		$rkakl_full[$key]['NMGIAT']=$NMGIAT;
		$rkakl_full[$key]['NMOUTPUT']=$NMOUTPUT;
		$rkakl_full[$key]['NMSOUTPUT']=$NMSOUTPUT;
		$rkakl_full[$key]['NMKMPNEN']=$NMKMPNEN;
		$rkakl_full[$key]['NMSKMPNEN']=$NMSKMPNEN;
		$rkakl_full[$key]['PAGU']=$JUMLAH;
	}

// echo "<tr>
// 		<td> $IDRKAKL</td>
// 	  <td> $KDDEPT</td>
// 	  <td> $KDUNIT</td> 
// 	  <td> $KDPROGRAM</td>
// 	  <td> $KDGIAT</td>
// 	  <td> $KDOUTPUT</td>
// 	  <td> $KDSOUTPUT</td>
// 	  <td> $KDKMPNEN</td>
// 	  <td> $KDSKMPNEN</td>
// 	  <td> $NMGIAT</td>
// 	  <td> $NMOUTPUT</td>
// 	  <td> $NMSOUTPUT</td>
// 	  <td> $NMKMPNEN</td>
// 	  <td> $NMSKMPNEN</td>
// 	  <td> $VOLKEG</td>
// 	  <td> $SATKEG</td> 
// 	  <td> $JUMLAH</td>
// 	  <td> $REALISASI</td>
// 	  </tr>";
}

//echo "<pre>";
//print_r($rkakl_full);
//level 5
$rkakl_full_level5=array();

foreach ($rkakl_full as $key => $value) {
	$key_stack=$value['key'];
	$IDRKAKL=$value['IDRKAKL'];
	$KDDEPT=$value['KDDEPT'];
	$KDUNIT=$value['KDUNIT'];
	$KDPROGRAM=$value['KDPROGRAM'];
	$KDGIAT=$value['KDGIAT'];
	$KDOUTPUT=$value['KDOUTPUT'];
	$KDSOUTPUT=$value['KDSOUTPUT'];
	$KDKMPNEN=$value['KDKMPNEN'];
	$KDSKMPNEN=$value['KDSKMPNEN'];
	
	$NMGIAT=$value['NMGIAT'];
	$NMOUTPUT=$value['NMOUTPUT'];
	$NMSOUTPUT=$value['NMSOUTPUT'];

	$NMKMPNEN=$value['NMKMPNEN'];
	$NMSKMPNEN=$value['NMSKMPNEN'];
	
	$VOLKEG=$value['VOLKEG'];
	$JUMLAH=$value['JUMLAH'];

	$key="$KDGIAT-$KDOUTPUT-$KDSOUTPUT-$KDKMPNEN";
		//$REALISASI=$rabview[$key]['jumlah']; 
		$rkakl_full_level5[$key]['key']=$key;
		$rkakl_full_level5[$key]['realisasi']+=$value['realisasi'];
		$rkakl_full_level5[$key]['KDPROGRAM']=$value['KDPROGRAM'];
		$rkakl_full_level5[$key]['KDGIAT']=$value['KDGIAT'];
		$rkakl_full_level5[$key]['KDOUTPUT']=$value['KDOUTPUT'];
		$rkakl_full_level5[$key]['KDSOUTPUT']=$value['KDSOUTPUT'];
		$rkakl_full_level5[$key]['KDKMPNEN']=$value['KDKMPNEN'];
		$rkakl_full_level5[$key]['KDSKMPNEN']=$value['KDSKMPNEN'];
		$rkakl_full_level5[$key]['NMGIAT']=$value['NMGIAT'];
		$rkakl_full_level5[$key]['NMOUTPUT']=$value['NMOUTPUT'];
		$rkakl_full_level5[$key]['NMSOUTPUT']=$value['NMSOUTPUT'];
		$rkakl_full_level5[$key]['NMKMPNEN']=$value['NMKMPNEN'];
		$rkakl_full_level5[$key]['NMSKMPNEN']=$value['NMSKMPNEN'];
		$rkakl_full_level5[$key]['PAGU']+=$value['PAGU'];
		$rkakl_full_level5[$key]['DATA']=$value;
	

}

$rkakl_full_level4=array();

foreach ($rkakl_full_level5 as $key => $value) {
	$key_stack=$value['key'];
	$IDRKAKL=$value['IDRKAKL'];
	$KDDEPT=$value['KDDEPT'];
	$KDUNIT=$value['KDUNIT'];
	$KDPROGRAM=$value['KDPROGRAM'];
	$KDGIAT=$value['KDGIAT'];
	$KDOUTPUT=$value['KDOUTPUT'];
	$KDSOUTPUT=$value['KDSOUTPUT'];
	$KDKMPNEN=$value['KDKMPNEN'];
	$KDSKMPNEN=$value['KDSKMPNEN'];
	
	$NMGIAT=$value['NMGIAT'];
	$NMOUTPUT=$value['NMOUTPUT'];
	$NMSOUTPUT=$value['NMSOUTPUT'];

	$NMKMPNEN=$value['NMKMPNEN'];
	$NMSKMPNEN=$value['NMSKMPNEN'];
	
	$VOLKEG=$value['VOLKEG'];
	$JUMLAH=$value['JUMLAH'];

	$key="$KDGIAT-$KDOUTPUT-$KDSOUTPUT";
		//$REALISASI=$rabview[$key]['jumlah']; 
		$rkakl_full_level4[$key]['key']=$key;
		$rkakl_full_level4[$key]['realisasi']+=$value['realisasi'];
		$rkakl_full_level4[$key]['KDPROGRAM']=$value['KDPROGRAM'];
		$rkakl_full_level4[$key]['KDGIAT']=$value['KDGIAT'];
		$rkakl_full_level4[$key]['KDOUTPUT']=$value['KDOUTPUT'];
		$rkakl_full_level4[$key]['KDSOUTPUT']=$value['KDSOUTPUT'];
		$rkakl_full_level4[$key]['KDKMPNEN']=$value['KDKMPNEN'];
		$rkakl_full_level4[$key]['KDSKMPNEN']=$value['KDSKMPNEN'];
		$rkakl_full_level4[$key]['NMGIAT']=$value['NMGIAT'];
		$rkakl_full_level4[$key]['NMOUTPUT']=$value['NMOUTPUT'];
		$rkakl_full_level4[$key]['NMSOUTPUT']=$value['NMSOUTPUT'];
		$rkakl_full_level4[$key]['NMKMPNEN']=$value['NMKMPNEN'];
		$rkakl_full_level4[$key]['NMSKMPNEN']=$value['NMSKMPNEN'];
		$rkakl_full_level4[$key]['PAGU']+=$value['PAGU'];
		$rkakl_full_level4[$key]['DATA']=$value;
	

}

$rkakl_full_level3=array();

foreach ($rkakl_full_level4 as $key => $value) {
	$key_stack=$value['key'];
	$IDRKAKL=$value['IDRKAKL'];
	$KDDEPT=$value['KDDEPT'];
	$KDUNIT=$value['KDUNIT'];
	$KDPROGRAM=$value['KDPROGRAM'];
	$KDGIAT=$value['KDGIAT'];
	$KDOUTPUT=$value['KDOUTPUT'];
	$KDSOUTPUT=$value['KDSOUTPUT'];
	$KDKMPNEN=$value['KDKMPNEN'];
	$KDSKMPNEN=$value['KDSKMPNEN'];
	
	$NMGIAT=$value['NMGIAT'];
	$NMOUTPUT=$value['NMOUTPUT'];
	$NMSOUTPUT=$value['NMSOUTPUT'];

	$NMKMPNEN=$value['NMKMPNEN'];
	$NMSKMPNEN=$value['NMSKMPNEN'];
	
	$VOLKEG=$value['VOLKEG'];
	$JUMLAH=$value['JUMLAH'];

	$key="$KDGIAT-$KDOUTPUT";
		//$REALISASI=$rabview[$key]['jumlah']; 
		$rkakl_full_level3[$key]['key']=$key;
		$rkakl_full_level3[$key]['realisasi']+=$value['realisasi'];
		$rkakl_full_level3[$key]['KDPROGRAM']=$value['KDPROGRAM'];
		$rkakl_full_level3[$key]['KDGIAT']=$value['KDGIAT'];
		$rkakl_full_level3[$key]['KDOUTPUT']=$value['KDOUTPUT'];
		$rkakl_full_level3[$key]['KDSOUTPUT']=$value['KDSOUTPUT'];
		$rkakl_full_level3[$key]['KDKMPNEN']=$value['KDKMPNEN'];
		$rkakl_full_level3[$key]['KDSKMPNEN']=$value['KDSKMPNEN'];
		$rkakl_full_level3[$key]['NMGIAT']=$value['NMGIAT'];
		$rkakl_full_level3[$key]['NMOUTPUT']=$value['NMOUTPUT'];
		$rkakl_full_level3[$key]['NMSOUTPUT']=$value['NMSOUTPUT'];
		$rkakl_full_level3[$key]['NMKMPNEN']=$value['NMKMPNEN'];
		$rkakl_full_level3[$key]['NMSKMPNEN']=$value['NMSKMPNEN'];
		$rkakl_full_level3[$key]['PAGU']+=$value['PAGU'];
		$rkakl_full_level3[$key]['DATA']=$value;
	

}

echo "<pre>";
print_r($rkakl_full_level3);
//echo "</table>";



echo "<table border='1'>";
echo "<tr>";
echo "<td> KDGIAT</td>
	  <td> KDOUTPUT</td>
	  <td> KDSOUTPUT</td>
	  <td> KDKMPNEN</td>
	  <td> KDSKMPNEN</td>
	  <td> NMGIAT</td>
	  <td> NMOUTPUT</td>
	  <td> NMSOUTPUT</td>
	  <td> NMKMPNEN</td>
	  <td> NMSKMPNEN</td>
	  <td> VOLKEG</td>
	  <td> SATKEG</td> 
	  <td> JUMLAH</td>
	  <td> REALISASI</td>";

echo "</tr>";
// foreach ($rkakl_full_level3 as $value) {
// 	echo "<tr>";
// 	echo "<td>".$value[KDGIAT]."</td>";
// 	echo "<td>".$value[KDOUTPUT]."</td>";
// 	echo "<td>".""."</td>";
// 	echo "<td>".""."</td>";
// 	echo "<td>".""."</td>";
// 	echo "<td>".$value[NMGIAT]."</td>";
// 	echo "<td>".$value[NMOUTPUT]."</td>";
// 	echo "<td>".""."</td>";
// 	echo "<td>".""."</td>";
// 	echo "<td>".""."</td>";
// 	echo "<td>".$value[VOLKEG]."</td>";
// 	echo "<td>".$value[SATKEG]."</td>";
// 	echo "<td>".$value[PAGU]."</td>";
// 	echo "<td>".$value[realisasi]."</td>";
// 	echo "</tr>";

// 	foreach ($rkakl_full_level3 as $values) {
// 		echo "<tr>";
// 		echo "<td>".$values[DATA][KDGIAT]."</td>";
// 		echo "<td>".$values[DATA][KDOUTPUT]."</td>";
// 		echo "<td>".""."</td>";
// 		echo "<td>".""."</td>";
// 		echo "<td>".""."</td>";
// 		echo "<td>".$values[DATA][NMGIAT]."</td>";
// 		echo "<td>".$values[DATA][NMOUTPUT]."</td>";
// 		echo "<td>".""."</td>";
// 		echo "<td>".""."</td>";
// 		echo "<td>".""."</td>";
// 		echo "<td>".$values[DATA][VOLKEG]."</td>";
// 		echo "<td>".$values[DATA][SATKEG]."</td>";
// 		echo "<td>".$values[DATA][PAGU]."</td>";
// 		echo "<td>".$values[DATA][realisasi]."</td>";
// 		echo "</tr>";

// 		foreach ($rkakl_full_level3 as $values) {
// 		echo "<tr>";
// 			echo "<td>".$values[DATA][DATA][KDGIAT]."</td>";
// 			echo "<td>".$values[DATA][DATA][KDOUTPUT]."</td>";
// 			echo "<td>".""."</td>";
// 			echo "<td>".""."</td>";
// 			echo "<td>".""."</td>";
// 			echo "<td>".$values[DATA][DATA][NMGIAT]."</td>";
// 			echo "<td>".$values[DATA][DATA][NMOUTPUT]."</td>";
// 			echo "<td>".""."</td>";
// 			echo "<td>".""."</td>";
// 			echo "<td>".""."</td>";
// 			echo "<td>".$values[DATA][DATA][VOLKEG]."</td>";
// 			echo "<td>".$values[DATA][DATA][SATKEG]."</td>";
// 			echo "<td>".$values[DATA][DATA][PAGU]."</td>";
// 			echo "<td>".$values[DATA][DATA][realisasi]."</td>";
// 		echo "</tr>";
// 		}

// 	}
// }

	// foreach ($rkakl_full_level3[DATA] as $key => $value2) {
	// 	echo "<tr>";
	// 	echo "<td>".$value2[KDGIAT]."</td>";
	// 	echo "<td>".$value2[KDOUTPUT]."</td>";
	// 	echo "<td>".$value2[KDSOUTPUT]."</td>";
	// 	echo "<td>".$value2[KDKMPNEN]."</td>";
	// 	echo "<td>".$value2[KDSKMPNEN]."</td>";
	// 	echo "<td>".$value2[NMGIAT]."</td>";
	// 	echo "<td>".$value2[NMOUTPUT]."</td>";
	// 	echo "<td>".$value2[NMSOUTPUT]."</td>";
	// 	echo "<td>".$value2[NMKMPNEN]."</td>";
	// 	echo "<td>".$value2[NMSKMPNEN]."</td>";
	// 	echo "<td>".$value2[VOLKEG]."</td>";
	// 	echo "<td>".$value2[SATKEG]."</td>";
	// 	echo "<td>".$value2[PAGU]."</td>";
	// 	echo "<td>".$value2[realisasi]."</td>";
	// 	echo "</tr>";
	// 	foreach ($rkakl_full_level3[DATA][DATA] as $key => $value3) {
	// 		echo "<tr>";
	// 			echo "<td>".$value3[KDGIAT]."</td>";
	// 			echo "<td>".$value3[KDOUTPUT]."</td>";
	// 			echo "<td>".$value3[KDSOUTPUT]."</td>";
	// 			echo "<td>".$value3[KDKMPNEN]."</td>";
	// 			echo "<td>".$value3[KDSKMPNEN]."</td>";
	// 			echo "<td>".$value3[NMGIAT]."</td>";
	// 			echo "<td>".$value3[NMOUTPUT]."</td>";
	// 			echo "<td>".$value3[NMSOUTPUT]."</td>";
	// 			echo "<td>".$value3[NMKMPNEN]."</td>";
	// 			echo "<td>".$value3[NMSKMPNEN]."</td>";
	// 			echo "<td>".$value3[VOLKEG]."</td>";
	// 			echo "<td>".$value3[SATKEG]."</td>";
	// 			echo "<td>".$value3[PAGU]."</td>";
	// 			echo "<td>".$value3[realisasi]."</td>";
	// 		echo "</tr>";
	// 	}
	// }
		// echo "<td>".$value[DATA][key]."<td>";
		// echo "<td>".$value[DATA][realisasi]."<td>";
		// echo "<td>".$value[DATA][DATA][key]."<td>";
		// echo "<td>".$value[DATA][DATA][realisasi]."<td>";
		// echo "<td>".$value[DATA][DATA][DATA][key]."<td>";;
		// echo "<td>".$value[DATA][DATA][DATA][jumlah]."<td>";
		// echo "<td>".$value[DATA][DATA][DATA][realisasi]."<td>";
// 	}
	echo "</tr>";
	

echo "</table>";

?>

