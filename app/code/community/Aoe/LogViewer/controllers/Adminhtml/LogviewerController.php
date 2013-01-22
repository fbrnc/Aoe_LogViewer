<?php

/**
 * Logviewer controller
 *
 * @author Fabrizio Branca
 * @since 2013-01-19
 */
class Aoe_LogViewer_Adminhtml_LogviewerController extends Mage_Adminhtml_Controller_Action {

	/**
	 * Index action
	 *
	 * @return void
	 */
	public function indexAction() {
		$this->loadLayout();
		$this->_setActiveMenu('system');
		$this->renderLayout();
	}

	public function setAction() {
		$log = $this->getRequest()->get('log');
		$command = $this->getRequest()->get('command');
		$this->_redirect('*/*/show', array(
			'log' => $log,
			'command' => $command
		));
	}

	public function showAction() {
		$this->loadLayout();
		$this->_setActiveMenu('system');

		// get log
		$logId = $this->getRequest()->get('log');
		$log = Mage::getModel('aoe_logviewer/log_collection')->getItemById($logId); /* @var $log Aoe_LogViewer_Model_Log_Abstract */
		if (is_null($log)) {
			Mage::throwException(sprintf('Could not find log with id "%s"', $logId));
		}

		// get command
		$commandId = $this->getRequest()->get('command');
		$command = $log->getCommandCollection()->getItemById($commandId); /* @var $command Aoe_LogViewer_Model_Command_Abstract */

		$this->getLayout()->getBlock('aoe_logviewer.logoutput')->setCommand($command);

		$this->getLayout()->getBlock('aoe_logviewer.menu')
			->setCurrentLogId($logId)
			->setCurrentCommandId($commandId);


		$this->renderLayout();
	}
}

