# KitPayBundle
Symfony wrapper for [payment](https://github.com/helei112g/payment).  
The KitPayBundle provides a simple integration for your Symfony project.

## Installation
 
### Step 1: Download the Bundle
---------------------------
 
Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:
 
	
	$ composer require kitlabs/kit-pay-bundle "~0.1"

 
This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.
 
### Step 2: Enable the Bundle
---------------------------
 
Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

	<?php
	// app/AppKernel.php
	 
	// ...
	class AppKernel extends Kernel
	{
	    public function registerBundles()
	    {
	        $bundles = array(
	            // ...
	 
	            new Kit\Bundle\PayBundle\KitPayBundle(),
	        );
	 
	        // ...
	    }
	 
	    // ...
	}

### Step 3: Configuration 

	# config.yml
	kit_pay:
	    config:
	        alipay:
	            use_sandbox: true
	            partner: 20888xxxxxx  #收款支付宝用户ID
	            app_id: 2014072xxxxxxx # 支付宝分配给开发者的应用ID
	            sign_type: RSA2 # RSA or RSA2
	            ali_public_key: '%kernel.root_dir%/alipay/alipay_public_key_sha256.txt' # path or content(app/alipay/alipay_public_key_sha256.txt)
	            rsa_private_key: '%kernel.root_dir%/alipay/rsa_private_key_2048.txt' # path or content(app/alipay/rsa_private_key_2048.txt)
	            limit_pay: ['creditCard']
	            notify_url: http://kitlabs.cn/notify
	            return_url: http://kitlabs.cn/return
	            return_raw: true # 异步回调是否显示原始数据
	        weipay:
	            use_sandbox: true
	            app_id: wx47xxxxxxx # appid是微信公众账号或开放平台APP的唯一标识
	            mch_id: 148xxxxxx # 商户收款账号
	            md5_key: de95341c9xxxxxx # API密钥
	            app_cert_pem: '%kernel.root_dir%/cert/apiclient_cert.pem' # app/cert/apiclient_cert.pem
	            app_key_pem: '%kernel.root_dir%/cert/apiclient_key.pem'  # app/cert/apiclient_key.pem
	            sign_type: MD5  # MD5 or HMAC-SHA256
	            limit_pay: ['no_credit']
	            fee_type: CNY
	            notify_url: http://kitlabs.cn/notify
	            redirect_url: http://kitlabs.cn/return
	            return_raw: true # 异步回调是否显示原始数据

Read the [payment configure documentation](https://helei112g1.gitbooks.io/payment-sdk/content/ji-chu-pei-zhi.html)
## Usage

	//paytype and channel
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

	/**
     * @var \Kit\Bundle\PayBundle\Service\PaymentService $paymentService
     */
    $paymentService = $this->get('kit_pay.payment_service');
    $paymentService->run($channel, $paytype,  $metadata); // $channel one of "alipay","weipay"
