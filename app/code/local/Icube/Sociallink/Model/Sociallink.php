<?php
class Icube_Sociallink_Model_Sociallink extends Mage_Core_Model_Abstract
{   
    public function _construct()
    {
        parent::_construct();
        $this->_init('sociallink/sociallink');
    }     
}
