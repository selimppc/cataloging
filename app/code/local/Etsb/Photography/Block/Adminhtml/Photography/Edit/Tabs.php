<?php
class Etsb_Photography_Block_Adminhtml_Photography_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('photography_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('photography')->__('News Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
        'label' => Mage::helper('photography')->__('Item Information'),
        'title' => Mage::helper('photography')->__('Item Information'),
        'content' => $this->getLayout()->createBlock('photography/adminhtml_photography_edit_tab_form')->toHtml(),
        ));
        return parent::_beforeToHtml();
    }
}