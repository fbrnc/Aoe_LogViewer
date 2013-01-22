<?php

/**
 * Abstract command
 *
 * @author Fabrizio Branca
 * @since 2013-01-22
 */
abstract class Aoe_LogViewer_Model_Command_Abstract extends Varien_Object {

	/**
	 * Set log
	 *
	 * @param Aoe_LogViewer_Model_Log_Abstract $log
	 * @return Varien_Object
	 */
	public function setLog(Aoe_LogViewer_Model_Log_Abstract $log) {
		return $this->setData('log', $log);
	}

	/**
	 * Get plain output.
	 * Maybe later there will be another output method that returns an array of rows or other objects that parse
	 * the rows and contain more information on log type, date, message,...
	 *
	 * @return mixed
	 */
	abstract function getPlainOutput();

	/**
	 * Get info that is displayed along the log
	 *
	 * @return string
	 */
	abstract function getInfo();

	/**
	 * Check item. If this method returns false this log will not be added to the collection
	 *
	 * @return bool
	 */
	public function checkItem() {
		return true;
	}

}