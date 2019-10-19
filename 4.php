<?php 

function hitungParkir($durasi){

	if ($durasi <= 3) {
		$hargaParkir = $durasi * 2000;
	}

	if($durasi >= 4) {
		$jamSelanjutnya = $durasi - 3;
		$hargaParkir = $jamSelanjutnya*1000 + 6000;
	}

	if ($hargaParkir > 10000) {
		$hargaParkir = 10000;
	}

	echo "Harga parkir adalah => ".$hargaParkir;
} 

hitungParkir(8);

 ?>