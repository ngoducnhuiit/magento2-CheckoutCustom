<?php

namespace Magepow\CheckoutCustom\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UninstallInterface;
use Magepow\CheckoutCustom\Api\Data\CustomFieldsInterface;

class Uninstall implements UninstallInterface
{
    /**
     * @var SchemaSetupInterface
     */
    protected $setup;

    /**
     * @param SchemaSetupInterface   $setup
     * @param ModuleContextInterface $context
     *
     * @return void
     */
    public function uninstall(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $this->setup = $setup->startSetup();
        $this->uninstallQuoteData();
        $this->uninstallSalesData();
        $this->setup = $setup->endSetup();
    }

    /**
     * @return void
     */
    public function uninstallQuoteData()
    {

        $this->setup->getConnection()->dropColumn(
            $this->setup->getTable('quote'),
            CustomFieldsInterface::CHECKOUT_ORDER_REFERENCE
        );
        $this->setup->getConnection()->dropColumn(
            $this->setup->getTable('quote'),
            CustomFieldsInterface::CHECKOUT_DATE
        );
        $this->setup->getConnection()->dropColumn(
            $this->setup->getTable('quote'),
            CustomFieldsInterface::CHECKOUT_COMMENT
        );
        $this->setup->getConnection()->dropColumn(
        $this->setup->getTable('quote'),
        CustomFieldsInterface::CHECKOUT_EMAIL_CC
        );
    }

    /**
     * @return void
     */
    public function uninstallSalesData()
    {

        $this->setup->getConnection()->dropColumn(
            $this->setup->getTable('sales_order'),
            CustomFieldsInterface::CHECKOUT_ORDER_REFERENCE
        );
        $this->setup->getConnection()->dropColumn(
            $this->setup->getTable('sales_order'),
            CustomFieldsInterface::CHECKOUT_DATE
        );
        $this->setup->getConnection()->dropColumn(
            $this->setup->getTable('sales_order'),
            CustomFieldsInterface::CHECKOUT_COMMENT
        );
        $this->setup->getConnection()->dropColumn(
            $this->setup->getTable('sales_order'),
            CustomFieldsInterface::CHECKOUT_EMAIL_CC
        );
    }
}
