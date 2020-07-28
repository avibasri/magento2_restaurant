<?php

namespace Dragontail\Restaurants\Model\ResourceModel\Restaurants;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Dragontail\Restaurants\Model\Restaurants', 'Dragontail\Restaurants\Model\ResourceModel\Restaurants');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>