<?php

namespace Test\Sales\Plugin;

use Magento\Sales\Model\ResourceModel\Order\Grid\Collection as OrderGridCollection;

/**
 * Class AddDataToOrdersGrid
 */
class AddDataToOrdersGrid
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * AddDataToOrdersGrid constructor.
     *
     * @param \Psr\Log\LoggerInterface $customLogger
     * @param array $data
     */
    public function __construct(
        \Psr\Log\LoggerInterface $customLogger,
        array $data = []
    ) {
        $this->logger = $customLogger;
    }

    /**
     * @param \Magento\Framework\View\Element\UiComponent\DataProvider\CollectionFactory $subject
     * @param OrderGridCollection $collection
     * @param $requestName
     * @return mixed
     */
    public function afterGetReport($subject, $collection, $requestName)
    {
        if ($requestName !== 'sales_order_grid_data_source') {
            return $collection;
        }

        if ($collection->getMainTable() === $collection->getResource()->getTable('sales_order_grid')) {
            try {
                // Get sales_order_item table
                $orderItemsTableName = $collection->getResource()->getTable('sales_order_item');
                // Create new select instance
                $itemsTableSelectGrouped = $collection->getConnection()->select();
                // Add table with sku and name columns
                $itemsTableSelectGrouped->from(
                    $orderItemsTableName,
                    [
                        'sku_name'     => new \Zend_Db_Expr('GROUP_CONCAT('.$orderItemsTableName.'.sku, \'/\', '.$orderItemsTableName.'.name SEPARATOR \',\')'),
                        'order_id' => 'order_id'
                    ]
                )
                ->where("product_type = 'simple'");

                // Group our select to make one column for one order
                $itemsTableSelectGrouped->group('order_id');
                // Add our sub-select to main collection with only one column: sku_name
                $collection->getSelect()
                        ->joinLeft(
                            ['soi' => $itemsTableSelectGrouped],
                            'soi.order_id = main_table.entity_id',
                            ['sku_name']
                        );
            } catch (\Zend_Db_Select_Exception $selectException) {
                // Do nothing in that case
                $this->logger->log(100, $selectException);
            }
        }
        return $collection;
    }
}
