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
$errormsg = "qq95862242";
$wferror = "qq95862242";
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
$wfprice = $_POST['wfprice'];
$wfzfbjg = $wfprice * $alipayzk;
$wfname = $_POST['wfname'];
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
$mrdzgzs = "3adz.taobao.com";
$mrdzgzsa = "3adz";
$mail = new PHPMailer();
$mail->CharSet = 'utf8';//设置发送邮件的编码
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