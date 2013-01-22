<?php

abstract class Aoe_LogViewer_Model_Command_Abstract extends Varien_Object {

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

	abstract function getInfo();

}