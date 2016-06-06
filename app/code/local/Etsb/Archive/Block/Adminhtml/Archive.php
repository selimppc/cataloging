<?php
class Etsb_Archive_Block_Adminhtml_Archive extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_archive';
        $this->_blockGroup = 'archive';
        $this->_headerText = Mage::helper('archive')->__('Archive Editor');
        $this->_addButtonLabel = Mage::helper('archive')->__('Add banner image');
        parent::__construct();
        $this->_removeButton('add');//Remove Add Item button
    }
}