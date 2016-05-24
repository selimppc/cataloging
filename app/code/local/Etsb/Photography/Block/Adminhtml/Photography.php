<?php
class Etsb_Photography_Block_Adminhtml_Photography extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_photography';
        $this->_blockGroup = 'photography';
        $this->_headerText = Mage::helper('photography')->__('Item Manager');
        $this->_addButtonLabel = Mage::helper('photography')->__('Add Item');
        parent::__construct();
        $this->_removeButton('add');//Remove Add Item button
    }
}