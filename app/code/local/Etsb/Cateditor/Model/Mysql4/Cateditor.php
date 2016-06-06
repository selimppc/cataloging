<?php

class Etsb_Cateditor_Model_Mysql4_Cateditor extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {            
        $this->_init('editor/editor', 'editor_id');
    }
}