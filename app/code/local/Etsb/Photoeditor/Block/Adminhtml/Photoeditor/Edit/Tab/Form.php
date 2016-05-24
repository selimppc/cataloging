<?php

class Etsb_Photoeditor_Block_Adminhtml_Photoeditor_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('photoeditor_form', array('legend'=>Mage::helper('photoeditor')->__('Banner information')));

        $fieldset->addField('title', 'text', array(
            'label'     => Mage::helper('photoeditor')->__('Image Title'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'title',
            'disabled' => true,
        ));

        $fieldset->addField('code', 'text', array(
            'label'     => Mage::helper('photoeditor')->__('Code'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'code',
            'disabled' => true,
        ));

        $fieldset->addField('price', 'text', array(
            'label'     => Mage::helper('photoeditor')->__('Price'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'price',
            'disabled' => true,
        ));


        $fieldset->addField('editor_filename', 'image', array(
            'label'     => Mage::helper('photoeditor')->__('Photographer Image'),
            'required'  => false,
            'name'      => 'editor_filename',
        ));

        $fieldset->addField('photoeditor_filename', 'image', array(
            'label'     => Mage::helper('photoeditor')->__('Editor Image'),
            'required'  => false,
            'name'      => 'photoeditor_filename',
        ));


        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('photoeditor')->__('Image Status'),
            'name'      => 'status',
            'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('photoeditor')->__('Enabled'),
                ),

                array(
                    'value'     => 2,
                    'label'     => Mage::helper('photoeditor')->__('Disabled'),
                ),
            ),
        ));

        /*$fieldset->addField('weblink', 'text', array(
            'label'     => Mage::helper('editor')->__('Image Url'),
            'class'     => 'validate-url',
            'required'  => false,
            'after_element_html' => "<small>Image URL</small>",
            'name'      => 'weblink',
        ));

        $fieldset->addField('content', 'editor', array(
            'name'      => 'content',
            'label'     => Mage::helper('editor')->__('Content'),
            'title'     => Mage::helper('editor')->__('Content'),
            'style'     => 'width:280px; height:100px;',
            'wysiwyg'   => false,
            'required'  => false,
        ));*/


        if ( Mage::getSingleton('adminhtml/session')->getPhotoeditorData() )
        {
            $data = Mage::getSingleton('adminhtml/session')->getPhotoeditorData();
            Mage::getSingleton('adminhtml/session')->setPhotoeditorData(null);
        } elseif ( Mage::registry('photoeditor_data') ) {
            $data = Mage::registry('photoeditor_data')->getData();
        }
        $data['store_id'] = explode(',',$data['stores']);
        $form->setValues($data);

        return parent::_prepareForm();
    }
}