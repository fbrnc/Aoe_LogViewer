<?php

/**
 * Menu block
 *
 * @author Fabrizio Branca
 * @since 2013-01-22
 */
class Aoe_LogViewer_Block_Adminhtml_Menu extends Mage_Adminhtml_Block_Template {

	/**
	 * Get logs and commands as json
	 *
	 * @return string
	 */
	public function getLogJson() {
		$data = array();
		$logCollection = Mage::getModel('aoe_logviewer/log_collection'); /* @var $logCollection Aoe_LogViewer_Model_Log_Collection */
		foreach ($logCollection as $logId => $log) { /* @var $log Aoe_LogViewer_Model_Log_Abstract */
			$data[(string)$logId]['name'] = (string)$log->getLabel();
			$data[(string)$logId]['value'] = (string)$log->getId();
			foreach ($log->getCommandCollection() as $commandId => $command) { /* @var $command Aoe_LogViewer_Model_Command_Abstract */
				$data[(string)$logId]['commands'][(string)$commandId]['name'] = (string)$command->getLabel();
				$data[(string)$logId]['commands'][(string)$commandId]['value'] = (string)$command->getId();
			}
		}
		return json_encode($data);
	}

}