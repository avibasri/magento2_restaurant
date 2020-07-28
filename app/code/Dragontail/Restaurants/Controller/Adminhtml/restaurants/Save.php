<?php
namespace Dragontail\Restaurants\Controller\Adminhtml\restaurants;

use Magento\Backend\App\Action;
use Magento\Framework\App\Filesystem\DirectoryList;


class Save extends \Magento\Backend\App\Action
{

    /**
     * @param Action\Context $context
     */
    public function __construct(Action\Context $context)
    {
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();


        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $model = $this->_objectManager->create('Dragontail\Restaurants\Model\Restaurants');

            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
                $model->setCreatedAt(date('Y-m-d H:i:s'));
            }
            
            $model->setData($data);
            $geoLocation = str_replace('/',',',$model->getData('geo_location'));
            $address = false;
            if ($geoLocation) {
                $address = $this->getAddress($geoLocation);
                $model->setData('address',$address);
            }
            try {
                $model->save();
                $this->messageManager->addSuccess(__('The Restaurants has been saved.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Restaurants.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
    protected function getAddress($coordinates)
    {
        $apiKey = 'cf1c2abc91d39ef9ece7808772191d5e';
        $url = "http://api.positionstack.com/v1/reverse?access_key=$apiKey&limit=1&&query=$coordinates";
        $theAddress = 'No Address Found';
        // Make the HTTP request
        $data = @file_get_contents($url);
        // Parse the json response
        $jsondata = json_decode($data,true);
        $addressArray = $jsondata['data'][0];
        if (is_array($addressArray) && !empty($addressArray)) {
            if (isset($addressArray['name']) && isset($addressArray['region'])) {
                // Set The Address Format As You Wish By concatenating The Fields
                $theAddress = $addressArray['name'].', '.$addressArray['region'];
            }
        }

        return $theAddress;
    }
}