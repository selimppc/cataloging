<?php
class Etsb_Archive_Model_Mode{
    protected $_options;
	const ETSB_HORIZONTAL = 'horizontal';
	const ETSB_VERTICAL = 'vertical';
	const ETSB_FADE = 'fade';
	
      
    
    public function toOptionArray(){
        if (!$this->_options) {
			$this->_options[] = array(
			   'value'=>self::ETSB_HORIZONTAL,
			   'label'=>Mage::helper('archive')->__('Horizontal')
			);
			$this->_options[] = array(
			   'value'=>self::ETSB_VERTICAL,
			   'label'=>Mage::helper('archive')->__('Vertical')
			);
			$this->_options[] = array(
			   'value'=>self::ETSB_FADE,
			   'label'=>Mage::helper('archive')->__('Fade')
			);
		}
		return $this->_options;
	}
}
