<?php

class Etsb_Photoeditor_Block_Adminhtml_Photoeditor_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('photoeditor_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('photoeditor')->__('Banner Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('photoeditor')->__('Banner Information'),
            'title'     => Mage::helper('photoeditor')->__('Banner Information'),
            'content'   => $this->getLayout()->createBlock('photoeditor/adminhtml_photoeditor_edit_tab_form')->toHtml(),
        ));



        return parent::_beforeToHtml();
    }
}