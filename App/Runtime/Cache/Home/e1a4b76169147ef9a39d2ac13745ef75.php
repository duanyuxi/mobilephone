<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>修改</title>
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
 <h1>用户名称</h1>
</header>
<div style="height:1rem;"></div>
<form class="form" action="<?php echo U('login/change_namedata');?>" method="post">
<ul class="userForm">
 <li><input type="text" name="newname" value="" placeholder="设置用户名称"/></li>
 <li><input type="button" value="更新保存" class="formLastBtn"/></li>
</ul>
</form>
<script>
      $('.userForm li input[type="button"]').click(function(){
          alert('更新用户名称成功');
          $('form').submit();
      })
</script>
</body>
</html>