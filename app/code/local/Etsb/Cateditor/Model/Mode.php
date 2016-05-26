<?php
class Etsb_Cateditor_Model_Mode{
    protected $_options;
	const ETSB_HORIZONTAL = 'horizontal';
	const ETSB_VERTICAL = 'vertical';
	const ETSB_FADE = 'fade';
	
      
    
    public function toOptionArray(){
        if (!$this->_options) {
			$this->_options[] = array(
			   'value'=>self::ETSB_HORIZONTAL,
			   'label'=>Mage::helper('cateditor')->__('Horizontal')
			);
			$this->_options[] = array(
			   'value'=>self::ETSB_VERTICAL,
			   'label'=>Mage::helper('cateditor')->__('Vertical')
			);
			$this->_options[] = array(
			   'value'=>self::ETSB_FADE,
			   'label'=>Mage::helper('cateditor')->__('Fade')
			);
		}
		return $this->_options;
	}
}
