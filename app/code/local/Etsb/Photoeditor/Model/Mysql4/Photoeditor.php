<?php

class Etsb_Photoeditor_Model_Mysql4_Photoeditor extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {            
        $this->_init('editor/editor', 'editor_id');
    }
}