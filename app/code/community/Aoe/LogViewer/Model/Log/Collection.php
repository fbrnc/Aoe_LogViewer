<?php

/**
 * Log collection
 * 
 * @author Fabrizio Branca
 * @since 2013-01-22
 */
class Aoe_LogViewer_Model_Log_Collection extends Aoe_LogViewer_Model_AbstractCollection {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->setItemObjectClass('Aoe_LogViewer_Model_Log_Abstract');
		$this->setOrder('sort_order', Varien_Data_Collection::SORT_ORDER_ASC);
	}

	/**
	 * Check if a log should be skipped
	 *
	 * @param Varien_Object $item
	 * @return bool
	 */
	public function checkItem(Varien_Object $item) {
		if (!$item instanceof Aoe_LogViewer_Model_Log_Abstract) {
			return false;
		}
		return $item->checkItem();
	}

	/**
	 * Get xml path
	 *
	 * @return string
	 */
	public function getXmlPath() {
		return 'global/aoe_logviewer/logs';
	}
}