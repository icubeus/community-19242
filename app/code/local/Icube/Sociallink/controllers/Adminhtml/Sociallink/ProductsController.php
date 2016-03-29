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
    
    public function assignToSocialLinkAction()
    {
	    $data = array();
	    $channel = 'BBM';
        $productIds = $this->getRequest()->getParam('product');
        if (!is_array($productIds))
        {
            $this->_getSession()->addError($this->__('Please select product(s).'));
        }
        else if (!Mage::getModel('catalog/product')->isProductsHasSku($productIds)) 
        {
            $this->_getSession()->addError($this->__('Some of the processed products have no SKU value defined. Please fill it prior to performing operations on these products.'));
        }
        else {
            if (!empty($productIds)) {
                try {
                    foreach ($productIds as $productId) {
                        $product = Mage::getSingleton('catalog/product')->load($productId)->getData();
                        $data['sku'] = $product['sku'];
                        $data['name'] = $product['name'];
                        $data['short_description'] = $product['short_description'];
                        $data['description'] = $product['description'];
                        $data['product_url'] = $product['url_key'];
                        $data['sell_price'] = $product['price'];
                        $data['qty'] = $product['stock_item']['qty'];
                        $data['channel'] = $channel;
                        
                        // set Social link model data
                        $social = Mage::getSingleton('sociallink/sociallink')->setData($data);
                        $social->save();
                    }
                    $this->_getSession()->addSuccess(
                        $this->__('Total of %d product(s) have been saved.', count($productIds))
                    );
                } catch (Exception $e) {
                    $this->_getSession()->addError($e->getMessage());
                }
            }
        }
        $this->_redirect('*/catalog_product/', array('_current'=>true));
    }
    
    public function massDeleteAction()
    {
        $socialIds = $this->getRequest()->getParam('sociallink_id');
        if (!is_array($socialIds)) {
            $this->_getSession()->addError($this->__('Please select product(s).'));
        } else {
            if (!empty($socialIds)) {
                try {
                    foreach ($socialIds as $socialId) {
                        $product = Mage::getSingleton('sociallink/sociallink')->load($socialId);
                        $product->delete();
                    }
                    $this->_getSession()->addSuccess(
                        $this->__('Total of %d record(s) have been deleted.', count($socialIds))
                    );
                } catch (Exception $e) {
                    $this->_getSession()->addError($e->getMessage());
                }
            }
        }
        $this->_redirect('*/*/index');
    }
    
    public function massSetSellPriceAction()
    {
	    $socialIds = $this->getRequest()->getParam('sociallink_id');
	    $sellPrice = $this->getRequest()->getParam('set_sell_price');
        if (!is_array($socialIds)) {
            $this->_getSession()->addError($this->__('Please select product(s).'));
        } else {
            if (!empty($socialIds) && !empty($sellPrice)) {
                try {
                    foreach ($socialIds as $socialId) {
                        $product = Mage::getSingleton('sociallink/sociallink')->load($socialId);
                        $product->setSellPrice($sellPrice);
                        $product->save();
                    }
                    $this->_getSession()->addSuccess(
                        $this->__('Total of %d record(s) have been updated.', count($socialIds))
                    );
                } catch (Exception $e) {
                    $this->_getSession()->addError($e->getMessage());
                }
            }
        }
        $this->_redirect('*/*/index');
	        
    }
    
    public function massSetStartEndDateAction()
    {
	    $socialIds = $this->getRequest()->getParam('sociallink_id');
	    $startdate = $this->getRequest()->getParam('start_date');
	    $enddate = $this->getRequest()->getParam('end_date');
        if (!is_array($socialIds)) {
            $this->_getSession()->addError($this->__('Please select product(s).'));
        } else {
            if (!empty($socialIds) && !empty($startdate) && !empty($enddate)) {
                try {
                    foreach ($socialIds as $socialId) {
                        $product = Mage::getSingleton('sociallink/sociallink')->load($socialId);
                        $product->setStartSell($startdate);
                        $product->setEndSell($enddate);
                        $product->save();
                    }
                    $this->_getSession()->addSuccess(
                        $this->__('Total of %d record(s) have been updated.', count($socialIds))
                    );
                } catch (Exception $e) {
                    $this->_getSession()->addError($e->getMessage());
                }
            }
        }
        $this->_redirect('*/*/index');
	        
    }
    
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('catalog/sociallink');

    }
    
}