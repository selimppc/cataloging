<?php

class Etsb_Cateditor_Block_Adminhtml_Cateditor_Update_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('cateditor_tabs');
        $this->setDestElementId('update_form');
        $this->setTitle(Mage::helper('cateditor')->__('Banner Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('cateditor')->__('Banner Information'),
            'title'     => Mage::helper('cateditor')->__('Banner Information'),
            'content'   => $this->getLayout()->createBlock('cateditor/adminhtml_cateditor_update_tab_form')->toHtml(),
        ));



        return parent::_beforeToHtml();
    }
}