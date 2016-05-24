<?php

class Etsb_Cateditor_Model_Cateditor extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('editor/editor');
    }
}