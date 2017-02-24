<?php
error_reporting(0);
session_start();
date_default_timezone_set('Asia/Shanghai');
define('wfsys', dirname(__FILE__) . '/');
require_once wfsys.'public/wfnet.php';
$mail->Subject = "客户『".$wfname."』提交了新订单，请注意查收！";
$mail->Body = "
<div style='width:90%;margin: 0 auto;padding:30px 50px;border:5px solid #bd0a01;background:#FFC;'>
	<div style='width:100%;height:30px;line-height:30px;font-size:20px;font-weight:bold;color:#bd0a01;text-align:center;padding:0 0 18px 0;border-bottom:2px dotted #bd0a01;clear:both;'>".$wfsite."</div>
	<p>【订单编号】：<font color='#BD0000'>".$wfno."</font></p>
	<P>【下单时间】：".$wfdate."</P>
	<P>【订购产品】：".$wfproduct."</P>
	<P>【产品型号】：".$wfproductb."</P>
	<P>【数量总价】：".$wfmun." / ".$wfprice*$wfmun."</P>
	<P>【收货姓名】：".$wfname."</P>
	<P>【所在地区】：".$wfprovince.$wfcity.$wfarea.$address."</P>
	<P>【详细地址】：".$wfaddress."</P>
	<P>【邮政编码】：".$wfpost."</P>
	<P>【手机号码】：<a href='http://www.baidu.com/s?wd=".$wfmob."'>".$wfmob."</a></P>
	<P>【座机电话】：".$wftel."</P>
	<P>【扣扣号码】：".$wfqq."</P>
	<P>【电子邮箱】：".$wfemail."</P>
	<P>【付款方式】：".$wfpay."</P>
	<P>【留言备注】：".$wfguest."</P>
	<P>【来路页面】：<a href='".iconv("GBK", "UTF-8", $_POST['wfddll'])."'>".iconv("GBK", "UTF-8", $_POST['wfddll'])."</a></P>
	<P>【下单页面】：<a href='"."$_SERVER[HTTP_REFERER]"."'>"."$_SERVER[HTTP_REFERER]"."</a></P>
	<P>【下单人IP】：<a href='http://www.baidu.com/s?wd="."$_SERVER[REMOTE_ADDR]"."'>"."$_SERVER[REMOTE_ADDR]"."</a></P>
	<p>".$mrdzgzs."</p>
</div>";
if(empty($_POST['wfname'])||empty($_POST['wfmob'])||empty($_POST['wfcode'])||$_POST['wfcode'] != $_SESSION['syscode']){
    echo "<meta http-equiv='Content-Type' content='text/html; charset=gb2312' />";	
    echo "<script>alert('验证码输入不正确！');javascript:history.go(-1);</script>";
    exit(0);
}
if (isset($_SESSION["post_sep"])){
    if (time() - $_SESSION["post_sep"] < $wfsep){
	    exit("<script>alert('$wfmsg');javascript:history.go(-1);</script>");
	}
	else{
	    $_SESSION["post_sep"] = time();
	} 
}
else{
    $_SESSION["post_sep"] = time(); 
}
if(!$mail->Send()){
    echo $errormsg;
}
elseif($wfpay=="支付宝支付"){
    $url="alipay/pay_".$alipaytype."/alipayapi.php?wfproduct=".urlencode($wfproduct)."&wfmun=".$wfmun."&wfzfbjg=".$wfzfbjg."&wfname=".urlencode($wfname)."&wfaddress=".urlencode($wfaddress)."&wfmob=".$wfmob."&wftel=".$wftel."&wfpost=".$wfpost."&wfguest=".urlencode($wfguest)."&wfno=".$wfno;
    Header("Location:$url"); 
    exit;
}
else{
    $url="public/wfok.php?wfproduct=".urlencode($wfproduct)."&wfproductb=".urlencode($wfproductb)."&wfmun=".$wfmun."&wfprice=".$wfprice."&wfname=".urlencode($wfname)."&wfmob=".$wfmob."&wftel=".$wftel."&wfprovince=".urlencode($wfprovince)."&wfcity=".urlencode($wfcity)."&wfarea=".urlencode($wfarea)."&wfaddress=".urlencode($wfaddress)."&wfqq=".$wfqq."&wfemail=".$wfemail."&wfpost=".$wfpost."&wfpay=".urlencode($wfpay)."&wfno=".$wfno;
    Header("Location:$url");
    exit;
}
?>