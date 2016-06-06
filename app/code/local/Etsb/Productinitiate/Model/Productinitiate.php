<?php
class Etsb_Productinitiate_Model_Productinitiate extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        //$this->_init('photography/photography');
        $this->_init('editor/editor');

    }
}