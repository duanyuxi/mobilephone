<?php
/**
 * Created by PhpStorm.
 * User: danyuxi
 * Date: 17/10/19
 * Time: 下午1:49
 */
namespace Home\Controller;
use Think\Controller;
class OrderController extends Controller
{
    //个人中心订单列表
    public function order_list(){
            session_start();

            $uid=$_SESSION['uid'];
            $act=$_GET['state'];
            if(empty($act)||$act==1) {
                $state=1;

            }elseif($act=='2'){
                $state=2;

            }elseif($act=='3'){
                $state=3;

            }
                $o_list=M('orders')->query("select * from orders where uid=$uid and state=$state");
                foreach($o_list as $k=>$v){
                    $oid=$v['oid'];
                    $d_list=M('details')->query("select * from details where orderid=$oid");
                    $o_list["$k"]['children']=$d_list;
                }

                $this->assign('mark',$state);
                $this->assign('rew',$o_list);
                $this->display();
//                exit;
//        }elseif($act=='2'){
//                $state=2;
//            }elseif($act=='3'){
//                $state=3;
//            }elseif ($act=='1'){
//                $state=1;
//            }
//        $o_list=M('orders')->query("select * from orders where uid=$uid and state=$state");
//        foreach($o_list as $k=>$v){
//            $oid=$v['oid'];
//            $d_list=M('details')->query("select * from details where orderid=$oid");
//            $o_list["$k"]['asd']=$d_list;
//        }
//
//        var_dump($o_list);
//        $this->ajaxReturn($o_list);


    }



    //确认订单提交
    public function confirm_order(){
        session_start();
        $uid=$_SESSION['uid'];
        $gid=$_POST['arrgid'];//arrgid数组
        $strgid=implode(",",$gid);//strgid字符串

//       var_dump($strgid);
//        exit;
        //获取实时订单总价
        $total=0;
        foreach($gid as $v){
            $rew=M('goods')->query("select goods.price,cart.goodsnum from goods join cart on cart.gid=goods.id where goods.id=$v");
            $rew_c=M('cart')->query("select goodsnum from cart where uid=$uid and gid=$v");
            $total=$total+$rew['0']['price']*$rew_c['0']['goodsnum'];
        }

        //获取地址信息
        $address=M('address')->query("select * from address where uid=$uid");
        $this->assign('address',$address['0']);
        $this->assign('total',$total);
        $this->assign('strgid',$strgid);
        $this->display();
    }


    //支付完成
    public function return_state(){
            session_start();
            $uid=$_SESSION['uid'];//uid
            $strgid=$_POST['strgid'];//str-gid
            $remark=$_POST['remark'];//留言
            $arrgid=explode(",",$strgid);//数组化gid

        $address_data=M('address')->query("select * from address where uid=$uid");//address结果集
        $linkman=$address_data['0']['linkman'];//联系人
        $address="河南省郑州市".$address_data['0']['city'].$address_data['0']['treet'].$address_data['0']['restaurant_name'];//地址
        $phone=$address_data['0']['phone'];//电话
        $time=time();//创建时间
        $oid=$time.mt_rand(1,100000);//订单号
        $total=0;//价格
        //遍历gid数组
            foreach($arrgid as $v){
//                var_dump($v);
//                exit;
                $goods_data=M('goods')->query("select * from goods where id=$v");//goods结果句
                $cart_data=M('cart')->query("select * from cart where gid=$v");//购物车结果集
                $goodsname=$goods_data['0']['goodsname'];//商品名
                $price=$goods_data['0']['price'];//商品价格
                $num=$cart_data['0']['goodsnum'];//商品数量
//                var_dump($price);
//                var_dump($num);
                $total=$total+$price*$num;
                $act_d=M('details')->execute("insert into details(orderid,goodsname,goodsid,price,num) values($oid,'$goodsname',$v,$price,$num)");//添加订单详情表
                $new_store=$goods_data['0']['store']-$v;//新的商品库存
                $new_buynum=$goods_data['0']['buynum']+$v;//新的商品购买数量
                $act_g[]=M('goods')->execute("update goods set store=$new_store,buynum=$new_buynum");//更新商品库存和数量
                $act_c[]=M('cart')->execute("delete from cart where gid=$v and uid=$uid");//删除购物车中的商品
            }

            $act_o=M('orders')->execute("insert into orders(oid,state,uid,linkman,address,phone,creat_time,remark,total) values($oid,1,$uid,'$linkman','$address',$phone,$time,'$remark',$total)");//添加订单表
        $date=date('Y-m-d H:i:s',$time);
        $this->assign("total",$total);
        $this->assign("oid",$oid);
        $this->assign("date",$date);
        $this->display();

    }

    //修改地址
    public function address(){
        $this->display();
    }


    //
    public function addresslist(){
        $this->display();
    }



    public function payok(){
        session_start();
        $uid=$_SESSION['uid'];
        $o_id=$_POST['o_id'];
        $act=M('orders')->execute("update orders set state=3 where id=$o_id");
        if($act){
            $this->ajaxReturn('1');
        }else{
            $this->ajaxReturn('2');
        }
    }







}
