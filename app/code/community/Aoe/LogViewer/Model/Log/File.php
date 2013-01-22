<?php

/**
 * File based logs
 *
 * @author Fabrizio Branca
 * @since 2013-01-22
 *
 * @method getFilePath
 */
class Aoe_LogViewer_Model_Log_File extends Aoe_LogViewer_Model_Log_Abstract {

	/**
	 * Set file path
	 *
	 * @param $filePath
	 * @return Aoe_LogViewer_Model_Log_File
	 */
	public function setFilePath($filePath) {
		$replace = array(
			'###LOGDIR###' => Mage::getBaseDir('log'),
			'###PHP_ERRORLOG###' => ini_get('error_log')
		);
		$filePath = str_replace(array_keys($replace), array_values($replace), $filePath);
		$this->setData('file_path', $filePath);
		return $this;
	}

	/**
	 * Check item. If this method returns false this log will not be added to the collection
	 *
	 * @return bool
	 */
	public function checkItem() {
		return is_file($this->getFilePath());
	}

}