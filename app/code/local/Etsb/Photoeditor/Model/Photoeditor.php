<?php

class Etsb_Photoeditor_Model_Photoeditor extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('editor/editor');
    }
}