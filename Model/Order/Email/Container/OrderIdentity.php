<?php

namespace Magepow\CheckoutCustom\Model\Order\Email\Container;

class OrderIdentity extends \Magento\Sales\Model\Order\Email\Container\OrderIdentity

{
    public function getEmailCopyTo()
    {
        
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $currentEmailCc = $objectManager->get('Magento\Checkout\Model\Session');
        $emailCC = $currentEmailCc->getEmailCc();
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/templog.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info($emailCC);
        $data = $this->getConfigValue(self::XML_PATH_EMAIL_COPY_TO, $this->getStore()->getStoreId());
        $data2 = $data.','.$emailCC;
        if (!empty($data) && !empty($emailCC)) {
            return array_map('trim', explode(',', $data2));
        }
        if (empty($data) && !empty($emailCC)){
            return array_map('trim', explode(',', $emailCC));
        }
        if (!empty($data) && empty($emailCC) ){
            return array_map('trim', explode(',', $data));
        }
        if (empty($data) && empty($emailCC)) {
           return false;
        }
        
    }


}
