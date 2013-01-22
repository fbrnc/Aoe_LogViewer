<?php

abstract class Aoe_LogViewer_Model_Log_Abstract extends Varien_Object {

	protected $_commandCollection;

	public function getCommandCollection() {
		if (is_null($this->_commandCollection)) {
			$this->_commandCollection = Mage::getModel('aoe_logviewer/command_collection', array('log' => $this));
		}
		return $this->_commandCollection;
	}

}