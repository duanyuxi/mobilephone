<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>分类</title>
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
 <script src="/Public/js/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/css/style.css" />
</head>
<body style="background:white;">
<!--header-->
<header>
 <a href="javascript:history.go(-1);" class="iconfont backIcon">&#60;</a>
 <h1>动态分类名称</h1>
 <a href="<?php echo U('goods/search');?>" class="rt_searchIcon">&#37;</a>
</header>
<div style="height:1rem;"></div>
<!--category list-->
<!--模板不变，异步处理，链接传参数，静态写过于累赘-->
<aside class="class_tree">
 <ul>
  <?php if(is_array($firsttype)): $key = 0; $__LIST__ = $firsttype;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key; if(($key) == "1"): ?><li class="current_style"><?php else: ?><li><?php endif; ?>

    <a onclick="active(this,<?php echo ($vo['id']); ?>)">
     <img src="/Public/upload/menu_bg_01.png"/>
     <strong><?php echo ($vo['name']); ?></strong>
    </a>
   </li><?php endforeach; endif; else: echo "" ;endif; ?>
  <li>
   <a>
    <img src="/Public/upload/menu_bg_15.png"/>
    <strong>常购品</strong>
   </a>
  </li>
 </ul>
</aside>
<!--category content-->
<ul class="category_cont">
 <?php if(is_array($second)): $i = 0; $__LIST__ = $second;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vovo): $mod = ($i % 2 );++$i;?><li>
   <a href="<?php echo U('goods/categorylist',array('id'=>$vovo['id']));?>"><?php echo ($vovo['name']); ?></a>
  </li><?php endforeach; endif; else: echo "" ;endif; ?>

</ul>
<div style="height:1.2rem;"></div>
<nav>
 <a href="../index/index.html" class="homeIcon">首页</a>
 <a href="category.html" class="categoryIcon">分类</a>
 <a href="../cart/cart.html" class="cartIcon">购物车</a>
 <a href="../usercenter/user.html" class="userIcon">我的</a>
</nav>
<script>
  document.oncontextmenu=new Function("event.returnValue=false;");
  document.onselectstart=new Function("event.returnValue=false;"); 
</script>
<script>
     function active(obj,id){
         $.ajax({
             url:"<?php echo U('goods/category_ajax');?>",
             type:"post",
             data:{id:id},
             datatype:'json',
             success:function(data){
                 var rew=data;
                 $('.category_cont').html('');
                 $(obj).parents('ul').children('li').removeAttr('class');
                 $(obj).parent().attr('class','current_style');
                 var drup=$.each(rew,function(k,v){
//                     alert(v.id);
                     $('.category_cont').append("<li><a href=\"/index.php/Home/goods/categorylist/id/"+v.id+".html\">"+v.name+"</a></li>");
                     }
                 );
             }
             })
     }
</script>
</body>
</html>