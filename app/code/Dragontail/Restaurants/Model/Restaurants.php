<?php
namespace Dragontail\Restaurants\Model;

class Restaurants extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Dragontail\Restaurants\Model\ResourceModel\Restaurants');
    }
}
?>