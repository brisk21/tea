<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>订单确认</title>
	<style type="text/css">
        <!--
        *{margin:0;padding:0;}
        body{font:14px Arial,Verdana,simsun,\u5b8b\u4f53;color:#333;text-align:left;padding-top:100px;background-color:#fff;} 
        a:link,a:visited{color:#F00;text-decoration:none;}a:hover{color:#090;text-decoration:underline;}
		ul,li{list-style:none;display:block;}
        img{border:0 none;vertical-align:middle;}
		#head{width:620px;margin:0 auto;height:90px;padding:20px;text-align:center;border-bottom:2px dotted #DDD;}
		#foot{width:620px;margin:0 auto;height:90px;padding:20px;text-align:center;border-top:2px dotted #DDD;}
        #wfok{width:600px;margin:20px auto;height:auto;padding:20px;}
        #wfok li{width:600px;height:40px;line-height:40px;border-bottom:1px dotted #DDD;}    
        #wfok li span.l{float:left;width:120px;text-align:right;}    
        #wfok li span.r{float:right;width:450px;color:#BD0000;}   
        -->
    </style>
</head>
<body>
	<div id="head">
		<img src="../template/img/wfok.gif" />
	</div>
	<div id="wfok">
		<ul>
			<li>
				<span class="l">订单号：</span>
				<span class="r"><?php echo $_GET['wfno']; ?></span>
			</li>
			<li>
				<span class="l">订购产品：</span>
				<span class="r"><?php echo $_GET['wfproduct']; ?></span>
			</li>
			<li>
				<span class="l">收货人姓名：</span>
				<span class="r"><?php echo $_GET['wfname']; ?></span>
			</li>
			<li>
				<span class="l">手机号码：</span>
				<span class="r"><?php echo $_GET['wfmob']; ?></span>
			</li>
			<?php if(!empty($_GET['wfprovince'])){echo "
			<li>
				<span class='l'>所在地区：</span>
				<span class='r'>".$_GET['wfprovince'].$_GET['wfcity'].$_GET['wfarea']."</span>
			</li>";}?>
			<li>
				<span class="l">付款方式：</span>
				<span class="r"><?php echo $_GET['wfpay']; ?></span>
			</li>
		</ul>
	</div>
	<div id="foot">
		<a href='javascript:history.go(-1);' title="返回首页"><img src="../template/img/wfgo.gif" alt="返回首页" /></a>
	</div>
	<!-------------------------- 此处添加统计转化代码 -------------------------->

	<!-------------------------- 此处添加统计转化代码 -------------------------->
	<!-- wgscf.com Baidu tongji analytics -->
	<script type="text/javascript">
	var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
	document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F70660165f15de80064f3dd0fef5fddc8' type='text/javascript'%3E%3C/script%3E"));
	</script>
</body>
</html>