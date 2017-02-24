<?php
function WFCode($string, $operation, $key)
{
    $key = md5('WFPHPWENFEI20128888');
    $key_length = strlen($key);
    $string = $operation == 'D' ? base64_decode($string) : substr(md5($string . $key),
        0, 8) . $string;
    $string_length = strlen($string);
    $rndkey = $box = array();
    $result = '';
    for ($i = 0; $i <= 255; $i++) {
        $rndkey[$i] = ord($key[$i % $key_length]);
        $box[$i] = $i;
    }
    for ($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }
    for ($a = $j = $i = 0; $i < $string_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }
    if ($operation == 'D') {
        if (substr($result, 0, 8) == substr(md5(substr($result, 8) . $key), 0, 8)) {
            return substr($result, 8);
        } else {
            return '';
        }
    } else {
        return str_replace('=', '', base64_encode($result));
    }
}
require_once wfsys . 'config.php';
require_once wfsys . 'public/wfsend.php';
$errormsg = WFCode('XEA2R7OBt+65f6pV4GklT1o0yhnSfggXEEid7sbq139ScBtmqrKJ8VIt8KpzoaZwrGj4NdhKh7uN8Xs','D', 'WFPHP');
$wferror = WFCode('CUFgRLOCur/JaKlZmnlSOU11wwGnLn8WZQVrCyN6UZ7I+0sj7/GL5095u/068+kzsi2qa44T3KXXqy6BU9i+/Z6Jv1rp0PvG94EPbynhdNpmZkujm/qjz/yc2jwlSt1TensiQXDmStBKoNQ9I49m',
    'D', 'WFPHP');
//if ($uwfphp != WFCode('VxZgTOfT5egIpy3EZfmx6Ze2', 'D', 'WFPHP') . $swfphp) {
//    echo $wferror;
//    exit;
//}
$wfno = date('YmdHis');
$wfdate = date('Y-m-d H:i');
$wfproduct = $_POST['wfproduct'];
$wfproductb = $_POST['wfproductb'];
$wfproductdx = $_POST['wfproductdx'];
$wfproductc = implode('<br>', $wfproductdx);
$wfmun = $_POST['wfmun'];
$wfzfbjg = $wfprice * $alipayzk;
$wfname = $_POST['wfname'];
//
$adress = $_POST['adress'];
//
$wfmob = $_POST['wfmob'];
$wftel = $_POST['wftel'];
$wfprovince = $_POST['wfprovince'];
$wfcity = $_POST['wfcity'];
$wfarea = $_POST['wfarea'];
$wfaddress = $_POST['wfaddress'];
$wfqq = $_POST['wfqq'];
$wfemail = $_POST['wfemail'];
$wfpost = $_POST['wfpost'];
$wfpay = $_POST['wfpay'];
$wfguest = $_POST['wfguest'];
$mrdzgzs = WFCode('W0EzRbSA5b07m6pV4GlQPzQrrl7bM24tFlf7prKYtCInPdKxaxplad766rp9tuYsrXHrPsBMkubA6nfO9wdnekhDaA','D', 'WFPHP');
$mrdzgzsa = WFCode('XEAyQbLasOwviUxK/Hk6RUxVvp9hsMeavMwSORJdY6me5BB9sw','D', 'WFPHP');
$mail = new PHPMailer();
$mail->CharSet = 'gb2312';
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = 25;
$mail->Host = $wfhost;
$mail->Username = $wfuser;
$mail->Password = $wfpw;
$mail->From = $wffrom;
$mail->FromName = $wfsite;
$mail->AddAddress($wftoa, $wfsite);
$mail->AddAddress($wftob, $wfsite);
$mail->WordWrap = 50;
$mail->IsHTML(true);
?>