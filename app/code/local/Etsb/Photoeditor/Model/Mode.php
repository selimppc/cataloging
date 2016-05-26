<?php
class Etsb_Photoeditor_Model_Mode{
    protected $_options;
	const ETSB_HORIZONTAL = 'horizontal';
	const ETSB_VERTICAL = 'vertical';
	const ETSB_FADE = 'fade';
	
      
    
    public function toOptionArray(){
        if (!$this->_options) {
			$this->_options[] = array(
			   'value'=>self::ETSB_HORIZONTAL,
			   'label'=>Mage::helper('photoeditor')->__('Horizontal')
			);
			$this->_options[] = array(
			   'value'=>self::ETSB_VERTICAL,
			   'label'=>Mage::helper('photoeditor')->__('Vertical')
			);
			$this->_options[] = array(
			   'value'=>self::ETSB_FADE,
			   'label'=>Mage::helper('photoeditor')->__('Fade')
			);
		}
		return $this->_options;
	}
}
