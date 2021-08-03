<?php
namespace common\helpers;


use common\models\Order;
use common\models\PayError;
use common\payment\Wechatpay;
use Yii;
class PayApi
{
    /**
     * 调用支付
     * @param $order
     * @param string $scenic 微信包含：app、h5、jsapi、web
     * @return array
     * @throws \Exception
     */
    public static function run($order,$scenic=''){
        $rearr=['status'=>0,'msg'=>'','data'=>'','pay_type'=>$order['pay_type']??''];

        if(!isset($order['order_sn']) || !$order['order_sn']) {
            $rearr['msg']='订单号错误';
            return $rearr;
        }
        if(!isset($order['order_money']) || $order['order_money']<=0) {
            $rearr['msg']='订单金额错误';
            return $rearr;
        }
        if(!isset($order['pay_type']) || !$order['pay_type']) {
            $rearr['msg']='支付方式错误';
            return $rearr;
        }

        if ($order['pay_type']=='wechat'){
            $res= (new Wechatpay())->pay($order,$scenic);
            $rearr['status']=$res['status'];
            $rearr['msg']=$res['msg'];
            $rearr['data']=$res['data'];
            return $rearr;
        }else{
            throw new \Exception('支付方式错误');
        }
    }
    /**
     * 订单支付成功后的更新等操作
     * @param $out_trade_no
     * @param $trade_no
     * @param $total_amount
     * @return bool
     * @throws \yii\db\Exception
     */
    public static function orderprocess($out_trade_no,$trade_no,$total_amount){
        if(!$out_trade_no || !$trade_no || $total_amount<=0){
            PayError::addLog('参数错误',1,$out_trade_no,$trade_no,$total_amount);
            return false;
        }
        $order_info=Order::findOne(['order_sn'=>$out_trade_no]);
        if(!$order_info) {
            PayError::addLog('订单不存在',2,$out_trade_no,$trade_no,$total_amount);
            return false;
        }
        //判断状态和金额
        if($order_info->status==1) return true;
        if($order_info->money!=$total_amount) {
            PayError::addLog('金额不正确',3,$out_trade_no,$trade_no,$total_amount,$order_info->money);
            return false;
        }

        //更新状态
        $order_info->status=1;
        $order_info->pay_time=date('Y-m-d H:i:s',time());
        $order_info->trade_no=$trade_no;
        if($order_info->save(false)){
            return true;
        }else{
            PayError::addLog('订单更新失败',4,$out_trade_no,$trade_no,$total_amount,$order_info->money);
        }
        return false;
    }
}