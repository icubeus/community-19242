<?php 

class Icube_Sociallink_Model_Observer 
{

    public function addMassAction(Varien_Event_Observer $observer)
    {
	    $block = $observer->getBlock();
	    
		if (!isset($block)) {
            return $this;
        }
        
      	$block->getMassactionBlock()->addItem('assign_to_sociallink', array(
        'label'=> Mage::helper('sociallink')->__('Assign to SocialLink'),
        'url'  => Mage::getUrl('*/sociallink_products/assignToSocialLink')
        ));
    }

}