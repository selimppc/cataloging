<?php
class Etsb_Productinitiate_Block_Adminhtml_Productinitiate_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('productinitiate_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('productinitiate')->__('News Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
        'label' => Mage::helper('productinitiate')->__('Item Information'),
        'title' => Mage::helper('productinitiate')->__('Item Information'),
        'content' => $this->getLayout()->createBlock('productinitiate/adminhtml_productinitiate_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}