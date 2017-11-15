<?php
/**
 * Created by PhpStorm.
 * User: danyuxi
 * Date: 17/10/19
 * Time: 下午3:17
 */
namespace Home\Controller;
use Think\Controller;
class CartController extends Controller
{
    public function cart(){
        session_start();
        $uid=$_SESSION['uid'];
        if(!empty($uid)){
            $rew=M('cart')->query("select cart.gid,cart.id,cart.goodsnum,goods.picname,goods.goodsname,goods.price,goods.oldprice from cart join goods on cart.gid=goods.id where cart.uid=$uid");

            $this->assign('rew',$rew);
            $this->display();
        }else{
            echo "<script>alert('请登录');</script>";
            $this->redirect('login/login');
        }

    }

//ajax加方法
        public function cart_increment(){
            session_start();
            $uid=$_SESSION['uid'];
            $gid=$_POST['gid'];
            $oldnum=M('cart')->query("select goodsnum from cart where uid=$uid and gid=$gid");
            $newnum=$oldnum['0']['goodsnum']+1;
            $a=M('cart')->execute("update cart set goodsnum=$newnum where uid=$uid and gid=$gid");
            if($a){
                $this->ajaxReturn('1');
            }else{
                $this->ajaxReturn('0');
            }
        }

//ajax减方法
    public function cart_decrement(){
        session_start();
        $uid=$_SESSION['uid'];
        $gid=$_POST['gid'];
        $oldnum=M('cart')->query("select goodsnum from cart where uid=$uid and gid=$gid");
        $newnum=$oldnum['0']['goodsnum']-1;
        $a=M('cart')->execute("update cart set goodsnum=$newnum where uid=$uid and gid=$gid");
        if($a){
            $this->ajaxReturn('1');
        }else{
            $this->ajaxReturn('0');
        }
    }


    //ajax删除
    public function cart_delete(){
        session_start();
        $uid=$_SESSION['uid'];
        $gid=$_POST['gid'];
        M('cart')->execute("delete from cart where uid=$uid and gid=$gid");
    }














}