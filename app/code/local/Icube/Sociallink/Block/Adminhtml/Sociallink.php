<?php
 
class Icube_Sociallink_Block_Adminhtml_Sociallink extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'sociallink';
        $this->_controller = 'adminhtml_sociallink';
        $this->_headerText = Mage::helper('sociallink')->__('Manage Social Link Products');
 
        parent::__construct();
        $this->_removeButton('add');
        $this->_addButton('sync_sociallink', array(
            'label'     => Mage::helper('sociallink')->__('SYNC product to SocialLink'),
            //'onclick'   => 'jsfunction(this.id)',
            'class'     => 'go'
        ), 0, 100, 'header', 'header');
    }
}