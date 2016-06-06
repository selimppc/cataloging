<?php

class Etsb_Editor_Block_Adminhtml_Editor_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('editor_form', array('legend'=>Mage::helper('editor')->__('Banner information')));

        $fieldset->addField('name', 'text', array(
            'label' => Mage::helper('editor')->__('Title'),
            'class' => 'required-entry',
            'name' => 'name',
            'disabled' => true,
        ));

        $fieldset->addField('sku', 'text', array(
            'label' => Mage::helper('editor')->__('Sku'),
            'class' => 'required-entry',
            'name' => 'sku',
            'disabled' => true,
        ));

        $fieldset->addField('weight', 'text', array(
            'label' => Mage::helper('editor')->__('Weight'),
            'class' => 'required-entry',
            'name' => 'weight',
            'disabled' => true,
        ));

        $fieldset->addField('type', 'select', array(
            'label' => Mage::helper('editor')->__('Product Type'),
            'name' => 'type',
            'disabled' => true,
            'values' => array(
                array(
                    'value' => 'simple',
                    'label' => Mage::helper('editor')->__('Simple Product'),
                ),
                array(
                    'value' => 'grouped',
                    'label' => Mage::helper('editor')->__('Grouped Product'),

                ),
            ),
        ));

        $fieldset->addField('manufacturer', 'text', array(
            'label' => Mage::helper('editor')->__('Manufacturer'),
            'class' => 'required-entry',
            'name' => 'manufacturer',
            'disabled' => true,
        ));

        $fieldset->addField('visibility', 'select', array(
            'label' => Mage::helper('editor')->__('Visibility'),
            'name' => 'visibility',
            'disabled' => true,
            'values' => array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('editor')->__('Not Visible Individually'),
                ),
                array(
                    'value' => 2,
                    'label' => Mage::helper('editor')->__('Catalog'),

                ),
                array(
                    'value' => 3,
                    'label' => Mage::helper('editor')->__('Search'),

                ),
                array(
                    'value' => 4,
                    'label' => Mage::helper('editor')->__('Catalog, Search'),

                ),
            ),
        ));

        $fieldset->addField('description', 'editor', array(
            'name' => 'description',
            'label' => Mage::helper('productinitiate')->__('Description'),
            'title' => Mage::helper('productinitiate')->__('Description'),
            'style' => 'width:90%; height:50px;',
            'wysiwyg' => false,
            'disabled' => true,
        ));

        $fieldset->addField('short_description', 'text', array(
            'label' => Mage::helper('editor')->__('Short Description'),
            'class' => 'required-entry',
            'name' => 'short_description',
            'disabled' => true,
        ));



        $fieldset->addField('price', 'text', array(
            'label' => Mage::helper('editor')->__('Price'),
            'class' => 'required-entry',
            'name' => 'price',
            'disabled' => true,
        ));

        $fieldset->addField('qty', 'text', array(
            'label' => Mage::helper('editor')->__('Quantity'),
            'class' => 'required-entry',
            'name' => 'qty',
            'disabled' => true,
        ));

        $fieldset->addField('taxclass', 'select', array(
            'label' => Mage::helper('editor')->__('Tax Class'),
            'name' => 'taxclass',
            'disabled' => true,
            'values' => array(
                array(
                    'value' => 0,
                    'label' => Mage::helper('editor')->__('None'),
                ),
                array(
                    'value' => 2,
                    'label' => Mage::helper('editor')->__('Taxable Goods'),

                ),
                array(
                    'value' => 4,
                    'label' => Mage::helper('editor')->__('Shipping'),

                ),
            ),
        ));

        $fieldset->addField('isstock', 'select', array(
            'label' => Mage::helper('photography')->__('Stock Availability'),
            'name' => 'isstock',
            'disabled' => true,
            'values' => array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('photography')->__('In Stock'),
                ),
                array(
                    'value' => 0,
                    'label' => Mage::helper('photography')->__('Out of Stock'),

                ),
            ),
        ));

        $fieldset->addField('editor_filename', 'image', array(
            'label'     => Mage::helper('editor')->__('Image'),
            'required'  => true,
            'name'      => 'editor_filename',
        ));

        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('editor')->__('Status'),
            'name' => 'status',
            'disabled' => true,
            'values' => array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('editor')->__('Enabled'),
                ),
                array(
                    'value' => 2,
                    'label' => Mage::helper('editor')->__('Disabled'),

                ),
            ),
        ));


        if ( Mage::getSingleton('adminhtml/session')->getEditorData() )
        {
            $data = Mage::getSingleton('adminhtml/session')->getEditorData();
            Mage::getSingleton('adminhtml/session')->setEditorData(null);
        } elseif ( Mage::registry('editor_data') ) {
            $data = Mage::registry('editor_data')->getData();
        }
        $data['store_id'] = explode(',',$data['stores']);
        $form->setValues($data);

        return parent::_prepareForm();
    }
}