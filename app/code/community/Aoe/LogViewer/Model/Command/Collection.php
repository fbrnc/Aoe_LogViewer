<?php

class Aoe_LogViewer_Model_Command_Collection extends Aoe_LogViewer_Model_AbstractCollection {

	/**
	 * @var Aoe_LogViewer_Model_Log_Abstract
	 */
	protected $_log;

	public function __construct(array $params) {
		$this->_log = $params['log'];
		$this->setItemObjectClass('Aoe_LogViewer_Model_Command_Abstract');
		$this->setOrder('sort_order', Varien_Data_Collection::SORT_ORDER_ASC);
	}

	/**
	 * @param Varien_Object $item
	 * @return bool
	 */
	public function checkItem(Varien_Object $item) {
		$item->setLog($this->_log);
		return true;
	}

	public function getXmlPath() {
		return 'global/aoe_logviewer/logs/'. $this->_log->getId() . '/commands';
	}

}