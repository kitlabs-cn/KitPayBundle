<?php
namespace Kit\Bundle\PayBundle\Service;

use Payment\Notify\PayNotifyInterface;

class NotifyBase implements PayNotifyInterface 
{
    protected $order;
    
    /**
     * 
     * {@inheritDoc}
     * @see \Payment\Notify\PayNotifyInterface::notifyProcess()
     */
    public function notifyProcess(array $data)
    {
       return $data;
    }
}