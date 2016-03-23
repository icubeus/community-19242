<?php
class Icube_Sociallink_Model_Resource_Sociallink_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{

	public function _construct()
	{
		parent::_construct();
		$this->_init('sociallink/sociallink');
	}

}