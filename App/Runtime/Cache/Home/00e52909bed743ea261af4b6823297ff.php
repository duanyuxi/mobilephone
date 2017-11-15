<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>新鲜蔬菜</title>
<meta name="keywords"  content="KEYWORDS..." />
<meta name="description" content="DESCRIPTION..." />
<meta name="author" content="DeathGhost" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name='apple-touch-fullscreen' content='yes'>
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta name="format-detection" content="address=no">
<link rel="icon" href="/Public/images/icon/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon-precomposed" sizes="57x57" href=_P_UBLIC__./images/icon/apple-touch-icon-57x57-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="120x120" href=_P_UBLIC__./images/icon/apple-touch-icon-120x120-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="196x196" href=_P_UBLIC__./images/icon/apple-touch-icon-196x196-precomposed.png">
<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" type="text/css" href="/Public/css/style.css" />
<script src="/Public/js/jquery.js"></script>
<script src="/Public/js/swiper.min.js"></script>
<script>
$(document).ready(function(){
	var mySwiper = new Swiper('#slide',{
		  autoplay:5000,
		  visibilityFullFit : true,
		  loop:true,
		  pagination : '.pagination',
	  });
	//product list:Tab
	$(".tab_proList dd").eq(0).show().siblings(".tab_proList dd").hide();
	$(".tab_proList dt a").eq(0).addClass("currStyle");
	$(".tab_proList dt a").click(function(){
	var liindex = $(".tab_proList dt a").index(this);
	$(this).addClass("currStyle").siblings().removeClass("currStyle");
	$(".tab_proList dd").eq(liindex).fadeIn(150).siblings(".tab_proList dd").hide();
	});
   //飞入动画，具体根据实际情况调整
   $(".addToCart").click(function(){
	        $(".hoverCart a").html(parseInt($(".hoverCart a").html())+1);/*测试+1*/
            var shopOffset = $(".hoverCart").offset();
            var cloneDiv = $(this).parent().siblings(".goodsPic").clone();
            var proOffset = $(this).parent().siblings(".goodsPic").offset();
            cloneDiv.css({ "position": "absolute", "top": proOffset.top, "left": proOffset.left });
            $(this).parent().siblings(".goodsPic").parent().append(cloneDiv);
            cloneDiv.animate({
				width:0,
				height:0,
                left: shopOffset.left,
                top: shopOffset.top,
				opacity:1
            },"slow");
	   });
});
</script>
</head>
<body>
<!--header-->
<header>
 <h1 class="logoIcon" style="font-size:.85rem;">&#35;</h1>
 <a href="<?php echo U('goods/search');?>" class="rt_searchIcon">&#37;</a>
</header>
<div style="height:1rem;"></div>
<!--slide-->
<div id="slide">
  <div class="swiper-wrapper">
    <div class="swiper-slide">
     <a href="/Public">
      <img src="/Public/upload/slide001.jpg"/>
     </a>
    </div>
    <div class="swiper-slide">
     <a href="/Public">
      <img src="/Public/upload/slide002.jpg"/>
     </a>
    </div>
  </div>
  <div class="pagination"></div>  
</div>
<!--categoryList-->
<ul class="categoryLiIcon">
 <li>
  <a href="<?php echo U('goods/categorylist',array('typepath'=>1));?>">
   <img src="/Public/upload/menu_bg_01.png"/>
   <em>蔬菜水果</em>
  </a>
 </li>
 <li>
  <a href="<?php echo U('goods/categorylist',array('typepath'=>2));?>">
   <img src="/Public/upload/menu_bg_06.png"/>
   <em>禽蛋肉类</em>
  </a>
 </li>
 <li>
  <a href="<?php echo U('goods/categorylist',array('typepath'=>3));?>">
   <img src="/Public/upload/menu_bg_10.png"/>
   <em>水产火锅</em>
  </a>
 </li>
 <li>
  <a href="<?php echo U('goods/categorylist',array('typepath'=>4));?>">
   <img src="/Public/upload/menu_bg_14.png"/>
   <em>熟食豆制</em>
  </a>
 </li>
 <li>
  <a href="<?php echo U('goods/categorylist',array('typepath'=>5));?>">
   <img src="/Public/upload/menu_bg_03.png"/>
   <em>米面粮油</em>
  </a>
 </li>
 <li>
  <a href="<?php echo U('goods/categorylist',array('typepath'=>6));?>">
   <img src="/Public/upload/menu_bg_07.png"/>
   <em>调料干货</em>
  </a>
 </li>
 <li>
  <a href="<?php echo U('goods/categorylist',array('typepath'=>7));?>">
   <img src="/Public/upload/menu_bg_11.png"/>
   <em>餐厨用品</em>
  </a>
 </li>
 <li>
  <a href="/Public/category.html">
   <img src="/Public/upload/menu_bg_15.png"/>
   <em>常购品</em>
  </a>
 </li>
