<?php
namespace Kit\Bundle\PayBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;

class BaseService
{

    private $channels = [
        'alipay',
        'weipay',
        'cmbpay'
    ];

    private $config = [];
    
    protected $container;

    public function __construct($config, ContainerInterface $container)
    {
        $this->config = $config;
        $this->container = $container;
    }
    /**
     * get config by channel
     * @param unknown $channel
     * @return number[]|string[]|number[]|string[]
     */
    protected function getConfig($channel)
    {
        if (! in_array($channel, $this->channels)) {
            return [
                'code' => 2,
                'msg' => 'channel error',
                'data' => ''
            ];
        }
        if (! isset($this->config[$channel])) {
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
    /**
     * 
     * @param unknown $channel
     * @param unknown $paytype
     * @return boolean
     */
    protected function checkPayType($channel, $paytype)
    {
        $types = [
            'alipay' => [
                'ali_app', // 支付宝app支付
                'ali_wap', // 支付宝H5支付
                'ali_web', // 支付宝电脑网站支付
                'ali_qr', // 支付宝当面付：扫码支付
                'ali_bar' // 支付宝当面付：条码支付
            ],
            'weipay' => [
                'wx_app', // 微信app支付
                'wx_pub', // 微信公众号支付
                'wx_qr', // 微信扫码支付
                'wx_bar', // 微信刷卡支付
                'wx_lite', // 微信小程序支付
                'wx_wap' // 微信H5支付
            ],
            'cmbpay' => [
                'cmb_app', // 招商一网通app支付
                'cmb_wap' // 招商H5支付
            ]
        ];
        return array_key_exists($channel, $types) && in_array($paytype, $types[$channel]);
    }
}