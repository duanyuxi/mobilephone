<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>个人中心</title>
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
</head>
<body>
<!--header-->
<header>
 <a href="javascript:history.go(-1);" class="iconfont backIcon">&#60;</a>
 <h1>个人中心</h1>
 <a href="user_set.html" class="iconfont setIcon">&#42;</a>
</header>
<div style="height:1rem;"></div>
<div class="userInfor">
 <a class="userIcon"><img src="/Public/images/icon/DefaultAvatar.jpg"/></a>
 <h2>DeathGhost</h2>
</div>
<ul class="userList">
 <li><a href="../order/order_list.html" class="orderListIcon">我的订单</a></li>
 <li><a href="<?php echo U('favorite/favorite');?>" class="collectionIcon">常购清单</a></li>
 <li><a href="profile.html" class="profileIcon">个人资料</a></li>
</ul>
<!--fixedNav:footer-->
<div style="height:1.2rem;"></div>
<nav>
 <a href="<?php echo U('Index/Index');?>" class="homeIcon">首页</a>
 <a href="<?php echo U('goods/category');?>" class="categoryIcon">分类</a>
 <a href="<?php echo U('cart/cart');?>" class="cartIcon">购物车</a>
 <a href="<?php echo U('usercenter/user');?>" class="userIcon">我的</a>
</nav>
<script>
  document.oncontextmenu=new Function("event.returnValue=false;");
  document.onselectstart=new Function("event.returnValue=false;"); 
</script>

</body>
</html>