<?php
class Etsb_Productinitiate_Block_Adminhtml_Productinitiate_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('productinitiate_form', array('legend'=>Mage::helper('productinitiate')->__('Item information')));

        $fieldset->addField('title', 'text', array(
        'label' => Mage::helper('productinitiate')->__('Title'),
        'class' => 'required-entry',
        'required' => true,
        'name' => 'title',
        ));

        $fieldset->addField('code', 'text', array(
            'label' => Mage::helper('productinitiate')->__('Code'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'code',
        ));

        /*$fieldset->addField('content', 'editor', array(
        'name' => 'content',
        'label' => Mage::helper('productinitiate')->__('Content'),
        'title' => Mage::helper('productinitiate')->__('Content'),
        'style' => 'width:90%; height:200px;',
        'wysiwyg' => false,
        'required' => true,
        ));*/

        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('productinitiate')->__('Status'),
            'name' => 'status',
            'values' => array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('productinitiate')->__('Enabled'),
                ),
                array(
                    'value' => 2,
                    'label' => Mage::helper('productinitiate')->__('Disabled'),

                ),
            ),
        ));

        if ( Mage::getSingleton('adminhtml/session')->getProductinitiateData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getProductinitiateData());
        Mage::getSingleton('adminhtml/session')->setProductinitiateData(null);
        } elseif ( Mage::registry('productinitiate_data') ) {
            $form->setValues(Mage::registry('productinitiate_data')->getData());
        }
        return parent::_prepareForm();
    }
}