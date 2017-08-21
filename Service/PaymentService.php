<?php
namespace Kit\Bundle\KitPayBundle\Service;

use Payment\Common\PayException;
use Payment\Client\Charge;

class PaymentService extends BaseService
{
    public function run($channel, $metadata)
    {
       $result = $this->getConfig($channel);
       if(1 == $result['code']){
           $config = $result['data'];
       }else{
           return $result;
       }
       try {
           $str = Charge::run($channel, $config, $metadata);
           return [
               'code' => 1,
               'msg' => 'success',
               'data' => $str
           ];
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