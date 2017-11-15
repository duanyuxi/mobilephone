<?php
/**
 * Created by PhpStorm.
 * User: danyuxi
 * Date: 17/10/19
 * Time: 下午5:11
 */
namespace Home\Model;
use Think\Model;
class AddressModel extends Model
{
    //自动验证
    protected $_vaildate=array(
        array('city','require','城市名必须'),
        array('restaurant_name','require','餐馆名必须'),
        array('linkman','require','收货人必须'),
        array('linkphone','require','联系电话必须'),
        array('treet','require','地址必须')
    );
        // 自动执行：添加字段
    protected $auto=array(
        array('state','1')
    );

}