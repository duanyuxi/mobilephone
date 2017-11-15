<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>产品详情</title>
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
    $.ajax({
        url:"<?php echo U('goods/category_decide');?>",
        datatype:"text",
        success:function(rew){
            if(rew==1){
                $.ajax({
                    url:"<?php echo U('goods/category_cart');?>",
                    datatype:"text",
                    success:function(rew){
                        $(".topCart em").html(rew);
                    }
                })
            }else{
                window.location.href="<?php echo U('login/login');?>";
            }
        }
    })

  //效果测试，程序对接可将其删除
  $(".btmNav a:first").click(function(){
      $(".topCart em").html(parseInt($(".topCart em").html())+1);
	  });
});
</script>
</head>
<body>
<!--header-->
<header>
 <a href="javascript:history.go(-1);" class="iconfont backIcon">&#60;</a>
 <h1>产品详情</h1>
 <a href="<?php echo U('cart/cart');?>" class="topCart"><em>0</em></a>
</header>
<div style="height:1rem;"></div>
<div class="pro_bigImg">
 <img src="/Public/upload/<?php echo ($rew['0']['picname']); ?>"/>
</div>
<!--base information-->
<section class="pro_baseInfor">
 <h2><?php echo ($rew['0']['goodsname']); ?></h2>
 <p>
  <strong><?php echo ($rew['0']['price']); ?></strong>
  <del>49.80</del>
 </p>
</section>
<!--product attr-->
<dl class="pro_attr">
 <dt>产品属性信息</dt>
 <dd>
  <ul>
   <li>
    <span>上市时间</span>
    <em><?php echo ($rew['0']['goshop']); ?></em>
   </li>
   <li>
    <span>产品规格</span>
    <em><?php echo ($rew['0']['product']); ?></em>
   </li>
   <li>
    <span>产品重量</span>
    <em><?php echo ($rew['0']['weight']); ?>kg</em>
   </li>
   <li>
    <span>包装方式<?php echo ($rew['0']['package']); ?></span>
    <em><?php if(($rew['0']['package']) == "1"): ?>盒装<?php else: ?>散装<?php endif; ?></em>
   </li>
   <li>
    <span>保质期</span>
    <em><?php echo ($rew['0']['expiration_date']); ?></em>
   </li>
   <li>
    <span>所属品牌</span>
    <em><?php echo ($rew['0']['brand']); ?></em>
   </li>
  </ul>
 </dd>
</dl>
<!--bottom nav-->
<div style="height:1rem;"></div>
<aside class="btmNav">
 <a style="background:#64ab5b;color:white;text-shadow:none;">加入购物车</a>
 <a style="background:#87a983;color:white;text-shadow:none;" href="javascript:void(0);" class="favorite" gid="<?php echo ($rew['0']['id']); ?>">加入常购单</a>
</aside>
</body>
</html>
<script>
     $('.favorite').click(function(){
         var gid=$(this).attr('gid');
         $.ajax({
             "url":"/index.php/Home/favorite/favorite_add",
             "type":"post",
             "data":{"gid":gid},
             "success":function(){
                 alert('添加成功');
             }
         })
     })

    $(".btmNav a").first().click(function(){
        $.ajax({
            url:"<?php echo U('goods/category_decide');?>",
            datatype:"text",
            success:function(rew){
                if(rew==1){
                    $.ajax({
                        url:"<?php echo U('goods/category_addcart');?>",
                        data:{"gid":$rew['0']['id']},
                        type:"post",
                        success:function(){
                            alert('已添加购物车');
                        }
                    })
                }else{
                    window.location.href="<?php echo U('login/login');?>";
                }
            }
        })

    })
</script>