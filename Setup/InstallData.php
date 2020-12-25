<?php

namespace Magepow\CheckoutCustom\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Quote\Setup\QuoteSetupFactory;
use Magento\Sales\Setup\SalesSetupFactory;
use Magento\Framework\DB\Ddl\Table;
use Magepow\CheckoutCustom\Api\Data\CustomFieldsInterface;

class InstallData implements InstallDataInterface
{
    /**
     * @var SalesSetupFactory
     */
    protected $salesSetupFactory;

    /**
     * @var QuoteSetupFactory
     */
    protected $quoteSetupFactory;

    /**
     * @var ModuleDataSetupInterface
     */
    protected $setup;

    /**
     * InstallData constructor.
     *
     * @param SalesSetupFactory $salesSetupFactory
     * @param QuoteSetupFactory $quoteSetupFactory
     */
    public function __construct(
        SalesSetupFactory $salesSetupFactory,
        QuoteSetupFactory $quoteSetupFactory
    ) {
        $this->salesSetupFactory = $salesSetupFactory;
        $this->quoteSetupFactory = $quoteSetupFactory;
    }

    /**
     * Install data
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface   $context
     *
     * @return void
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $this->setup = $setup->startSetup();
        $this->installQuoteData();
        $this->installSalesData();
        $this->setup = $setup->endSetup();
    }

    /**
     * @return void
     */
    public function installQuoteData()
    {
        $quoteInstaller = $this->quoteSetupFactory->create(
            [
                'resourceName' => 'quote_setup',
                'setup' => $this->setup
            ]
        );
        $quoteInstaller

            ->addAttribute(
                'quote',
                CustomFieldsInterface::CHECKOUT_ORDER_REFERENCE,
                ['type' => Table::TYPE_TEXT, 'length' => '255', 'nullable' => true]
            )
            ->addAttribute(
                'quote',
                CustomFieldsInterface::CHECKOUT_DATE,
                ['type' => Table::TYPE_TEXT, 'length' => '255', 'nullable' => true]
            )
            ->addAttribute(
                'quote',
                CustomFieldsInterface::CHECKOUT_COMMENT,
                ['type' => Table::TYPE_TEXT, 'length' => '64k', 'nullable' => true]
            )->addAttribute(
                'quote',
                CustomFieldsInterface::CHECKOUT_EMAIL_CC,
                ['type' => Table::TYPE_TEXT, 'length' => '255', 'nullable' => true]
            );
    }

    /**
     * @return void
     */
    public function installSalesData()
    {
        $salesInstaller = $this->salesSetupFactory->create(
            [
                'resourceName' => 'sales_setup',
                'setup' => $this->setup
            ]
        );
        $salesInstaller
            ->addAttribute(
                'order',
                CustomFieldsInterface::CHECKOUT_ORDER_REFERENCE,
                ['type' => Table::TYPE_TEXT, 'length' => '255', 'nullable' => true, 'grid' => false]
            )
            ->addAttribute(
                'order',
                CustomFieldsInterface::CHECKOUT_DATE,
                ['type' => Table::TYPE_TEXT, 'length' => '255', 'nullable' => true, 'grid' => false]
            )
            ->addAttribute(
                'order',
                CustomFieldsInterface::CHECKOUT_COMMENT,
                ['type' => Table::TYPE_TEXT, 'length' => '64k', 'nullable' => true, 'grid' => false]
            )
            ->addAttribute(
                'order',
                CustomFieldsInterface::CHECKOUT_EMAIL_CC,
                ['type' => Table::TYPE_TEXT, 'length' => '64k', 'nullable' => true, 'grid' => false]
            );
    }
}
