<?php
/**
 * Created by PhpStorm.
 * User: danyuxi
 * Date: 17/10/19
 * Time: 下午4:56
 */
namespace Home\Model;
use Think\Model;
class UserModel extends Model
{
    //自动验证
        protected $_validate=array(
        array('username','require','用户名必须'),
        array('username','','用户名不能重复',1,'unique',1),
        array('password','6,16','密码长度不正确','0','length'),
        array('repassword','password','确认密码不一致',0,'confirm')
        );

        //自动执行：添加字段
        protected  $_auto=array(
          array('sex','3'),
          array('h_picname','1'),
          array('state','1'),
          array('password','md5',3,'function'),
          array('creat_time','time',1,'function')
        );



}
