<?php
class Etsb_Photography_Adminhtml_PhotographyController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        $this->loadLayout()
                ->_setActiveMenu('photography/items')
        ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        return $this;
    }

    public function indexAction() {
        /*$this->_initAction();
        $this->_addContent($this->getLayout()->createBlock('photography/adminhtml_photography'));
        $this->renderLayout();*/

        $this->_title($this->__('Photography'))
            ->_title($this->__('Manage banner'));
        $this->_initAction()
            ->renderLayout();
    }

    public function editAction()
    {
        $photographyId = $this->getRequest()->getParam('id');
        $photographyModel = Mage::getModel('photography/photography')->load($photographyId);
        if ($photographyModel->getId() || $photographyId == 0) {
            Mage::register('photography_data', $photographyModel);
        $this->loadLayout();
        $this->_setActiveMenu('photography/items');
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        $this->_addContent($this->getLayout()->createBlock('photography/adminhtml_photography_edit'))
        ->_addLeft($this->getLayout()->createBlock('photography/adminhtml_photography_edit_tabs'));
        $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('photography')->__('Item does not exist'));
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

    $photographyModel = Mage::getModel('photography/photography');
    $photographyModel->setId($this->getRequest()->getParam('id'))
    ->setPrice($postData['price'])
    ->setQty($postData['qty'])
    ->setTaxclass($postData['taxclass'])
    ->setIsstock($postData['isstock'])
    ->setFlagprice(1);

    //if ($photographyModel->getCreatedTime == NULL || $photographyModel->getUpdateTime() == NULL) {
    if ($photographyModel->getCreatedTime == NULL) {
        $photographyModel->setCreatedTime(now());
            //->setUpdateTime(now());
    } else if($photographyModel->getUpdateTime() != NULL){
        $photographyModel->setUpdateTime(now());
    }

    $photographyModel->save();


        //print_r($photographyModel);exit;
    Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully saved'));
    Mage::getSingleton('adminhtml/session')->setPhotographyData(false);
    $this->_redirect('*/*/');
    return;
    } catch (Exception $e) {
        Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
    Mage::getSingleton('adminhtml/session')->setPhotographyData($this->getRequest()->getPost());
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
                    $photographyModel = Mage::getModel('photography/photography');
                    $photographyModel->setId($this->getRequest()->getParam('id'))->delete();
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
        $this->getResponse()->setBody($this->getLayout()->createBlock('importedit/adminhtml_photography_grid')->toHtml());
    }


    protected function _isAllowed()
    {
        return true;
    }
}