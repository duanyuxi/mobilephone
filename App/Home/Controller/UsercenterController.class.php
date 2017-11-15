<?php
/**
 * Created by PhpStorm.
 * User: danyuxi
 * Date: 17/10/19
 * Time: 上午11:47
 */
namespace Home\Controller;
use Think\Controller;
class UsercenterController extends controller
{
    //个人中心
    public function user(){

        session_start();
        $uid=$_SESSION['uid'];

        if(!empty($uid)){//判断session uid 是否为空

            $this->display();
        }else{
            echo "<script>alert('请登录') </script>";
            $this->redirect('login/login');
        }



    }



    //个人信息
    public function profile(){
        session_start();
        $uid=$_SESSION['uid'];
        if(!empty($uid)){//判断session uid 是否为空
            $this->display();
        }else{
            echo "<script>alert('请登录') </script>";
            $this->redirect('login/login');
        }
    }


    //个人中心设置
    public function user_set(){
        session_start();
        $uid=$_SESSION['uid'];
        if(!empty($uid)){//判断session uid 是否为空
            $this->display();
        }else{
            echo "<script>alert('请登录') </script>";
            $this->redirect('login/login');
        }
    }

    public function login_out(){
        session_start();
        session_unset();
        $this->redirect('login/login');
    }


























}