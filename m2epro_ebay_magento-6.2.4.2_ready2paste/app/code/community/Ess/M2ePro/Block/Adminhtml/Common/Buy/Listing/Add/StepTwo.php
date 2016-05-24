<?php

/*
 * @copyright  Copyright (c) 2013 by  ESS-UA.
 */

class Ess_M2ePro_Block_Adminhtml_Common_Buy_Listing_Add_StepTwo extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        // Initialization block
        //------------------------------
        $this->setId('buyListingAddStepTwo');
        $this->_blockGroup = 'M2ePro';
        $this->_controller = 'adminhtml_common_buy_listing';
        $this->_mode = 'edit';
        //------------------------------

        // Set header text
        //------------------------------
        if (!Mage::helper('M2ePro/View_Common_Component')->isSingleActiveComponent()) {
            $componentName =  Mage::helper('M2ePro')->__(Ess_M2ePro_Helper_Component_Buy::TITLE);
            $headerText = Mage::helper('M2ePro')->__("Add %component_name% Listing [Channel Settings]", $componentName);
        } else {
            $headerText = Mage::helper('M2ePro')->__("Add Listing [Channel Settings]");
        }

        $this->_headerText = $headerText;
        //------------------------------

        // Set buttons actions
        //------------------------------
        $this->removeButton('back');
        $this->removeButton('reset');
        $this->removeButton('delete');
        $this->removeButton('add');
        $this->removeButton('save');
        $this->removeButton('edit');
        //------------------------------

        //------------------------------
        $url = $this->getUrl('*/adminhtml_common_buy_listing/add', array('step' => '1'));
        $this->_addButton('back', array(
            'label'     => Mage::helper('M2ePro')->__('Back'),
            'onclick'   => 'BuyListingChannelSettingsHandlerObj.back_click(\'' . $url . '\')',
            'class'     => 'back'
        ));
        //------------------------------

        //------------------------------
        $this->_addButton('reset', array(
            'label'     => Mage::helper('M2ePro')->__('Refresh'),
            'onclick'   => 'BuyListingChannelSettingsHandlerObj.reset_click()',
            'class'     => 'reset'
        ));
        //------------------------------

        //------------------------------
        $url = $this->getUrl('*/adminhtml_common_buy_listing/add', array('step' => '2'));
        $this->_addButton('save_and_next', array(
            'label'     => Mage::helper('M2ePro')->__('Next'),
            'onclick'   => 'BuyListingChannelSettingsHandlerObj.save_click(\'' . $url . '\')',
            'class'     => 'next'
        ));
        //------------------------------
    }
}
