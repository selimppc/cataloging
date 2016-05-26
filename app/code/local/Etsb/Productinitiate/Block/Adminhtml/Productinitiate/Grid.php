<?php
class Etsb_Productinitiate_Block_Adminhtml_Productinitiate_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('productinitiateGrid');
        // This is the primary key of the database
        $this->setDefaultSort('editor_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('editor/editor')->getCollection()
            ->addFieldToFilter('flaginitiate',1)
            ->addFieldToFilter('status',5);

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
    protected function _prepareColumns()
    {
        $this->addColumn('editor_id', array(
        'header' => Mage::helper('productinitiate')->__('ID'),
        'align' =>'right',
        'width' => '50px',
        'index' => 'editor_id',
        ));

        $this->addColumn('title', array(
        'header' => Mage::helper('productinitiate')->__('Title'),
        'align' =>'left',
        'index' => 'title',
        ));

        /*
        $this->addColumn('content', array(
        'header' => Mage::helper('<module>')->__('Item Content'),
        'width' => '150px',
        'index' => 'content',
        ));
        */

        $this->addColumn('created_time', array(
        'header' => Mage::helper('productinitiate')->__('Creation Time'),
        'align' => 'left',
        'width' => '120px',
        'type' => 'date',
        'default' => '–',
        'index' => 'created_time',
        ));

        $this->addColumn('update_time', array(
        'header' => Mage::helper('productinitiate')->__('Update Time'),
        'align' => 'left',
        'width' => '120px',
        'type' => 'date',
        'default' => '–',
        'index' => 'update_time',
        ));

        $this->addColumn('status', array(
        'header' => Mage::helper('productinitiate')->__('Status'),
        'align' => 'left',
        'width' => '80px',
        'index' => 'status',
        'type' => 'options',
        'options' => array(
            /*1 => 'Active',
        0 => 'Inactive',*/
            1 => 'Enabled',
            2 => 'Disabled',
        ),
        ));

        return parent::_prepareColumns();
    }



    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }
}