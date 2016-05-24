<?php

class Etsb_Photoeditor_Adminhtml_PhotoeditorController extends Mage_Adminhtml_Controller_Action
{

    protected function _initAction() {
        $this->loadLayout()
            ->_setActiveMenu('photoeditor/items')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Banners Manager'), Mage::helper('adminhtml')->__('Banner Manager'));

        return $this;
    }

    public function indexAction() {

        $this->_title($this->__('Photoeditor'))
            ->_title($this->__('Manage banner'));
        $this->_initAction()
            ->renderLayout();
    }

    public function editAction() {
        $id     = $this->getRequest()->getParam('id');
        $model  = Mage::getModel('photoeditor/photoeditor')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('photoeditor_data', $model);

            $this->_title($this->__('Photoeditor'))
                ->_title($this->__('Manage banner'));
            if ($model->getId()){
                $this->_title($model->getTitle());
            }else{
                $this->_title($this->__('New Banner'));
            }

            $this->loadLayout();
            $this->_setActiveMenu('photoeditor/items');

            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('photoeditor/adminhtml_photoeditor_edit'))
                ->_addLeft($this->getLayout()->createBlock('photoeditor/adminhtml_photoeditor_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('photoeditor')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function newAction() {
        $this->_forward('edit');
    }

    public function saveAction() {
        if ($data = $this->getRequest()->getPost()) {

            if($data['photoeditor_filename']['delete']==1){
                $data['photoeditor_filename']='';
            }
            elseif(is_array($data['photoeditor_filename'])){
                $data['photoeditor_filename']=$data['photoeditor_filename']['value'];
            }


            $file = new Varien_Io_File();
            $baseDir = Mage::getBaseDir();
            $mediaDir = $baseDir.DS.'media';
            $imageDir = $mediaDir.DS.'photoeditorimages';
            $thumbimageyDir = $mediaDir.DS.'photoeditorimages'.DS.'thumbs';

            if(!is_dir($imageDir)){
                $imageDirResult = $file->mkdir($imageDir, 0777);
            }
            if(!is_dir($thumbimageyDir)){
                $thumbimageDirResult = $file->mkdir($thumbimageyDir, 0777);
            }

            //$thumbimageDirResult = $file->mkdir($thumbimageyDir);

            if(isset($_FILES['photoeditor_filename']['name']) && $_FILES['photoeditor_filename']['name'] != '') {
                try {
                    /* Starting upload */
                    $uploader = new Varien_File_Uploader('photoeditor_filename');

                    // Any extention would work
                    $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
                    $uploader->setAllowRenameFiles(false);

                    // Set the file upload mode
                    // false -> get the file directly in the specified folder
                    // true -> get the file in the product like folders
                    //	(file.jpg will go in something like /media/f/i/file.jpg)
                    $uploader->setFilesDispersion(false);

                    // We set media as the upload dir
                    //$path = Mage::getBaseDir('media') . DS ;
                    $path = $imageDir . DS ;
                    $result = $uploader->save($path, $_FILES['photoeditor_filename']['name'] );
                    ###############################################################################
                    // actual path of image
                    $imageUrl = Mage::getBaseDir('media').DS."photoeditorimages".DS.$_FILES['photoeditor_filename']['name'];

                    // path of the resized image to be saved
                    // here, the resized image is saved in media/resized folder
                    $imageResized = Mage::getBaseDir('media').DS."photoeditorimages".DS."thumbs".DS.$_FILES['photoeditor_filename']['name'];

                    // resize image only if the image file exists and the resized image file doesn't exist
                    // the image is resized proportionally with the width/height 135px
                    if (!file_exists($imageResized)&&file_exists($imageUrl)) :
                        $imageObj = new Varien_Image($imageUrl);
                        $imageObj->constrainOnly(TRUE);
                        $imageObj->keepAspectRatio(FALSE);
                        $imageObj->keepFrame(FALSE);
                        $imageObj->quality(100);
                        $imageObj->resize(80, 50);
                        $imageObj->save($imageResized);
                    endif;
                    #################################################################################




                    $data['photoeditor_filename'] = "photoeditorimages".DS.$result['file'];


                } catch (Exception $e) {
                    $data['photoeditor_filename'] = $_FILES['photoeditor_filename']['name'];

                }
            }

            $up_id     = $this->getRequest()->getParam('id');
            $up_model  = Mage::getModel('photoeditor/photoeditor')->load($up_id);


            $model = Mage::getModel('photoeditor/photoeditor');
            $model->setData($data)
                ->setFlagphotoeditor(1)
                ->setEditor_filename($up_model['editor_filename'])
                ->setId($this->getRequest()->getParam('id'));

            try {
                if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
                    $model->setCreatedTime(now())
                        ->setUpdateTime(now());
                } else {
                    $model->setUpdateTime(now());
                }

                //$model->setStores(implode(',',$data['stores']));
                /*if (isset($data['category_ids'])){
                    $model->setCategories(implode(',',array_unique(explode(',',$data['category_ids']))));
                }*/



                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('photoeditor')->__('Banner Image was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('editor')->__('Unable to save Banner Image'));
        $this->_redirect('*/*/');
    }

    public function deleteAction() {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $model = Mage::getModel('photoeditor/photoeditor');

                $model->setId($this->getRequest()->getParam('id'))
                    ->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction() {
        $platformIds = $this->getRequest()->getParam('photoeditor');
        if(!is_array($platformIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($platformIds as $platformId) {
                    $platform = Mage::getModel('photoeditor/photoeditor')->load($platformId);
                    $platform->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($platformIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    public function massStatusAction()
    {
        $platformIds = $this->getRequest()->getParam('photoeditor');
        if(!is_array($platformIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select item(s)'));
        } else {
            try {
                foreach ($platformIds as $platformId) {
                    $platform = Mage::getSingleton('photoeditor/photoeditor')
                        ->load($platformId)
                        ->setStatus($this->getRequest()->getParam('status'))
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) were successfully updated', count($platformIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    public function exportCsvAction()
    {
        $fileName   = 'photoeditor.csv';
        $content    = $this->getLayout()->createBlock('photoeditor/adminhtml_photoeditor_grid')
            ->getCsv();

        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'photoeditor.xml';
        $content    = $this->getLayout()->createBlock('photoeditor/adminhtml_photoeditor_grid')
            ->getXml();

        $this->_sendUploadResponse($fileName, $content);
    }

    protected function _sendUploadResponse($fileName, $content, $contentType='application/octet-stream')
    {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK','');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
        $response->setHeader('Content-Disposition', 'attachment; filename='.$fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Length', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
        die;
    }
}