</ul>
<!--Tab:productList-->
<dl class="tab_proList">
 <dt>
  <a>热销</a>
  <a>新品</a>
  <a>打折</a>
 </dt>
 <dd>
  <ul>
   <li>
    <a href="<?php echo U('goods/product',array('id'=>2));?>" class="goodsPic">
     <img src="/Public/upload/goods001.jpg"/>
    </a>
    <div class="goodsInfor">
     <h2>
      <a href="<?php echo U('goods/product',array('id'=>2));?>">新鲜生菜两斤装特惠</a>
     </h2>
     <p>
      <del>5.90</del>
     </p>
     <p>
      <strong class="price">3.90</strong>
     </p>
     <a class="addToCart" tid="2">&#126;</a>
    </div>
   </li>
   <li>
    <a href="<?php echo U('goods/product',array('id'=>3));?>" class="goodsPic">
     <img src="/Public/upload/goods002.jpg"/>
    </a>
    <div class="goodsInfor">
     <h2>
      <a href="<?php echo U('goods/product',array('id'=>3));?>">红萝卜3斤装</a>
     </h2>
     <p>
      <del>12.90</del>
     </p>
     <p>
      <strong class="price">8.90</strong>
     </p>
     <a class="addToCart" tid="3">&#126;</a>
    </div>
   </li>
   <li>
    <a href="<?php echo U('goods/product',array('id'=>4));?>" class="goodsPic">
     <img src="/Public/upload/goods003.jpg"/>
    </a>
    <div class="goodsInfor">
     <h2>
      <a href="<?php echo U('goods/product',array('id'=>4));?>">西红柿5斤装</a>
     </h2>
     <p>
      <del>9.90</del>
     </p>
     <p>
      <strong class="price">6.90</strong>
     </p>
     <a class="addToCart" tid="4">&#126;</a>
    </div>
   </li>
  </ul>
 </dd>
 <dd>
  <ul>
   <li>
    <a href="<?php echo U('goods/product',array('id'=>11));?>" class="goodsPic">
     <img src="/Public/upload/goods004.jpg"/>
    </a>
    <div class="goodsInfor">
     <h2>
      <a href="<?php echo U('goods/product',array('id'=>11));?>">新鲜土豆两斤装特惠</a>
     </h2>
     <p>
      <del>7.50</del>
     </p>
     <p>
      <strong class="price">5.40</strong>
     </p>
     <a class="addToCart" tid="11">&#126;</a>
    </div>
   </li>
   <li>
    <a href="<?php echo U('goods/product',array('id'=>10));?>" class="goodsPic">
     <img src="/Public/upload/goods008.jpg"/>
    </a>
    <div class="goodsInfor">
     <h2>
      <a href="<?php echo U('goods/product',array('id'=>10));?>">新鲜螃蟹两斤装特惠</a>
     </h2>
     <p>
      <del>156.00</del>
     </p>
     <p>
      <strong class="price">120.00</strong>
     </p>
     <a class="addToCart" tid="10">&#126;</a>
    </div>
   </li>
   <li>
    <a href="<?php echo U('goods/product',array('id'=>8));?>" class="goodsPic">
     <img src="/Public/upload/goods009.jpg"/>
    </a>
    <div class="goodsInfor">
     <h2>
      <a href="<?php echo U('goods/product',array('id'=>8));?>">豆腐干两千克装</a>
     </h2>
     <p>
      <del>67.00</del>
     </p>
     <p>
      <strong class="price">15.00</strong>
     </p>
     <a class="addToCart" tid="8">&#126;</a>
    </div>
   </li>
  </ul>
  </dd>
 <dd>
  <ul>
   <li>
    <a href="<?php echo U('goods/product',array('id'=>13));?>" class="goodsPic">
     <img src="/Public/upload/goods005.jpg"/>
    </a>
    <div class="goodsInfor">
     <h2>
      <a href="<?php echo U('goods/product',array('id'=>13));?>">新鲜生菜两斤装特惠</a>
     </h2>
     <p>
      <del>34.00</del>
     </p>
     <p>
      <strong class="price">12.00</strong>
     </p>
     <a class="addToCart" tid="13">&#126;</a>
    </div>
   </li>
   <li>
    <a href="<?php echo U('goods/product',array('id'=>12));?>" class="goodsPic">
     <img src="/Public/upload/goods006.jpg"/>
    </a>
    <div class="goodsInfor">
     <h2>
      <a href="<?php echo U('goods/product',array('id'=>12));?>">新鲜白条鸡四斤装特惠</a>
     </h2>
     <p>
      <del>34.00</del>
     </p>
     <p>
      <strong class="price">20.00</strong>
     </p>
     <a class="addToCart" tid="12">&#126;</a>
    </div>
   </li>
   <li>
    <a href="<?php echo U('goods/product',array('id'=>9));?>" class="goodsPic">
     <img src="/Public/upload/goods007.jpg"/>
    </a>
    <div class="goodsInfor">
     <h2>
      <a href="<?php echo U('goods/product',array('id'=>9));?>">优质牛肉特价</a>
     </h2>
     <p>
      <del>134.00</del>
     </p>
     <p>
      <strong class="price">54.00</strong>
     </p>
     <a class="addToCart" tid="9">&#126;</a>
    </div>
   </li>
  </ul>
 </dd>
