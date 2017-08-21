<?php
namespace Kit\Bundle\KitPayBundle\Service;

class BaseService
{
    private $channels = ['alipay', 'weipay', 'cmbpay'];
    private $config = [];
    
    public function __construct($config)
    {
        $this->config = $config;
    }
    
    public function getConfig($channel)
    {
        if(!in_array($channel, $this->channels)){
            return [
                'code' => 2,
                'msg' => 'channel error',
                'data' => ''
            ];
        }
        if(!isset($this->config[$channel])){
            return [
                'code' => 3,
                'msg' => 'channel config error',
                'data' => ''
            ];
        }
        return [
            'code' => 1,
            'msg' => 'success',
            'data' => $this->config[$channel]
        ];
    }
}