<?php 

class Icube_Sociallink_Model_Observer 
{

    public function addMassAction(Varien_Event_Observer $observer)
    {
	    $block = $observer->getBlock();
	    
		if (!isset($block)) {
            return $this;
        }
        
      	$block->getMassactionBlock()->addItem('ready_for_pickup', array(
        'label'=> Mage::helper('icube_sociallink')->__('Set Status to Ready for Pickup'),
        'url'  => Mage::getUrl('sociallink/index/setReadyForPickup')
        ));
    }

}