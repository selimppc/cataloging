<?php
class Etsb_Cateditor_Block_Adminhtml_Cateditor extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_cateditor';
        $this->_blockGroup = 'cateditor';
        $this->_headerText = Mage::helper('cateditor')->__('Banner Manager');
        $this->_addButtonLabel = Mage::helper('cateditor')->__('Add banner image');
        parent::__construct();
        $this->_removeButton('add');//Remove Add Item button
    }
}