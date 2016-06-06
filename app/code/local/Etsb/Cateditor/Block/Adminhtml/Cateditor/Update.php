<?php

class Etsb_Cateditor_Block_Adminhtml_Cateditor_Update extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {//exit(1);
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'cateditor';
        $this->_controller = 'adminhtml_cateditor';

        $this->_updateButton('save', 'label', Mage::helper('cateditor')->__('Save Banner'));
        $this->_updateButton('delete', 'label', Mage::helper('cateditor')->__('Delete Banner'));

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleCateditor() {
                if (tinyMCE.getInstanceById('cateditor_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'cateditor_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'cateditor_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('cateditor_data') && Mage::registry('cateditor_data')->getId() ) {
            return Mage::helper('cateditor')->__("Catalog Editor", $this->htmlEscape(Mage::registry('cateditor_data')->getTitle()));
        } else {
            return Mage::helper('cateditor')->__('Add Banner');
        }
    }
}