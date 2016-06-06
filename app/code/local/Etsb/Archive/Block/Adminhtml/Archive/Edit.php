<?php

class Etsb_Archive_Block_Adminhtml_Archive_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {//exit(1);
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'archive';
        $this->_controller = 'adminhtml_archive';

        /*$this->_updateButton('save', 'label', Mage::helper('archive')->__('Save Banner'));
        $this->_updateButton('delete', 'label', Mage::helper('archive')->__('Delete Banner'));

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);*/

        /*$this->_formScripts[] = "
            function toggleArchive() {
                if (tinyMCE.getInstanceById('archive_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'archive_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'archive_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";*/
    }

    public function getHeaderText()
    {
        if( Mage::registry('archive_data') && Mage::registry('archive_data')->getId() ) {
            return Mage::helper('archive')->__("Catalog Editor", $this->htmlEscape(Mage::registry('archive_data')->getTitle()));
        } else {
            return Mage::helper('archive')->__('Add Banner');
        }
    }
}