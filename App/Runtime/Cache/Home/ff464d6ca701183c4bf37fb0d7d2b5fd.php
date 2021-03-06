<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>购物车</title>
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
  //show or hide:delBtn
  $(".edit").toggle(function(){
	  $(this).parent().siblings("dd").find(".delBtn").fadeIn();
	  $(this).html("完成");
	  $(".numberWidget").show();
	  $(".priceArea").hide();
	  },function(){
	  $(this).parent().siblings("dd").find(".delBtn").fadeOut();
	  $(this).html("编辑");
	  $(".numberWidget").hide();
	  $(".priceArea").show();
		  });

});
</script>
</head>
<body>
<!--header-->
<header>
 <a href="javascript:history.go(-1);" class="iconfont backIcon">&#60;</a>
 <h1>购物车</h1>
</header>
<div style="height:1rem;"></div>
<dl class="cart">
 <dt>
  <label><input type="checkbox" />全选</label>
  <a class="edit">编辑</a>
 </dt>
 <form action="<?php echo U('order/confirm_order');?>" class="form" method="post">
 </form>
<?php if(is_array($rew)): $i = 0; $__LIST__ = $rew;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dd>
  <input  type="checkbox" value="<?php echo ($vo['goodsnum']*$vo['price']); ?>" num="<?php echo ($vo['goodsnum']); ?>" price="<?php echo ($vo['price']); ?>" gid="<?php echo ($vo['gid']); ?>"/>
  <a href="<?php echo U('goods/product',array('id'=>$vo['gid']));?>" class="goodsPic"><img src="/Public/upload/<?php echo ($vo['picname']); ?>"/></a>
  <div class="goodsInfor">
   <h2>
    <a href="<?php echo U('goods/product',array('id'=>$vo['gid']));?>"><?php echo ($vo['goodsname']); ?></a>
    <span><?php echo ($vo['goodsnum']); ?></span>
   </h2>
   <div class="priceArea">
    <span hidden ><?php echo ($vo['goodsnum']*$vo['price']); ?></span>
    <strong><?php echo ($vo['price']); ?></strong>
    <del><?php echo ($vo['oldprice']); ?></del>
   </div>
   <div class="numberWidget">
    <input type="button" value="-" class="minus" />
    <input type="text" value="<?php echo ($vo['goodsnum']); ?>" disabled  class="number"/>
    <input type="button" value="+"  class="plus" />
   </div>
  </div>
  <a class="delBtn">删除</a>
 </dd><?php endforeach; endif; else: echo "" ;endif; ?>

</dl>
<!--bottom nav-->
<div style="height:1rem;"></div>
<aside class="btmNav">
  <span hidden></span>
 <a>合计：￥0.00</a>
 <a href="javascript:void(0)" style="background:#64ab5b;color:white;text-shadow:none;" class="fastfirm">立即下单</a>
