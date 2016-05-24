<?php

class Etsb_Cateditor_Block_Adminhtml_Cateditor_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('cateditor_form', array('legend'=>Mage::helper('cateditor')->__('Banner information')));

        $fieldset->addField('title', 'text', array(
            'label'     => Mage::helper('cateditor')->__('Image Title'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'title',
            'disabled' => true,
        ));

        $fieldset->addField('code', 'text', array(
            'label'     => Mage::helper('cateditor')->__('Code'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'code',
            'disabled' => true,
        ));

        $fieldset->addField('price', 'text', array(
            'label'     => Mage::helper('cateditor')->__('Price'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'price',
            'disabled' => true,
        ));

        $fieldset->addField('editor_filename', 'image', array(
            'label'     => Mage::helper('cateditor')->__('Photographer Image'),
            'required'  => false,
            'name'      => 'editor_filename',
        ));

        $fieldset->addField('photoeditor_filename', 'image', array(
            'label'     => Mage::helper('cateditor')->__('Editor Image'),
            'required'  => false,
            'name'      => 'photoeditor_filename',
        ));


        $fieldset->addField('catalogname', 'text', array(
            'label'     => Mage::helper('cateditor')->__('Catalog Name'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'catalogname',

        ));


        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('cateditor')->__('Image Status'),
            'name'      => 'status',
            'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('cateditor')->__('Enabled'),
                ),

                array(
                    'value'     => 2,
                    'label'     => Mage::helper('cateditor')->__('Disabled'),
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


        if ( Mage::getSingleton('adminhtml/session')->getCateditorData() )
        {
            $data = Mage::getSingleton('adminhtml/session')->getCateditorData();
            Mage::getSingleton('adminhtml/session')->setCateditorData(null);
        } elseif ( Mage::registry('cateditor_data') ) {
            $data = Mage::registry('cateditor_data')->getData();
        }
        $data['store_id'] = explode(',',$data['stores']);
        $form->setValues($data);

        return parent::_prepareForm();
    }
}