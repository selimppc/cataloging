<?php
class Etsb_Productinitiate_Block_Adminhtml_Productinitiate extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_productinitiate';
        $this->_blockGroup = 'productinitiate';
        $this->_headerText = Mage::helper('productinitiate')->__('Item Manager');
        $this->_addButtonLabel = Mage::helper('productinitiate')->__('Add Item');
        parent::__construct();
    }
}