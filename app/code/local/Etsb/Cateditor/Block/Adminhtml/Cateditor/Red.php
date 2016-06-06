<?php

/**
 * Created by PhpStorm.
 * User: shajjad
 * Date: 5/29/2016
 * Time: 12:59 AM
 */
class Etsb_Cateditor_Block_Adminhtml_Cateditor_Red extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

    //public function render(Varien_Object $row)
    //{

        //if($value = $row->getData('increment_id'))
            //return $row->getId();
        //else
            //return 3;
   // }

    //public function render(Varien_Object $row)
    //{//exit;

        //$value =  $row->getData($this->getColumn()->getIndex());


        /*$model  = Mage::getModel('cateditor/cateditor')->load($row->getId());



        print_r($model);exit;



        if(isset($value)){
            return $row->getId();
        }else{
            return 10;
        }*/

        //return '<span style="color:red;">'.$value.'</span>';

        //$data = $row->getId();
        //$url = Mage::getUrl('test.php', array('_query' => 'id='.$data. '&qty=','_store' => 'default'));


       // $html = parent::render($row);
        //$html .= '<button src="'.$url.'" alt="Submit">' . Mage::helper('cateditor')->__('Update') . '</button>';
       // $html .= '<button onclick="updateField('.$data.');">' . Mage::helper('cateditor')->__('Update') . '</button>';
        //return $html;
    //}

    public function render(Varien_Object $row) {
        return $this->_getValue($row);
    }

    protected function _getValue(Varien_Object $row) {
        $val = $row->getData($this->getColumn()->getIndex());
        $parts = explode("/", $val);
        $filename = end($parts);
        //$url = Mage::helper("adminhtml")->getUrl("cateditor/adminhtml_cateditor/downloadfile", array('filename' => $filename));

        //$url = Mage::getBaseDir(). DS . 'media' . DS . $val;
        $url = Mage::getBaseUrl('media').DS . $val;
        $out = "<a href='".$url."' download>". $filename ."</a>";

        //$out = "<a href='download.php?file='".$url."'>Download</a>";
        return $out;
    }


}

?>



