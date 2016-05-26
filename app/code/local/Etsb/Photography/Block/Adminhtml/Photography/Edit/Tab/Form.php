<?php
class Etsb_Photography_Block_Adminhtml_Photography_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('photography_form', array('legend'=>Mage::helper('photography')->__('Item information')));

        $fieldset->addField('title', 'text', array(
        'label' => Mage::helper('photography')->__('Title'),
        'class' => 'required-entry',
        'required' => true,
        'name' => 'title',
        'disabled' => true,
        ));

        $fieldset->addField('code', 'text', array(
            'label' => Mage::helper('photography')->__('Code'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'code',
            'disabled' => true,
        ));



        $fieldset->addField('price', 'text', array(
            'label' => Mage::helper('photography')->__('Price'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'price',
        ));

        /*$fieldset->addField('content', 'editor', array(
        'name' => 'content',
        'label' => Mage::helper('photography')->__('Content'),
        'title' => Mage::helper('photography')->__('Content'),
        'style' => 'width:90%; height:200px;',
        'wysiwyg' => false,
        'required' => true,
        ));*/

        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('photography')->__('Status'),
            'name' => 'status',
            'values' => array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('photography')->__('Enabled'),
                ),
                array(
                    'value' => 2,
                    'label' => Mage::helper('photography')->__('Disabled'),

                ),
            ),
        ));

        if ( Mage::getSingleton('adminhtml/session')->getPhotographyData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getPhotographyData());
        Mage::getSingleton('adminhtml/session')->setPhotographyData(null);
        } elseif ( Mage::registry('photography_data') ) {
            $form->setValues(Mage::registry('photography_data')->getData());
        }
        return parent::_prepareForm();
    }
}