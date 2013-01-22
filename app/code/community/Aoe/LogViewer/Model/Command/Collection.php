<?php

/**
 * Command collection
 *
 * @author Fabrizio Branca
 * @since 2013-01-22
 */
class Aoe_LogViewer_Model_Command_Collection extends Aoe_LogViewer_Model_AbstractCollection {

	/**
	 * @var Aoe_LogViewer_Model_Log_Abstract
	 */
	protected $_log;

	/**
	 * Constructor
	 *
	 * @param array $params
	 */
	public function __construct(array $params) {
		$this->_log = $params['log'];
		if (!$this->_log instanceof Aoe_LogViewer_Model_Log_Abstract) {
			Mage::throwException("No valid log instance found.");
		}
		$this->setItemObjectClass('Aoe_LogViewer_Model_Command_Abstract');
		$this->setOrder('sort_order', Varien_Data_Collection::SORT_ORDER_ASC);
	}

	/**
	 * Check if a command should be skipped
	 *
	 * @param Varien_Object $item
	 * @return bool
	 */
	public function checkItem(Varien_Object $item) {
		if (!$item instanceof Aoe_LogViewer_Model_Command_Abstract) {
			return false;
		}
		return $item->checkItem();
	}

	/**
	 * Pre-process Items
	 *
	 * @param Varien_Object $item
	 * @return bool
	 */
	public function preProcessItem(Varien_Object $item) {
		/* @var $item Aoe_LogViewer_Model_Command_Abstract */
		$item->setLog($this->_log);
	}

	/**
	 * Get xml path
	 *
	 * @return string
	 */
	public function getXmlPath() {
		return 'global/aoe_logviewer/logs/'. $this->_log->getId() . '/commands';
	}

}