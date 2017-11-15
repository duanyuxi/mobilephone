<?php
/**
 * Created by PhpStorm.
 * User: danyuxi
 * Date: 17/10/19
 * Time: 下午3:58
 */
namespace Home\Controller;
use Think\Controller;
Vendor('GeeTest.GeetestLib');
class LoginController extends Controller
{

    //登陆页面
    public function login(){
        $this->display();
    }

//ajax控制器:
    public function StartServlet(){
        session_start();
        $GtSdk = new \GeetestLib(CAPTCHA_ID, PRIVATE_KEY);
        $data = array(
            "user_id" => "test", # 网站用户id
            "client_type" => "web", #web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
            "ip_address" => "172.0.0.1" # 请在此处传输用户请求验证时所携带的IP
        );
        $status = $GtSdk->pre_process($data, 1);//判断服务器是否宕机
        $_SESSION['gtserver'] = $status;
        $_SESSION['user_id'] = $data['user_id'];
        $_SESSION['ip_address']=$data['ip_address'];
        echo $GtSdk->get_response_str();//{"success":0,"gt":"48a6ebac4ebc6642d68c217fca33eb4d","challenge":"98f13708210194c475687be6106a3b8417","new_captcha":1}
    }
    //ajax控制器

    //注册页面
    public function register(){
        $this->display();
    }


