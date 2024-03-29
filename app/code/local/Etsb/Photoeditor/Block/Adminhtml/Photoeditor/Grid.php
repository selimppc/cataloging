<?php

class Etsb_Photoeditor_Block_Adminhtml_Photoeditor_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('photoeditorGrid');
        $this->setDefaultSort('editor_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('photoeditor/photoeditor')->getCollection()
            ->addFieldToFilter('flageditor',1)
            ->addFieldToFilter('status',1);
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('editor_id', array(
            'header'    => Mage::helper('photoeditor')->__('ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'editor_id',
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('photoeditor')->__('Title'),
            'align'     =>'left',
            'index'     => 'name',
        ));

        $this->addColumn('sku', array(
            'header'    => Mage::helper('photoeditor')->__('Sku'),
            'align'     =>'left',
            'index'     => 'sku',
        ));

        $this->addColumn('image_download', array(
            'header'           => Mage::helper('photoeditor')->__('Photographer Image Download'),
            'align'            => 'center',
            'filter'    => false,
            'sortable'  => false,
            'is_system' => true,
            'renderer'         => 'Etsb_Cateditor_Block_Adminhtml_Cateditor_Red',
            'index'            => 'editor_filename',
        ));

        /*
        $this->addColumn('content', array(
              'header'    => Mage::helper('platform')->__('Item Content'),
              'width'     => '150px',
              'index'     => 'content',
        ));
        */

        $this->addColumn('status', array(
            'header'    => Mage::helper('photoeditor')->__('Status'),
            'align'     => 'left',
            'width'     => '80px',
            'index'     => 'status',
            'type'      => 'options',
            'options'   => array(
                1 => 'Enabled',
                2 => 'Disabled',
            ),
        ));

        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('photoeditor')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('photoeditor')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
            ));

        //$this->addExportType('*/*/exportCsv', Mage::helper('editor')->__('CSV'));
        //$this->addExportType('*/*/exportXml', Mage::helper('editor')->__('XML'));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('editor_id');
        $this->getMassactionBlock()->setFormFieldName('photoeditor');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'    => Mage::helper('photoeditor')->__('Delete'),
            'url'      => $this->getUrl('*/*/massDelete'),
            'confirm'  => Mage::helper('photoeditor')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('photoeditor/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
            'label'=> Mage::helper('photoeditor')->__('Change status'),
            'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('photoeditor')->__('Status'),
                    'values' => $statuses
                )
            )
        ));
        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}