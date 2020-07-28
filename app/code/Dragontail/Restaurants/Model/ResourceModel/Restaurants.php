<?php
namespace Dragontail\Restaurants\Model\ResourceModel;

class Restaurants extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('restaurants', 'id');
    }
}
?>