    //获取注册信息并存入数据库
    public function registerdata()
    {
        session_start();
        header('Content-Type:text/html;charset=utf-8');
        //极验证的验证
//极验证开始第54步开始:（点击提交按钮去验证极验证码是否正确）
        $GtSdk = new \GeetestLib(CAPTCHA_ID, PRIVATE_KEY);
        $data = array(
            "user_id" => $_SESSION['user_id'], # 网站用户id
            "client_type" => "web", #web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
            "ip_address" => $_SESSION['ip_address'] # 请在此处传输用户请求验证时所携带的IP
        );
        if ($_SESSION['gtserver'] == 1) {   //服务器正常
            //下边一句话才是极验证的验证方法
            $result = $GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $data);
            //极验证开始第5步结束:（点击提交按钮去验证极验证码是否正确）
            if ($result) {
                $User=D('User');//实例化User模型
                $active=$User->create();//传输数据为post；若为get，则先获取数据，传入create方法中
                if(!$active){//表单验证成功
                    exit($User->getError());
                }else {
                    $a=$User->add();//添加数据并获取新增id
                    if($a){//user表添加成功
                        $Address=D('Address');//实例化Address模型
                        $as=$Address->create();
                        if(!$as){//表单验证成功
                            exit($Address->getError());
                        }else{//地址表添加成功
                            $add=$Address->add();
                            M('address')->execute("update address set uid=$a where id=$add");
                            $_SESSION['uid']=$a;
                            $this->redirect('Index/Index');//项目内跳转
                        }
                    }
                }
            } else{
                echo '1验证码错误';
                $this->redirect('login/register');
            }

        }else{  //服务器宕机,走failback模式
            if ($GtSdk->fail_validate($_POST['geetest_challenge'],$_POST['geetest_validate'],$_POST['geetest_seccode'])) {
                $User=D('User');//实例化User模型
                $active=$User->create();//传输数据为post；若为get，则先获取数据，传入create方法中
                if(!$active){//表单验证成功
                    exit($User->getError());
                }else {
                    $a=$User->add();//添加数据并获取新增id
                    if($a){//user表添加成功
                        $Address=D('Address');//实例化Address模型
                        $as=$Address->create();
                        if(!$as){//表单验证成功
                            exit($Address->getError());
                        }else{//地址表添加成功
                            $add=$Address->add();
                            M('address')->execute("update address set uid=$a where id=$add");
                            $_SESSION['uid']=$a;
                            $this->redirect('Index/Index');//项目内跳转
                        }
                    }
                }
            }else{
                echo '2验证码错误';
                $this->redirect('login/register');
            }
        }
    }


    public function VerifyServlet(){
        session_start();
        header('Content-Type:text/html;charset=utf-8');
            //极验证的验证
//极验证开始第54步开始:（点击提交按钮去验证极验证码是否正确）
            $GtSdk = new \GeetestLib(CAPTCHA_ID, PRIVATE_KEY);
            $data = array(
                "user_id" => $_SESSION['user_id'], # 网站用户id
                "client_type" => "web", #web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
                "ip_address" => $_SESSION['ip_address'] # 请在此处传输用户请求验证时所携带的IP
            );
            if ($_SESSION['gtserver'] == 1) {   //服务器正常
                //下边一句话才是极验证的验证方法
                $result = $GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $data);
                //极验证开始第5步结束:（点击提交按钮去验证极验证码是否正确）
                if ($result) {
                    $username=$_POST['username'];
                    $p=$_POST['password'];
                    $password=md5($p);
//        var_dump($password);
//        exit;
                    if(!empty($username)&&!empty($p)){//判断用户名和密码是否为空

                        $rew=M('user')->where("username='$username'")->field('password,id')->find();//从数据库获取密码
                        if($password==$rew['password']){//判断用户名和密码是否正确

                            $_SESSION['uid']=$rew['id'];
                            $this->redirect('Index/Index');
                        }else{
                            echo "<script>alert('用户名或密码错误')</script>";
                            $this->redirect('login/login');
                        }
                    }else{
                        echo "<script>alert('用户名或密码错误')</script>";
                        $this->redirect('login/login');
                    }

                } else{
                    echo '1验证码错误';
                    $this->redirect('login/login');
                }

            }else{  //服务器宕机,走failback模式
                if ($GtSdk->fail_validate($_POST['geetest_challenge'],$_POST['geetest_validate'],$_POST['geetest_seccode'])) {
                    $username=$_POST['username'];
                    $p=$_POST['password'];
                    $password=md5($p);
//        var_dump($password);
//        exit;
                    if(!empty($username)&&!empty($p)){//判断用户名和密码是否为空

                        $rew=M('user')->where("username='$username'")->field('password,id')->find();//从数据库获取密码
                        if($password==$rew['password']){//判断用户名和密码是否正确

                            $_SESSION['uid']=$rew['id'];
                            $this->redirect('Index/Index');
                        }else{
                            echo "<script>alert('用户名或密码错误')</script>";
                            $this->redirect('login/login');
                        }
                    }else{
                        echo "<script>alert('用户名或密码错误')</script>";
                        $this->redirect('login/login');
                    }

                }else{
                    echo '2验证码错误';
                }
            }
    }


//    function getVerify()
//    {
//        $url=U('Index/verify');
//        $str='<input name="verify" type="text" >';
//        $str.='<img src="'.$url.'" onclick="this.src=\''.$url.'\'">';
//
//        echo $str;
//    }
//    public function verify(){
//        $Verify = new \Think\Verify();
//        $Verify->entry();
//    }







    //找回密码
    public function fund_pwd(){

        $this->display();
    }






