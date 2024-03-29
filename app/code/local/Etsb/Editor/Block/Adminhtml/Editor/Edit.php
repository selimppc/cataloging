<?php

class Etsb_Editor_Block_Adminhtml_Editor_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'editor';
        $this->_controller = 'adminhtml_editor';

        $this->_updateButton('save', 'label', Mage::helper('editor')->__('Save Banner'));
        $this->_updateButton('delete', 'label', Mage::helper('editor')->__('Delete Banner'));

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('editor_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'editor_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'editor_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('editor_data') && Mage::registry('editor_data')->getId() ) {
            return Mage::helper('editor')->__("Photographer", $this->htmlEscape(Mage::registry('editor_data')->getTitle()));
        } else {
            return Mage::helper('editor')->__('Add Banner');
        }
    }
}