</dl>
<!--floatCart-->
<div class="hoverCart">
 <a href="<?php echo U('cart/cart');?>">0</a>
</div>
<div style="height:1.2rem;"></div>
<nav>
 <a href="<?php echo U('index/index');?>" class="homeIcon">首页</a>
 <a href="<?php echo U('goods/category');?>" class="categoryIcon">分类</a>
 <a href="<?php echo U('cart/cart');?>" class="cartIcon">购物车</a>
 <a href="<?php echo U('usercenter/user');?>" class="userIcon">我的</a>
</nav>
<script>
  document.oncontextmenu=new Function("event.returnValue=false;");
  document.onselectstart=new Function("event.returnValue=false;"); 
</script>

<script>

    $(".drop_icon").click(function(){
        $(".drop_list").toggle(600);
        $(".drop_list li a").click(function(){
            $(this).parents(".drop_list").hide();
        });
    });

    //飞入动画，具体根据实际情况调整
        $(".addToCart").click(function(){
            var obj=$(this);
            var id=obj.attr('tid');
        $.ajax({
            url:"<?php echo U('goods/category_addcart');?>",
            type:"post",
            data:{gid:id},
            datatype:"text",
            success:function(act){
                if(act==0){
                    $(".hoverCart a").html(parseInt($(".hoverCart a").html())-1);
                }
            }
        })
//        $(".hoverCart a").html(parseInt($(".hoverCart a").html())+1);
//        var shopOffset = $(".hoverCart").offset();
//        var cloneDiv = $(obj).parent().siblings(".goodsPic").clone();
//        var proOffset = $(obj).parent().siblings(".goodsPic").offset();
//        cloneDiv.css({ "position": "absolute", "top": proOffset.top, "left": proOffset.left });
//
//        $(".addToCart").parent().siblings(".goodsPic").parent().append(cloneDiv);
//        cloneDiv.animate({
//            width:0,
//            height:0,
//            left: shopOffset.left,
//            top: shopOffset.top,
//            opacity:1
//        },"slow");
    });

    //判断登陆及购物车情况(只执行一次)
    $(".addToCart").one('click',function(){
        var id=$(this).attr('vv');
        $.ajax({
            url:"<?php echo U('goods/category_decide');?>",
            type:"post",
            data:{id:0},
            datatype:"text",
            success:function(active){
                if(active=='1'){
                    $.ajax({
                        url:"<?php echo U('goods/category_cart');?>",
                        type:"post",
                        data:{id:0},
                        datatype:"text",
                        success:function(num){
                            $(".hoverCart a").html(num);
//                            $.ajax({
//                                url:"<?php echo U('goods/category_addcart');?>",
//                                type:"post",
//                                data:{gid:id},
//                                datatype:"text",
//                                success:function(act){
//                                    alert(act);
//                                }
//                            })
                        }
                    })
                }else{
                    window.location.href="<?php echo U('login/login');?>";
                }
            }
        })
    })
</script>

</body>
</html>