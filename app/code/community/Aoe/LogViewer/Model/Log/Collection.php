<?php

class Aoe_LogViewer_Model_Log_Collection extends Aoe_LogViewer_Model_AbstractCollection {

	public function __construct() {
		$this->setItemObjectClass('Aoe_LogViewer_Model_Log_Abstract');
		$this->setOrder('sort_order', Varien_Data_Collection::SORT_ORDER_ASC);
	}

	public function checkItem(Varien_Object $item) {
		return is_file($item->getFilePath());
	}

	public function getXmlPath() {
		return 'global/aoe_logviewer/logs';
	}
}