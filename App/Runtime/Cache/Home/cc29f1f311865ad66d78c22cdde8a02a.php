<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>常购清单</title>
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
<body style="background:white;">
<!--header-->
<header>
 <a href="javascript:history.go(-1);" class="iconfont backIcon">&#60;</a>
 <h1>常购清单</h1>
 <a href="search.html" class="rt_searchIcon">&#63;</a>
</header>
<div style="height:1rem;"></div>
<!--productList-->
<section class="productList">
  <ul>
   <?php if(is_array($rew)): $i = 0; $__LIST__ = $rew;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
    <a href="<?php echo U('goods/product',array('id'=>$vo['id']));?>" class="goodsPic" >
     <img src="/Public/upload/<?php echo ($vo['picname']); ?>"/>
    </a>
    <div class="goodsInfor">
     <h2>
      <a href="<?php echo U('goods/product',array('id'=>$vo['id']));?>"><?php echo ($vo['goodsname']); ?></a>
     </h2>
     <p>
      <del><?php echo ($vo['oldprice']); ?></del>
     </p>
     <p>
      <strong class="price"><?php echo ($vo['price']); ?></strong>
     </p>
     <a class="addToCart" onclick="add(this,<?php echo ($vo['id']); ?>)" vv="<?php echo ($vo['id']); ?>">&#126;</a>
     <a class="delete"  vv="<?php echo ($vo['id']); ?>">删除</a>
    </div>
   </li><?php endforeach; endif; else: echo "" ;endif; ?>
  </ul>
  <a class="more_btn">加载更多</a>
</section>
<!--floatCart-->
<div class="hoverCart">
 <a href="<?php echo U('cart/cart');?>">0</a>
</div>
</body>
</html>
<script>
$(".delete").click(function(){
    var dav=$(this);
    var gid=dav.attr('vv');
    $.ajax({
        "url":"<?php echo U('favorite/favorite_delete');?>",
        "data":{"gid":gid},
        "type":"post",
        "success":function(){
            dav.parents('li').remove();
        }
    })
})




        $(".drop_icon").click(function(){
            $(".drop_list").toggle(600);
            $(".drop_list li a").click(function(){
                $(this).parents(".drop_list").hide();
            });
        });

        //飞入动画，具体根据实际情况调整
        function add(obj,id){


            var shopOffset = $(".hoverCart").offset();
            var cloneDiv = $(obj).parent().siblings(".goodsPic").clone();
            var proOffset = $(obj).parent().siblings(".goodsPic").offset();
            cloneDiv.css({ "position": "absolute", "top": proOffset.top, "left": proOffset.left });

            $(obj).parent().siblings(".goodsPic").parent().append(cloneDiv);
            cloneDiv.animate({
                width:0,
                height:0,
                left: shopOffset.left,
                top: shopOffset.top,
                opacity:1
            },"slow");

            $.ajax({
                url:"<?php echo U('goods/category_addcart');?>",
                type:"post",
                data:{gid:id},
                datatype:"text",
                success:function(act){
                    if(act==0){
                        $(".hoverCart a").html(parseInt($(".hoverCart a").html())-1);
                    }
                    $(".hoverCart a").html(parseInt($(".hoverCart a").html())+1);
                }
            })


        };

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