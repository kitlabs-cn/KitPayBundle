<?php
namespace Kit\Bundle\PayBundle\Service;

use Payment\Common\PayException;
use Payment\Client\Notify;
use Payment\Notify\PayNotifyInterface;

class NotifyService extends BaseService
{
    private $types = [
        'alipay' => 'ali_charge',
        'weipay' => 'wx_charge',
        'cmbpay' => 'cmb_charge'
    ];
    /**
     * 
     * @param unknown $channel
     * @param PayNotifyInterface $callback
     * @return number[]|string[]|number[]|string[]|array[]|number[]|string[]|NULL[][]
     */
    public function run($channel, PayNotifyInterface $callback)
    {
        $result = $this->getConfig($channel);
        if(1 == $result['code']){
            $config = $result['data'];
        }else{
            return $result;
        }
        try {
            $str = Notify::run($this->types[$channel], $config, $callback);
            if(false !== strpos($str, 'SUCCESS') || false !== strpos($str, 'success')){
                return [
                    'code' => 1,
                    'msg' => 'success',
                    'data' => $str
                ];
            }else{
                return [
                    'code' => 2,
                    'msg' => 'faild',
                    'data' => $str
                ];
            }
        } catch (PayException $e) {
            return [
                'code' => 0,
                'msg' => 'exception',
                'data' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage()
                ]
            ];
        }
    }
    
}