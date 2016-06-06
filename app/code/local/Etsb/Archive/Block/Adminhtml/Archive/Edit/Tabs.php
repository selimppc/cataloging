<?php

class Etsb_Archive_Block_Adminhtml_Archive_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {//echo "ok";exit;
        parent::__construct();
        $this->setId('archive_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('archive')->__('Banner Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('archive')->__('Banner Information'),
            'title'     => Mage::helper('archive')->__('Banner Information'),
            'content'   => $this->getLayout()->createBlock('archive/adminhtml_archive_edit_tab_form')->toHtml(),
        ));



        return parent::_beforeToHtml();
    }
}