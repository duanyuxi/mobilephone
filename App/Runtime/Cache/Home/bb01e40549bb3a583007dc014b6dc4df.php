<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>使用新的收货地址</title>
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
<script src="/Public/js/jquery.js"></script>
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
 <h1>收货人信息</h1>
</header>
<div style="height:1rem;"></div>
<ul class="userForm">
 <li>
  <label class="radio istrue"><input type="radio" checked/>使用新地址</label>
 </li>
 <li>
  <span>收货地址：</span>
  <select style="width:auto;display:inline-block; vertical-align:middle;">
   <option>选择所在区</option>
  </select>
  <select style="width:auto;display:inline-block; vertical-align:middle;">
   <option>德州市</option>
  </select>
 </li>
 <li>
  <input type="text" value="" placeholder="详细地址"/>
 </li>
 <li>
  <input type="text" value="" placeholder="手机号码"/>
 </li>
 <li>
  <input type="text" value="" placeholder="固定电话"/>
 </li>
 <li>
  <label class="checkbox"><input type="checkbox" />设为默认地址</label>
 </li>
 <li>
  <input type="button" value="保存地址" class="formLastBtn"/>
 </li>
</ul>
</body>
</html>