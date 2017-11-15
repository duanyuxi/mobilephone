<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){

            //获取一级动态分类
            $firsttype=M('type')->query('select name,id from type where pid="0"');
            $this->display();

    }
}
