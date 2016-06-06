<?php
class Etsb_Productinitiate_Block_Adminhtml_Productinitiate_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'productinitiate';
        $this->_controller = 'adminhtml_productinitiate';
        $this->_updateButton('save', 'label', Mage::helper('productinitiate')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('productinitiate')->__('Delete Item'));
    }
    public function getHeaderText()
    {
        if( Mage::registry('productinitiate_data') && Mage::registry('productinitiate_data')->getId() ) {
        return Mage::helper('productinitiate')->__("Product Initiate", $this->htmlEscape(Mage::registry('productinitiate_data')->getTitle()));
        } else {
        return Mage::helper('productinitiate')->__('Product Initiate');
        }
    }
}