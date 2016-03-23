<?php
 
class Icube_Sociallink_Adminhtml_Sociallink_ProductsController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Social Link'))->_title($this->__('Manage Products'));
        $this->loadLayout();
        $this->_setActiveMenu('catalog/sociallink');
        $this->_addContent($this->getLayout()->createBlock('sociallink/adminhtml_sociallink'));
        $this->renderLayout();
    }
    
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('catalog/sociallink');

    }
    
}