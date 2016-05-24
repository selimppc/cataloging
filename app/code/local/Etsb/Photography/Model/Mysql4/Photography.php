<?php
class Etsb_Photography_Model_Mysql4_Photography extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        //$this->_init('photography/photography', 'photography_id');
        $this->_init('editor/editor', 'editor_id');
    }
}