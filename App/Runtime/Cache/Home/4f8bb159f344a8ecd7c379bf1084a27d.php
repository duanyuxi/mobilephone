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
	  alert("密码修改成功！");
      $('.form').submit();
	  });	
});
</script>
</head>
<body>
<!--header-->
<header>
 <a href="javascript:history.go(-1);" class="iconfont backIcon">&#60;</a>
 <h1>修改密码</h1>
</header>
<div style="height:1rem;"></div>
<form class="form" method="post" action="<?php echo U('login/change_pwddata');?>">
<ul class="userForm">
 <li>
 <label class="formName">旧密码：</label>
 <input type="password" name="oldpassword" required placeholder="旧密码..."/>
 </li>
 <li>
 <label class="formName">新密码：</label>
 <input type="password" name="newpassword" required placeholder="新密码..."/>
 </li>
 <li>
 <label class="formName">确认新密码：</label>
 <input type="password" name="renewpassword" required placeholder="确认新密码..."/>
 </li>
 <li><input type="button" value="确认修改密码" class="formLastBtn"/></li>
</ul>
</form>
<div style="height:1.2rem;"></div>
<nav>
 <a href="../index/index.html" class="homeIcon">首页</a>
 <a href="../goods/category.html" class="categoryIcon">分类</a>
 <a href="../cart/cart.html" class="cartIcon">购物车</a>
 <a href="<?php echo U('usercenter/user');?>" class="userIcon">我的</a>
</nav>
<script>
  document.oncontextmenu=new Function("event.returnValue=false;");
  document.onselectstart=new Function("event.returnValue=false;"); 
</script>

</body>
</html>