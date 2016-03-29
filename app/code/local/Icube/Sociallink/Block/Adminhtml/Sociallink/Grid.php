<?php
 
class Icube_Sociallink_Block_Adminhtml_Sociallink_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('sociallink_grid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }
    
    protected function _getStore()
    {
        $storeId = (int) $this->getRequest()->getParam('store', 0);
        return Mage::app()->getStore($storeId);
    }
    
    protected function _prepareCollection()
    {
	    $collection = Mage::getModel('sociallink/sociallink')->getCollection()->addFieldToSelect('*');
         
        $this->setCollection($collection);
        parent::_prepareCollection();
        return $this;
	}
	
	protected function _prepareColumns()
    {
	    $this->addColumn('id',
            array(
                'header'=> Mage::helper('sociallink')->__('ID'),
                'width' => '50px',
                'type'  => 'number',
                'index' => 'id',
        ));
        
        $this->addColumn('sku',
            array(
                'header'=> Mage::helper('sociallink')->__('SKU'),
                'width' => '80px',
                'index' => 'sku',
        ));
        
        $this->addColumn('name',
            array(
                'header'=> Mage::helper('sociallink')->__('Name'),
                'width' => '120px',
                'index' => 'name',
        ));
        
        $this->addColumn('short_description',
            array(
                'header'=> Mage::helper('sociallink')->__('Short Description'),
                'index' => 'short_description',
        ));
        
        $this->addColumn('qty',
                array(
                    'header'=> Mage::helper('sociallink')->__('Qty'),
                    'width' => '100px',
                    'type'  => 'number',
                    'index' => 'qty',
        ));
        
		$store = $this->_getStore();
        $this->addColumn('sell_price',
            array(
                'header'=> Mage::helper('sociallink')->__('Sell Price'),
                'type'  => 'price',
                'currency_code' => $store->getBaseCurrency()->getCode(),
                'index' => 'sell_price',
        ));
        
        $this->addColumn('start_sell', array(
            'header' => Mage::helper('sociallink')->__('Start Sell'),
            'index' => 'start_sell',
            'type' => 'date',
            'width' => '100px',
        ));
        
        $this->addColumn('end_sell', array(
            'header' => Mage::helper('sociallink')->__('End Sell'),
            'index' => 'end_sell',
            'type' => 'date',
            'width' => '100px',
        ));
        
        return parent::_prepareColumns();

    }
    
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('sociallink_id');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'=> Mage::helper('sociallink')->__('Delete'),
             'url'  => $this->getUrl('*/*/massDelete'),
             'confirm' => Mage::helper('sociallink')->__('Are you sure?')
        ));
		
		$this->getMassactionBlock()->addItem('set_price', array(
             'label'=> Mage::helper('sociallink')->__('Set Sell Price'),
             'url'  => $this->getUrl('*/*/massSetSellPrice'),
             'additional'   => array(
                'set_sell_price'    => array(
                'name'     => 'set_sell_price',
                'type'     => 'text',
                'class'    => 'required-entry',
                'label'    => Mage::helper('sociallink')->__('Sell Price')
                )
            )
        ));
		
		$this->getMassactionBlock()->addItem('set_start_end', array(
		    'label'        => Mage::helper('sociallink')->__('Set Start/End Date'),
		    'url'          => $this->getUrl('*/*/massSetStartEndDate'),
		    'additional'   => array(
	        	'start_date'=> array(
	            'name'     	=> 'start_date',
	            'type'     	=> 'date',
	            'class'    	=> 'required-entry',
	            'label'    	=> Mage::helper('sociallink')->__('Start Sell'),
	            'gmtoffset' => true,
	            'image'    	=> '/skin/adminhtml/default/default/images/grid-cal.gif',
	            'format'    => '%d-%m-%Y'
		        ),
	        	'end_date'  => array(
	            'name'     	=> 'end_date',
	            'type'     	=> 'date',
	            'class'    	=> 'required-entry',
	            'label'    	=> Mage::helper('sociallink')->__('End Sell'),
	            'gmtoffset' => true,
	            'image'    	=> '/skin/adminhtml/default/default/images/grid-cal.gif',
	            'format'    => '%d-%m-%Y'
		        )
		    )
		));
		
        return $this;
    }
    
}