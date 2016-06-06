<?php
class Etsb_Productinitiate_Block_Adminhtml_Productinitiate_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('productinitiate_form', array('legend'=>Mage::helper('productinitiate')->__('Item information')));

        $fieldset->addField('name', 'text', array(
        'label' => Mage::helper('productinitiate')->__('Title'),
        'class' => 'required-entry',
        'required' => true,
        'name' => 'name',
        ));

        $fieldset->addField('sku', 'text', array(
            'label' => Mage::helper('productinitiate')->__('Sku'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'sku',
        ));

        $fieldset->addField('weight', 'text', array(
            'label' => Mage::helper('productinitiate')->__('Weight'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'weight',
        ));

        $fieldset->addField('type', 'select', array(
            'label' => Mage::helper('productinitiate')->__('Product Type'),
            'name' => 'type',
            'required' => true,
            'values' => array(
                array(
                    'value' => 'simple',
                    'label' => Mage::helper('productinitiate')->__('Simple Product'),
                ),
                array(
                    'value' => 'grouped',
                    'label' => Mage::helper('productinitiate')->__('Grouped Product'),

                ),
            ),
        ));

        $fieldset->addField('manufacturer', 'text', array(
            'label' => Mage::helper('productinitiate')->__('Manufacturer'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'manufacturer',
        ));

        $fieldset->addField('visibility', 'select', array(
            'label' => Mage::helper('productinitiate')->__('Visibility'),
            'name' => 'visibility',
            'required' => true,
            'values' => array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('productinitiate')->__('Not Visible Individually'),
                ),
                array(
                    'value' => 2,
                    'label' => Mage::helper('productinitiate')->__('Catalog'),

                ),
                array(
                    'value' => 3,
                    'label' => Mage::helper('productinitiate')->__('Search'),

                ),
                array(
                    'value' => 4,
                    'label' => Mage::helper('productinitiate')->__('Catalog, Search'),

                ),
            ),
        ));

        $fieldset->addField('description', 'editor', array(
        'name' => 'description',
        'label' => Mage::helper('productinitiate')->__('Description'),
        'title' => Mage::helper('productinitiate')->__('Description'),
        'style' => 'width:90%; height:50px;',
        'wysiwyg' => false,
        'required' => true,
        ));

        $fieldset->addField('short_description', 'text', array(
            'label' => Mage::helper('productinitiate')->__('Short Description'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'short_description',
        ));

        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('productinitiate')->__('Status'),
            'name' => 'status',
            'required' => true,
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