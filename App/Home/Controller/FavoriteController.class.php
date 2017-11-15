<?php
/**
 * Created by PhpStorm.
 * User: danyuxi
 * Date: 17/10/21
 * Time: 上午10:06
 */
namespace Home\Controller;
use Think\Controller;
class FavoriteController extends Controller
{
    public function favorite(){
        session_start();
        $uid=$_SESSION['uid'];
        $f_data=M('favorite')->query("select gid from favorite where uid=$uid order by create_time desc");
//        var_dump($f_data);exit;
        foreach($f_data as $v){
        $list=M('goods')->query("select * from goods where id={$v['gid']}");
        $rew[]=$list['0'];
    }

        $this->assign('rew',$rew);
        $this->display();
    }

    //ajax
    public function favorite_add(){
        session_start();
        $uid=$_SESSION['uid'];
        $gid=$_POST['gid'];
        $time=time();
        $act=M('favorite')->query("select count(*),id from favorite where gid=$gid and uid=$uid");

        if($act['0']['count(*)']){
         M('favorite')->execute("update favorite set create_time=$time where id={$act['0']['id']}");
        }else{
        M('favorite')->execute("insert into favorite(gid,uid,create_time) value($gid,$uid,$time)");
    }

    }



    public function favorite_delete(){
        session_start();
        $uid=$_SESSION['uid'];
        $gid=$_POST['gid'];
        $act=M('favorite')->execute("delete from favorite where uid=$uid and gid=$gid");
        var_dump($act);
        var_dump($gid);
    }





















}