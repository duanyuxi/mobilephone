<?php
/**
 * Created by PhpStorm.
 * User: danyuxi
 * Date: 17/10/19
 * Time: 上午11:16
 */
namespace Home\Controller;
use Think\Controller;
class GoodsController extends Controller
{
    //商品详情
    public function product(){
        //获取get方式提交的商品id
        $gid=$_GET['id'];
//        $gid=1;//默认goodsid为1
        $rew=M('goods')->query("select * from goods where id='$gid'");
//        if(empty($rew)){
//        exit('11');
//        }else{
//            exit('12');
//        }

        $this->assign('rew',$rew);
        $this->display();
    }


    //动态分类
    public function category(){

        //获取一级动态分类
        $firsttype=M('type')->query('select name,id from type where pid="0"');
//                var_dump($firsttype);
//        exit('11');
        //获取第一个一级分类下的二级分类
        $second=M('type')->query('select name,id from type where pid="1"');
        $this->assign('second',$second);
        $this->assign('firsttype',$firsttype);
        $this->display();
    }

    //处理ajax请求
    public function category_ajax(){
                //获取post传递来的ID
        $id=$_POST['id'];
        $rew=M('type')->query("select name,id from type where pid='$id'");
        $this->ajaxReturn($rew);
    }
//分类列表
    public function categorylist(){
//        $a=array(0,1,2,3,4,5,6,7,8,9);
//        $b=implode(array_rand($a,5));
//
//        var_dump( $b);
        if(isset($_GET['typepath'])){
            $id=$_GET['typepath'];//获取通过get方式传递的id

            $rew=M('goods')->query("select * from goods where typepath='$id' order BY id asc");
            $this->assign('rew',$rew);
            $this->assign('id',$id);
            $this->display();
        }else{
        if(isset($_GET['id'])){
        $id=$_GET['id'];//获取通过get方式传递的id
        $rew=M('goods')->query("select * from goods where typeid='$id' order BY id asc");
            $this->assign('rew',$rew);
            $this->assign('id',$id);
            $this->display();
        }else{//按价格销量升序，降序
            $id = $_POST['id'];
            $ob2=$_POST['active'];
            $ob1=$_POST['name'];
            $rew = M('goods')->query("select * from goods where typeid='$id' order BY $ob1 $ob2");
            $this->ajaxReturn($rew);
        }
    }
    }


    //购物车查询
    public function category_cart(){
        session_start();
        $uid=$_SESSION['uid'];
        $cart=M('cart')->query("select goodsnum from cart where uid=$uid");
        $num=0;
        foreach($cart as $v){
            $num=$num+$v['goodsnum'];
        }
        $this->ajaxReturn($num);
    }


//加入购物车判断是否登陆
    public function category_decide(){
            session_start();
        if(isset($_SESSION['uid'])){
            $this->ajaxReturn('1');
        }else{
            $this->ajaxReturn('0');
        }
    }

//点击添加购物车，加入购物车表
            public function category_addcart(){
                session_start();
                $uid=$_SESSION['uid'];
                $gid=$_POST['gid'];
                $arrnum=M('cart')->query("select goodsnum from cart where uid=$uid and gid='$gid'");

                if(empty($arrnum)){//判断购物车表是否存在该商品
                    $num=0;
                    $goodsnum=$num+1;
                    $creat_time=time();
                    $act=M('cart')->execute("insert into cart(uid,gid,goodsnum,creat_time) value($uid,$gid,$goodsnum,$creat_time)");
                    if($act){//判断是否添加成功
                        $this->ajaxReturn('1');
                    }else{
                        $this->ajaxReturn('0');
                    }
                }else{//存在商品则更新数量
                    $num=$arrnum['0']['goodsnum'];
                    $goodsnum=$num+1;
                    $act=M('cart')->execute("update cart set goodsnum=$goodsnum where gid=$gid and uid=$uid");
                    if($act){//判断是否添加成功
                        $this->ajaxReturn('1');
                    }else{
                        $this->ajaxReturn('0');
                    }
                }

            }

//搜索

        public function search(){
            $this->display();
        }

        public function search_view(){
            $gname=$_POST['goodsname'];
            $rew = M('goods')->query("select * from goods where goodsname like '%$gname%'");
            $this->assign('rew',$rew);
            $this->display();
        }




















}