<?php
class Etsb_Productinitiate_Adminhtml_ProductinitiateController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        $this->loadLayout()
                ->_setActiveMenu('productinitiate/items')
        ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        return $this;
    }

    public function indexAction() {
        /*$this->_initAction();
        $this->_addContent($this->getLayout()->createBlock('photography/adminhtml_photography'));
        $this->renderLayout();*/

        $this->_title($this->__('Productinitiate'))
            ->_title($this->__('Manage banner'));
        $this->_initAction()
            ->renderLayout();
    }

    public function editAction()
    {
        $productinitiateId = $this->getRequest()->getParam('id');
        $productinitiateModel = Mage::getModel('productinitiate/productinitiate')->load($productinitiateId);
        if ($productinitiateModel->getId() || $productinitiateId == 0) {
            Mage::register('productinitiate_data', $productinitiateModel);
        $this->loadLayout();
        $this->_setActiveMenu('productinitiate/items');
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        $this->_addContent($this->getLayout()->createBlock('productinitiate/adminhtml_productinitiate_edit'))
        ->_addLeft($this->getLayout()->createBlock('productinitiate/adminhtml_productinitiate_edit_tabs'));
        $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('productinitiate')->__('Item does not exist'));
        $this->_redirect('*/*/');
        }
    }

    public function newAction()
    {
    $this->_forward('edit');
    }

    public function saveAction()
    {
    if ( $this->getRequest()->getPost() ) {
    try {
    $postData = $this->getRequest()->getPost();

       //print_r($postData);exit;

    $productinitiateModel = Mage::getModel('productinitiate/productinitiate');
    $productinitiateModel->setId($this->getRequest()->getParam('id'))
    ->setName($postData['name'])
    ->setSku($postData['sku'])
    ->setType($postData['type'])
    ->setManufacturer($postData['manufacturer'])
    ->setWeight($postData['weight'])
    ->setVisibility($postData['visibility'])
    ->setDescription($postData['description'])
    ->setShortDescription($postData['short_description'])
    //->setContent($postData['content'])
    ->setStatus($postData['status'])
    ->setFlaginitiate(1)
    ->save();

        //print_r($photographyModel);exit;
    Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully saved'));
    Mage::getSingleton('adminhtml/session')->setProductinitiateData(false);
    $this->_redirect('*/*/');
    return;
    } catch (Exception $e) {
        Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
    Mage::getSingleton('adminhtml/session')->setProductinitiateData($this->getRequest()->getPost());
    $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
    return;
    }
    }
    $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                    $productinitiateModel = Mage::getModel('productinitiate/productinitiate');
                    $productinitiateModel->setId($this->getRequest()->getParam('id'))->delete();
                    Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                    $this->_redirect('*/*/');
                    } catch (Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                    $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                }
        }
        $this->_redirect('*/*/');
    }

    /**
    * Product grid for AJAX request.
    * Sort and filter result for example.
    */

    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody($this->getLayout()->createBlock('importedit/adminhtml_productinitiate_grid')->toHtml());
    }

    protected function _isAllowed()
    {
        return true;
    }
}