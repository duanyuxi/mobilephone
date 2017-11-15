<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>搜索</title>
<meta name="keywords"  content="KEYWORDS..." />
<meta name="description" content="DESCRIPTION..." />
<meta name="author" content="DeathGhost" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name='apple-touch-fullscreen' content='yes'>
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta name="format-detection" content="address=no">
<link rel="icon" href="images/icon/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon-precomposed" sizes="57x57" href="images/icon/apple-touch-icon-57x57-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="120x120" href="images/icon/apple-touch-icon-120x120-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="196x196" href="images/icon/apple-touch-icon-196x196-precomposed.png">
<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" type="text/css" href="/Public/css/style.css" />
<script src="/Public/js/jquery.js"></script>
<script>
$(document).ready(function(){
  $(".searchHistory dd:last a").click(function(){
	  var clear=confirm("确定清除搜索记录吗?");
	  if(clear==true){
		  $(this).parents(".searchHistory").find("dd").remove();
		  }
	  });	
});
</script>
</head>
<body>
<!--header-->
<header>
 <a href="javascript:history.go(-1);" class="iconfont backIcon">&#60;</a>
 <h1>搜索</h1>
</header>
<div style="height:1rem;"></div>
<aside class="searchArea">
 <form method="post" action="<?php echo U('goods/search_view');?>" class="form">
 <input type="text" name="goodsname" placeholder="寻找调料、食材..."/>
 <input type="button" value="&#63;" class="searchBtn"/>
 </form>
</aside>
<dl class="searchHistory">
 <dt>历史搜索</dt>
 <dd>
  <ul>
   <li><a href="category.html">白菜</a></li>
   <li><a href="category.html">菠菜</a></li>
   <li><a href="category.html">醋</a></li>
   <li><a href="category.html">东北大米</a></li>
  </ul>
 </dd>
 <dd>
  <a>清空历史记录</a>
 </dd>
</dl>

</body>
</html>
<script>
 $(".searchBtn").click(function(){
     alert('aa');
     $(".form").submit();
 })
</script>