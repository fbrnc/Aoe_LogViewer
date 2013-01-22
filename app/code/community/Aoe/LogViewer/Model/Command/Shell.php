<?php

/**
 * @method setCommandString
 * @method getCommandString
 */
class Aoe_LogViewer_Model_Command_Shell extends Aoe_LogViewer_Model_Command_Abstract {

	/**
	 * Set log
	 *
	 * @param Aoe_LogViewer_Model_Log_Abstract $log
	 * @return Aoe_LogViewer_Model_Command_Shell
	 */
	public function setLog(Aoe_LogViewer_Model_Log_Abstract $log) {
		if (!$log instanceof Aoe_LogViewer_Model_Log_File) {
			Mage::throwException('Shell command only supports file log');
		}
		return parent::setLog($log);
	}

	/**
	 * Get log
	 *
	 * @return Aoe_LogViewer_Model_Log_File
	 */
	public function getLog() {
		return parent::getLog();
	}

	public function getInfo() {
		return $this->getFullCommandString();
	}

	public function getFullCommandString() {
		return sprintf($this->getCommandString(),
			escapeshellarg($this->getLog()->getFilePath()),
			30
		);
	}

	public function getPlainOutput() {
		$output = null;
		$returnVar = null;
		$command = $this->getFullCommandString();
		exec($command, $output, $returnVar);
		return implode("\n", $output);
	}


}