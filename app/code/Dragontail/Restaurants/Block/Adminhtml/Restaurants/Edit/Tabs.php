<?php
namespace Dragontail\Restaurants\Block\Adminhtml\Restaurants\Edit;

/**
 * Admin page left menu
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('restaurants_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Restaurants Information'));
    }
}