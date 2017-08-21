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
	 
	            new Kit\Bundle\KitPayBundle\KitPayBundle(),
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
	            partner: 20888xxxxxx
	            app_id: xxxxxxx
	            sign_type: RSA2 # RSA or RSA2
	            ali_public_key: /path # path or content
	            rsa_private_key: /path # path or content
	            limit_pay: ['creditCard']
	            notify_url: http://kitlabs.cn/notify
	            return_url: http://kitlabs.cn/return
	            return_raw: true # 异步回调是否显示原始数据
	        weipay:
	            use_sandbox: true
	            app_id: xxxxxx
	            mch_id: xxxxxx
	            md5_key: xxxxxx
	            app_cert_pem: /path
	            app_key_pem: /path
	            sign_type: MD5  # MD5 or HMAC-SHA256
	            limit_pay: ['no_credit']
	            fee_type: CNY
	            notify_url: http://kitlabs.cn/notify
	            redirect_url: http://kitlabs.cn/return
	            return_raw: true # 异步回调是否显示原始数据

Read the [payment configure documentation](https://helei112g1.gitbooks.io/payment-sdk/content/ji-chu-pei-zhi.html)
## Usage

	/**
     * @var \Kit\Bundle\KitPayBundle\Service\PaymentService $paymentService
     */
    $paymentService = $this->get('kit_pay.payment_service');
    $paymentService->run($channel, $metadata); // $channel one of "alipay","weipay"
