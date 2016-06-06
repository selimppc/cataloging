<?php
class Etsb_Photography_Block_Adminhtml_Photography_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('photography_form', array('legend'=>Mage::helper('photography')->__('Item information')));

        $fieldset->addField('name', 'text', array(
        'label' => Mage::helper('photography')->__('Title'),
        'class' => 'required-entry',
        'name' => 'name',
        'disabled' => true,
        ));

        $fieldset->addField('sku', 'text', array(
            'label' => Mage::helper('photography')->__('Sku'),
            'class' => 'required-entry',
            'name' => 'sku',
            'disabled' => true,
        ));

        $fieldset->addField('weight', 'text', array(
            'label' => Mage::helper('photography')->__('Weight'),
            'class' => 'required-entry',
            'name' => 'weight',
            'disabled' => true,
        ));

        $fieldset->addField('type', 'select', array(
            'label' => Mage::helper('productinitiate')->__('Product Type'),
            'name' => 'type',
            'disabled' => true,
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
            'name' => 'manufacturer',
            'disabled' => true,
        ));

        $fieldset->addField('visibility', 'select', array(
            'label' => Mage::helper('productinitiate')->__('Visibility'),
            'name' => 'visibility',
            'disabled' => true,
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
            'disabled' => true,
        ));

        $fieldset->addField('short_description', 'text', array(
            'label' => Mage::helper('productinitiate')->__('Short Description'),
            'class' => 'required-entry',
            'name' => 'short_description',
            'disabled' => true,
        ));



        $fieldset->addField('price', 'text', array(
            'label' => Mage::helper('photography')->__('Price'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'price',
        ));

        $fieldset->addField('qty', 'text', array(
            'label' => Mage::helper('photography')->__('Quantity'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'qty',
        ));

        $fieldset->addField('taxclass', 'select', array(
            'label' => Mage::helper('photography')->__('Tax Class'),
            'name' => 'taxclass',
            'required' => true,
            'values' => array(
                array(
                    'value' => 0,
                    'label' => Mage::helper('photography')->__('None'),
                ),
                array(
                    'value' => 2,
                    'label' => Mage::helper('photography')->__('Taxable Goods'),

                ),
                array(
                    'value' => 4,
                    'label' => Mage::helper('photography')->__('Shipping'),

                ),
            ),
        ));

        $fieldset->addField('isstock', 'select', array(
            'label' => Mage::helper('photography')->__('Stock Availability'),
            'name' => 'isstock',
            'required' => true,
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
            'disabled' => true,
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