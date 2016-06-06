<?php

class Etsb_Archive_Model_Mysql4_Archive extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {            
        $this->_init('editor/editor', 'editor_id');
    }
}