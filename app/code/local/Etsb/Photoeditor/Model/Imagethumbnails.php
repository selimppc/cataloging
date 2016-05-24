<?php
class Etsb_Photoeditor_Model_Imagethumbnails{
    protected $_options;
	const IMAGETHUMB_THUMBNAIL = 'thumbnail';
    const IMAGETHUMB_PAGINATION  = 'pagination';
    const IMAGETHUMB_NONE	= 'none';    
    
    public function toOptionArray(){
        if (!$this->_options) {
			$this->_options[] = array(
			   'value'=>self::IMAGETHUMB_THUMBNAIL,
			   'label'=>Mage::helper('photoeditor')->__('Thumbnails')
			);
			$this->_options[] = array(
			   'value'=>self::IMAGETHUMB_PAGINATION,
			   'label'=>Mage::helper('photoeditor')->__('Pagination')
			);
			$this->_options[] = array(
			   'value'=>self::IMAGETHUMB_NONE,
			   'label'=>Mage::helper('photoeditor')->__('None')
			);			

		}
		return $this->_options;
	}
}
