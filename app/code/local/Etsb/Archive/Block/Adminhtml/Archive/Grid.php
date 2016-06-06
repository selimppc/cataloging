<?php

class Etsb_Archive_Block_Adminhtml_Archive_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();

       // $this->_init('editor_id');

        //$this->setId('cateditorGrid');
        $this->setDefaultSort('editor_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);


    }



    protected function _prepareCollection()
    {
        $collection = Mage::getModel('archive/archive')->getCollection()
            ->addFieldToFilter('flagproductupdate',1)
            ->addFieldToFilter('status',1);
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('editor_id', array(
            'header'    => Mage::helper('archive')->__('ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'editor_id',
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('archive')->__('Title'),
            'align'     =>'left',
            'index'     => 'name',
        ));

        $this->addColumn('sku', array(
            'header'    => Mage::helper('archive')->__('Sku'),
            'align'     =>'left',
            'index'     => 'sku',
        ));

        /*
        $this->addColumn('content', array(
              'header'    => Mage::helper('platform')->__('Item Content'),
              'width'     => '150px',
              'index'     => 'content',
        ));
        */

        $this->addColumn('status', array(
            'header'    => Mage::helper('archive')->__('Status'),
            'align'     => 'left',
            'width'     => '80px',
            'index'     => 'status',
            'type'      => 'options',
            'options'   => array(
                1 => 'Enabled',
                2 => 'Disabled',
            ),
        ));




        //$params = $this->getCustomerId();
        //echo $data;
        //print_r($params);exit;




        //$currentUrl = Mage::helper('core/url')->getCurrentUrl();
        //$product_id = $this->getProduct()->getId();


        /*$url = Mage::getUrl('test.php', array('_query' => 'id='.$this->getId(). '&qty=','_store' => 'default'));*/

        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('archive')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('archive')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    ),
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
            ));

        /*$this->addColumn('action123',
            array(
                'header'    => Mage::helper('cateditor')->__('Action2'),
                'width'     => '50px',
                'type'      => 'action',
                'getter'     => 'getId',
                'actions'   => array(
                    array(
                        'caption' => Mage::helper('cateditor')->__('Edit'),
                        'url'     => array('/',
                            'params'=>array('id'=>$this->getRequest()->getParam('id'))
                        ),
                        'field'   => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores2',
            ));*/

        /*$this->addColumn('update3', array(
            'header'           => Mage::helper('cateditor')->__('Product Update'),
            'align'            => 'center',
            'filter'    => false,
            'sortable'  => false,
            'is_system' => true,
            'renderer'         => 'Etsb_Cateditor_Block_Adminhtml_Cateditor_Red',
            'index'            => 'update3',
        ));

        $this->addColumn('update',
            array(
                'header'    =>  Mage::helper('cateditor')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption' => Mage::helper('cateditor')->__('Product Update'),
                        'url' => $url,
                        'field' => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
            ));*/







        /*$this->addColumn('update',
            array(
                'header'    =>  Mage::helper('cateditor')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('cateditor')->__('Update'),*/
                        //'url'       => array('base'=> '*/*/update'),
                        /*'field'     => 'id'
                    ),
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'update',
            ));*/




        /*$this->addColumn('update', array(
            'header'           => Mage::helper('cateditor')->__('Product Update'),
            'align'            => 'center',
            'filter'    => false,
            'sortable'  => false,
            'is_system' => true,
            'renderer'         => 'Etsb_Cateditor_Block_Adminhtml_Cateditor_Red',
            'index'            => 'short_description',
        ));*/


        //$this->url= $this->getUrl('*/*/edit', array('id' => 13)); // url generated correctly here
        /*$this->addColumn('update',
            array(
                'header'    => Mage::helper('cateditor')->__('Action'),
                'width'     => '90px',
                'type'      => 'action',
                'getter'     => 'getId',
                'actions'   => array(
                    array(
                        'caption' => Mage::helper('cateditor')->__('Edit Product'),
                        'url'       => array('base'=> 'cateditor/adminhtml_cateditor/update', 'params' => array('id' => $this->getId())),
                        'url'       => array('cateditor/adminhtml_cateditor/update/Red.php', 'params' => array('id' => $this->getId())),

                        'field'   => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'update',
            ));*/



        /*$this->addColumn('action1',
            array(
                'header' => Mage::helper('cateditor')->__('Action1'),
                'width' => '100',
                'type' => 'action',
                'getter' => 'getId',
                'actions' => array(
                    array(
                        'caption' => Mage::helper('cateditor')->__('View'),*/
                        //'url' => array('base'=> '*/*/update'),
                       /* 'field' => 'id'
                    )),


                'filter' => false,
                'sortable' => false,
                'index' => 'stores1',
                'is_system' => true,
            ));*/




        //$this->addExportType('*/*/exportCsv', Mage::helper('editor')->__('CSV'));
        //$this->addExportType('*/*/exportXml', Mage::helper('editor')->__('XML'));

        return parent::_prepareColumns();
    }





    protected function _prepareMassaction()
    {
        //$model = Mage::getModel('cateditor/cateditor')->getCollection();
        //$model->addFieldToFilter('flagproductupdate',0);



        //$collection = Mage::getModel('cateditor/cateditor')->getCollection();
        //$collection->getSelect('editor_id');
       // $collection->addFieldToFilter('flagproductupdate',0);
        //echo $collection->getSelect();


        /*$this->setMassactionIdField('editor_id');
        $this->getMassactionBlock()->setFormFieldName('archive');*/







        // options code here


        //$this->getMassactionBlock()->addItem('delete', array(
           // 'label'    => Mage::helper('archive')->__('Delete'),
            //'url'      => $this->getUrl('*/*/massDelete'),
           // 'confirm'  => Mage::helper('archive')->__('Are you sure?')
        //));

       // $this->getMassactionBlock()->setUseSelectAll(true);

        //$this->getMassactionBlock()->addItem('update', array(
           // 'label'    => Mage::helper('archive')->__('Product Update'),
            //'url'      => $this->getUrl('*/*/massUpdate'),
           // 'confirm'  => Mage::helper('archive')->__('Are you sure?')
        //));

        //$statuses = Mage::getSingleton('archive/status')->getOptionArray();

        //array_unshift($statuses, array('label'=>'', 'value'=>''));
       // $this->getMassactionBlock()->addItem('status', array(
           // 'label'=> Mage::helper('archive')->__('Change status'),
            //'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
            //'additional' => array(
               // 'visibility' => array(
                 //   'name' => 'status',
                 //   'type' => 'select',
                  //  'class' => 'required-entry',
                  //  'label' => Mage::helper('archive')->__('Status'),
                   // 'values' => $statuses
               // )
           // )
        //));
        return $this;
    }

    public function getRowUrl($row)
    {
        //This code for after click grid row, go to below url

        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
        //return Mage::getUrl('test.php', array('id' => $row->getId()));
        //return $this->getUrl('*/*/update', array('id' => $row->getId()));
    }


    //public function getGridUrl()
   // {
        //return $this->getUrl('*/*/index', array('_current'=>true));
   // }



}
?>




<!--<script>
    /*function updateField(parameter){

        //$url = Mage::getUrl('test.php', array('_query' => 'id='.$data. '&qty=','_store' => 'default'));
       // alert(parameter);

       // var sendMailPath = <?php //Mage::getUrl('test.php', array('_query' => 'id='.$data. '&qty=','_store' => 'default')); ?>;

        if (str=="")
        {
            document.getElementById("response").innerHTML="";
            return;
        }
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById("response").innerHTML=xmlhttp.responseText;
            }
        }

        xmlhttp.open("GET",test.php,true);
        xmlhttp.send();

    }
</script>-->

