<?php
namespace Kit\Bundle\PayBundle\Service;

use Payment\Common\PayException;
use Payment\Client\Charge;

class PaymentService extends BaseService
{
    /**
     * 
     * @param string $channel
     * @param string $paytype
     * @param array $metadata
     * @param array $config
     * @return number[]|string[]|number[]|string[]|number[]|string[]|mixed[]|array[]|number[]|string[]|NULL[][]
     */
    public function run($channel, $paytype, $metadata, $config = [])
    {
        // check paytype
       if(!$this->checkPayType($channel, $paytype)){
           return [
               'code' => 2,
               'msg' => 'pay type error',
               'data' => ''
           ];
       }
       if(empty($config)){
           $result = $this->getConfig($channel);
           if(1 == $result['code']){
               $config = $result['data'];
           }else{
               return $result;
           }
       }
       // check config
       $checkResult = $this->checkConfig($channel, $paytype);
       if( 1 != $checkResult['code'] ) {
           return $checkResult;
       }
       try {
           $str = Charge::run($paytype, $config, $metadata);
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