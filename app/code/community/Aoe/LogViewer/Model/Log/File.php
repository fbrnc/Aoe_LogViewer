<?php

/**
 * @method getFilePath
 */
class Aoe_LogViewer_Model_Log_File extends Aoe_LogViewer_Model_Log_Abstract {

	public function setFilePath($filePath) {
		$replace = array(
			'###LOGDIR###' => Mage::getBaseDir('log'),
			'###PHP_ERRORLOG###' => ini_get('error_log')
		);

		$filePath = str_replace(array_keys($replace), array_values($replace), $filePath);
		$this->setData('file_path', $filePath);
		return $this;
	}

}