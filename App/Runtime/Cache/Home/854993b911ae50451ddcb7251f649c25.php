<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>订单列表</title>
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
 <h1>订单列表</h1>
</header>
<div style="height:1rem;"></div>
<script>
 $(document).ready(function(){
      $(".currStyle").removeAttr('class');
      var num=parseInt($(".orderSift").attr('state'))-1;
      $(".orderSift").children('a').eq(num).attr('class','currStyle');
      if(num==0){
          $('.order_delBtn').hide();
          $('.order_payBtn').css('background-color','green');
      }
      if(num==1){
         $('.order_delBtn').hide();
         $('.order_payBtn').text('确认收获');
     }
     if (num==2){
         $('.order_payBtn').css('background-color','green');
         $('.order_payBtn').text('已完成');
     }

 });

 $(".order_payBtn").click(function(){
     var obj=$(this);
     alert('a');
     var num=parseInt($(".orderSift").attr('state'))-1;
     if(num==1){
         var data=obj.attr('o_id');
         $.ajax({
             "url":"<?php echo U('order/payok');?>",
             "type":"post",
             "data":{"o_id":data},
             success:function(rew){
                 if(rew=='1'){
                 obj.parents('li').remove();
                 }else{
                     alert('确认收获失败');
                 }
             }
         })
     }
 })
</script>
<!--异步处理，此处不做TAB形式,注意当前状态样式currStyle-->
<aside class="orderSift" state="<?php echo ($mark); ?>">
 <a class="currStyle" state="1" href="<?php echo U('order/order_list',array('state'=>1));?>">待发货</a>
 <a state="2" href="<?php echo U('order/order_list',array('state'=>2));?>">待收货</a>
 <a state="3" href="<?php echo U('order/order_list',array('state'=>3));?>">已完成</a>
</aside>
<!--订单列表-->
<ul class="orderList">
 <!--订单循环li-->
 <?php if(is_array($rew)): $i = 0; $__LIST__ = $rew;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li>
  <dl>
   <dt>
    <span>订单：<?php echo ($v['oid']); ?></span>
    <span>待付款</span>
   </dt>
   <!--订单产品循环dd-->
   <?php if(is_array($v['children'])): $i = 0; $__LIST__ = $v['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><dd>
    <h2><?php echo ($vv['goodsname']); ?></h2>
    <strong>
     <em><?php echo ($vv['price']); ?></em>
     <span><?php echo ($vv['num']); ?></span>
    </strong>
   </dd><?php endforeach; endif; else: echo "" ;endif; ?>
   <dd>
    <!--<span>商品数量：<b>2</b></span>-->
    <span>实付：<b><?php echo ($v['total']); ?></b></span>
   </dd>
   <dd>
    <a class="order_delBtn">删除订单</a>
    <a class="order_payBtn" o_id="<?php echo ($v['id']); ?>">已付款</a>
   </dd>
  </dl>
 </li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
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
<script>
//    <!--function ajax_run(url,data,function_run){   -->
//      $.ajax({
//          "url":url,
//          "data":data,
//          "type":"post",
//          "datatype":"json",
//          "success":function_run
//      })
//  }
//
////  $(document).ready(function(){
//////      $(".orderSift").children().click(function(){
//////          $(".currStyle").removeAttr('class');
//////          var state=$(this).attr('state');
//////          window.location.href="<?php echo U('order/order_list');?>/state/"+state;
//////          $(this).attr('class','currStyle');
////
//////          var state=$(".currStyle").attr("state");
//////          var url="<?php echo U('order/order_list');?>";
//////          var data={"state":state};
//////          var fuc=function(data){
//////
//////              $(".orderList").html('');
//////              $.each(data,function(k,v){
//////                  var db='';
//////                  $.each(v.asd,function(kk,vv){
//////                      db=db+"<dd><h2>"+vv.goodsname+"</h2><strong><em>"+vv.price+"</em><span>"+vv.num+"</span></strong></dd>";
//////                  });
//////                  console.dirxml(db);
//////                  $(".orderList").append("<li><dl><dt><span>订单："+v.oid+"</span><span>待付款</span></dt>"+db+"<dd><span>实付：<b>v.total</b></span></dd><dd><a class=\"order_delBtn\">删除订单</a><a class=\"order_payBtn\">已付款</a></dd></dl></li>");
//////              })
//////          };
//////          ajax_run(url,data,fuc);
////      })
//
//
//
//
////  })
</script>