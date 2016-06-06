<?php

class Etsb_Editor_Model_Mysql4_Editor extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {            
        $this->_init('editor/editor', 'editor_id');
    }
}