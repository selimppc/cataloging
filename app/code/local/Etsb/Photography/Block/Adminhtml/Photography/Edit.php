<?php
class Etsb_Photography_Block_Adminhtml_Photography_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'photography';
        $this->_controller = 'adminhtml_photography';
        $this->_updateButton('save', 'label', Mage::helper('photography')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('photography')->__('Delete Item'));
    }
    public function getHeaderText()
    {
        if( Mage::registry('photography_data') && Mage::registry('photography_data')->getId() ) {
        return Mage::helper('photography')->__("Pricing", $this->htmlEscape(Mage::registry('photography_data')->getTitle()));
        } else {
        return Mage::helper('photography')->__('Pricing');
        }
    }
}