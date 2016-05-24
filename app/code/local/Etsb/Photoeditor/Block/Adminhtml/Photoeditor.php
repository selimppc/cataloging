<?php
class Etsb_Photoeditor_Block_Adminhtml_Photoeditor extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_photoeditor';
        $this->_blockGroup = 'photoeditor';
        $this->_headerText = Mage::helper('photoeditor')->__('Banner Manager');
        $this->_addButtonLabel = Mage::helper('photoeditor')->__('Add banner image');
        parent::__construct();
        $this->_removeButton('add');//Remove Add Item button
    }
}