<?php

class Etsb_Photoeditor_Block_Adminhtml_Photoeditor_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'photoeditor';
        $this->_controller = 'adminhtml_photoeditor';

        $this->_updateButton('save', 'label', Mage::helper('photoeditor')->__('Save Banner'));
        $this->_updateButton('delete', 'label', Mage::helper('photoeditor')->__('Delete Banner'));

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function togglePhotoeditor() {
                if (tinyMCE.getInstanceById('photoeditor_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'photoeditor_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'photoeditor_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('photoeditor_data') && Mage::registry('photoeditor_data')->getId() ) {
            return Mage::helper('photoeditor')->__("Edit banner '%s'", $this->htmlEscape(Mage::registry('photoeditor_data')->getTitle()));
        } else {
            return Mage::helper('photoeditor')->__('Add Banner');
        }
    }
}