//修改密码
    public function change_pwd(){
        session_start();
        $uid=$_SESSION['uid'];
        if(!empty($uid)){//判断session uid 是否为空
            $this->display();
        }else{
            echo "<script>alert('请登录') </script>";
            $this->redirect('login/login');
        }
    }

    //修改密码判断
    public function change_pwddata()
    {
        session_start();
        $uid = $_SESSION['uid'];
        if (!empty($uid)) {//判断是否存在session['uid']
            $oldpassword = $_POST['oldpassword'];
            $newpassword = $_POST['newpassword'];
            $renewpassword = $_POST['renewpassword'];
            if (!empty($oldpassword)) {//判断密码是否为空
                if ($newpassword == $renewpassword && !empty($newpassword)) {//判断新密码是否正确且不为空
                    $length = strlen('$newpassword');
                    if ($length < 16 && $length > 8) {//判断密码长度
                        if(!($newpassword==$oldpassword)){// 判断新旧密码是否相同
                        $dpsw=M('user')->query("select password from user where id=$uid");
                        $psw=md5($oldpassword);//用户页面输入的用于判断是否为本人的旧密码
                        if($psw==$dpsw['0']['password']){//判断密码是否正确
                            $npsw=md5($newpassword);
                            $a=M('user')->execute("update user set password='$npsw' where id=$uid");
                            if ($a){
                                echo "<script>alert('修改成功')</script>";
                                $this->redirect('login/change_pwd');
                            }else{
                                echo "<script>alert('很抱歉，修改失败')</script>";
                                $this->redirect('login/change_pwd');
                            }
                        }else{
                            echo "<script>alert('密码错误')</script>";
                            $this->redirect('login/change_pwd');
                        }
                    }else{
                            echo "<script>alert('新密码和旧密码不能相同')</script>";
                            $this->redirect('login/change_pwd');
                        }
                    } else {
                        echo "<script>alert('密码长度为8-16位')</script>";
                        $this->redirect('login/change_pwd');
                    }
                } else {
                    echo "<script>alert('请检查密码输入是否有误')</script>";
                    $this->redirect('login/change_pwd');
                }
            } else {
                echo "<script>alert('密码不能为空')</script>";
                $this->redirect('login/change_pwd');
            }
        }else{
            echo "<script>alert('请先登陆')</script>";
            $this->redirect('login/login');
        }
    }




    //修改名称
    public function change_name(){
        session_start();
        $uid=$_SESSION['uid'];
        if(!empty($uid)){//判断session uid 是否为空
        $this->display();
            }else{
            echo "<script>alert('请登录') </script>";
            $this->redirect('login/login');
        }

    }

    //修改名称判定
    public function change_namedata(){
        session_start();
        $uid=$_SESSION['uid'];
        $newname=trim($_POST['newname']);//去除空格
        if(!empty($uid)){//判断session uid 是否为空
            if(!empty($newname)){//判断新用户名是否为空
                if(strlen('$newname')<12){
                    M('user')->execute("update user set username='$newname' where id=$uid");
                }else{
                    echo "<script>alert('用户名最大为11个字符') </script>";
                    $this->redirect('login/change_name');
                }
            }else{
                echo "<script>alert('新用户名不能为空') </script>";
                $this->redirect('login/change_name');
            }
        }else{
            echo "<script>alert('请登录') </script>";
            $this->redirect('login/login');
        }
}

    //修改联系电话
    public function change_tel(){
        session_start();
        $uid=$_SESSION['uid'];
        if(!empty($uid)){//判断session uid 是否为空
            $this->display();
        }else{
            echo "<script>alert('请登录') </script>";
            $this->redirect('login/login');
        }
    }



    //修改电话判定
    public function change_teldata(){
        session_start();
        $uid=$_SESSION['uid'];
        $newmobilephone=(int)trim($_POST['newmobilephone']);//去除空格
        if(!empty($uid)){//判断session uid 是否为空
            if(!empty($newmobilephone)){//判断新用户名是否为空
                if(is_int($newmobilephone)){//判断是否为数字
                if(strlen($newmobilephone)==11){//判断输入数量
                    M('user')->execute("update user set mobilephone='$newmobilephone' where id=$uid");
                    $this->redirect('usercenter/user_set');
                }else{
                    echo "<script>alert('注意手机号格式') </script>";
                    $this->redirect('login/change_tel');
                }
                }else{
                    echo "<script>alert('请注意手机号格式') </script>";
                    $this->redirect('login/change_tel');
                }
            }else{
                echo "<script>alert('新手机号不能为空') </script>";
                $this->redirect('login/change_tel');
            }
        }else{
            echo "<script>alert('请登录') </script>";
            $this->redirect('login/login');
        }
    }













}