</aside>
</body>
</html>
<script>
    var ab=0;
      //全选点击事件
      $('.cart dt label input').click(function(){
                if($(this).prop('checked')){/*判断是否为全选*/
                    $('input[type="checkbox"]').prop('checked',true);/*设置所有checked为true*/

                    $("input[type='checkbox']").each(function(k,v){/*遍历所有的checkbox*/
                    var aa=parseFloat($(v).attr('price'))*parseInt($(v).attr('num'));
                        if(!isNaN(aa)){/*去除所有NaN*/
                         window.ab=window.ab+aa;
                        }
                    })
                    $(".btmNav a").first().text("合计：￥"+window.ab);
                    $(".btmNav span").text(window.ab);
                }else{
                    $('input[type="checkbox"]').prop('checked',false);/*全不选*/
                    $(".btmNav a").first().text("合计：￥0.00");
                    $(".btmNav span").text('0');
                 }
                 window.ab=0;/*清空ab*/
      })
      //单选点击事件
    var ac=0;
      $('dd input[type="checkbox"]').click(function(){
               $('input[type="checkbox"]').each(function(k,v){/*遍历checkbox*/
                   if($(v).prop('checked')){/*筛选出所有checked为true的*/
                       if(!isNaN($(v).prop('value'))){/*筛选出合格的数据*/
                       window.ac=window.ac+0.01*Math.round(parseFloat($(v).prop('value'))*100);
                       }
                   }
               })
               $(".btmNav a").first().text("合计：￥"+(0.01*Math.round(window.ac*100)).toFixed(2));
               $(".btmNav span").text((0.01*Math.round(window.ac*100)).toFixed(2));
               window.ac=0;
      })
      /*加方法*/
        $(".plus").click(function(){
            var id=$(this).parents('dd').children('input').attr('gid');
            $.ajax({
                url:"<?php echo U('cart/cart_increment');?>",
                type:"post",
                data:{gid:id},
                datatype:"text"
            })
            var currNum=$(this).siblings(".number");
            currNum.val(parseInt(currNum.val())+1);
            var price=parseFloat($(this).parents('dd').children('input').attr('price'));
            var oldprice=parseFloat($(this).parents('dd').children('input').prop('value'));
            $(this).parents('dd').children('div').first().children('h2').children('span').text(parseInt($(this).parents('dd').children('input').attr('num'))+1);
            $(this).parents('dd').children('input').prop('value',0.01*Math.round((oldprice+price)*100));/*input的value值变化－－更新单条商品的总价，便于全选、单选获取实时信息*/
            $(this).parents('dd').children('input').attr('num',parseInt($(this).parents('dd').children('input').attr('num'))+1);/*input的num值变化*/
            if($(this).parents('dd').children('input').prop('checked')){/*判断是否被选中*/
                var total=parseFloat($(".btmNav span").text());
                $(".btmNav span").text(0.01*Math.round((total+price)*100));/*更新*/
                $(".btmNav a").first().text("合计：￥"+0.01*Math.round((total+price)*100));
            }

        })
      //减方法
    $(".minus").click(function(){
        var currNum=$(this).siblings(".number");
        if(currNum.val()==1){
            $(this).parents("dd").remove();
            nullTips();
        }else{

            var id=$(this).parents('dd').children('input').attr('gid');
            $.ajax({
                url:"<?php echo U('cart/cart_decrement');?>",
                type:"post",
                data:{gid:id},
                datatype:"text"
            })
            var currNum=$(this).siblings(".number");
            currNum.val(parseInt(currNum.val())-1);
            var price=parseFloat($(this).parents('dd').children('input').attr('price'));
            var oldprice=parseFloat($(this).parents('dd').children('input').prop('value'));
            $(this).parents('dd').children('div').first().children('h2').children('span').text(parseInt($(this).parents('dd').children('input').attr('num'))-1);
            $(this).parents('dd').children('input').prop('value',0.01*Math.round((oldprice-price)*100));/*input的value值变化－－更新单条商品的总价，便于全选、单选获取实时信息*/
            $(this).parents('dd').children('input').attr('num',parseInt($(this).parents('dd').children('input').attr('num'))-1);/*input的num值变化*/
            if($(this).parents('dd').children('input').prop('checked')){/*判断是否被选中*/
                var total=parseFloat($(".btmNav span").text());
                $(".btmNav span").text(0.01*Math.round((total-price)*100));/*更新*/
                $(".btmNav a").first().text("合计：￥"+0.01*Math.round((total-price)*100));
            }
        }
    });


    //删除
    $(".delBtn").click(function(){
        $(this).parent().remove();
        var id=$(this).parents('dd').children('input').attr('gid');
        $.ajax({
            url:"<?php echo U('cart/cart_delete');?>",
            type:"post",
            data:{gid:id}
        })
        nullTips();
    });
    //购物车为空
    function nullTips(){
        if($(".cart dd").length==0){
            var tipsCont="<mark style='display:block;background:none;text-align:center;color:grey;'>购物车为空！</mark>"
            $(".cart").remove();
            $("body").append(tipsCont);
        }
    }

    var ad=0;
    //点击提交事件
       $(".fastfirm").click(function(){
           if($('.cart dt label input').prop('checked')){/*如果全选被选中*/
               if($('dd input[type="checkbox"]').prop('checked')){/*如果单选被选中*/
               $("dd input[type='checkbox']").each(function(k,v){/*遍历集合*/
                   if($(v).prop('checked')){/*筛选出被选中的的集合*/
                       $(".form").append("<input name='arrgid[]' value='"+$(v).attr('gid')+"'>")
                   }
               })
                   $(".form").submit();
               }else{
                   alert('选定商品为空！');
               }
           }else{
                   $("dd input[type='checkbox']").each(function(k,v){/*遍历集合*/
                       if($(v).prop('checked')){/*筛选出被选中的的集合*/
                           $(".form").append("<input name='arrgid[]' value='"+$(v).attr('gid')+"'>")
                           window.ad++;
                       }
                   })
                   if(window.ad==0){
                       alert('选定商品为空！');
                   }else{
                   $(".form").submit();
               }
           }
       })
</script>