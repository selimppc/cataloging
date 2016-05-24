<?php
class Etsb_Editor_Block_Adminhtml_Editor extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_editor';
        $this->_blockGroup = 'editor';
        $this->_headerText = Mage::helper('editor')->__('Banner Manager');
        $this->_addButtonLabel = Mage::helper('editor')->__('Add banner image');
        parent::__construct();
        $this->_removeButton('add');//Remove Add Item button
    }
}