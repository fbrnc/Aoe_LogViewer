<?php

/**
 * Abstract log
 *
 * @author Fabrizio Branca
 * @since 2013-01-22
 */
abstract class Aoe_LogViewer_Model_Log_Abstract extends Varien_Object {

	/**
	 * @var Aoe_LogViewer_Model_Command_Collection
	 */
	protected $_commandCollection;

	/**
	 * Get command collection
	 *
	 * @return Aoe_LogViewer_Model_Command_Collection|false|Mage_Core_Model_Abstract
	 */
	public function getCommandCollection() {
		if (is_null($this->_commandCollection)) {
			$this->_commandCollection = Mage::getModel('aoe_logviewer/command_collection', array('log' => $this));
		}
		return $this->_commandCollection;
	}

	/**
	 * Check item. If this method returns false this log will not be added to the collection
	 *
	 * @return bool
	 */
	public function checkItem() {
		return true;
	}

}