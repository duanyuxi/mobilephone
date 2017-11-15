<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>我的地址</title>
<meta name="keywords"  content="KEYWORDS..." />
<meta name="description" content="DESCRIPTION..." />
<meta name="author" content="DeathGhost" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name='apple-touch-fullscreen' content='yes'>
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta name="format-detection" content="address=no">
<link rel="icon" href="/Public/images/icon/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon-precomposed" sizes="57x57" href="/Public/images/icon/apple-touch-icon-57x57-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="120x120" href="/Public/images/icon/apple-touch-icon-120x120-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="196x196" href="/Public/images/icon/apple-touch-icon-196x196-precomposed.png">
<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" type="text/css" href="/Public/css/style.css" />
<script src="js/jquery.js"></script>
<script>
$(document).ready(function(){
  //测试返回页面，程序对接删除即可
  $(".userForm input[type='button']").click(function(){
	  alert("地址修改成功！");
	  location.href="../usercenter/user_set.html";
	  });	
});
</script>
</head>
<body>
<!--header-->
<header>
 <a href="javascript:history.go(-1);" class="iconfont backIcon">&#60;</a>
 <h1>我的地址</h1>
</header>
<div style="height:1rem;"></div>
<ul class="userForm">
 <li>
  <input type="text" value="DeathGhost"/>
 </li>
 <li>
  <select>
   <option>陕西省</option>
  </select>
 </li>
 <li>
  <select>
   <option>西安市</option>
  </select>
 </li>
 <li>
  <select>
   <option>雁塔区</option>
  </select>
 </li>
 <li>
  <textarea>省体育场220号</textarea>
 </li>
 <li>
  <input type="button" value="修改地址" class="formLastBtn"/>
 </li>
</ul>
</body>
</html>