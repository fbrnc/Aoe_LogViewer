<?php

/**
 * Abstract collection used to load items from xml config
 *
 * @author Fabrizio Branca
 * @since 2013-01-22
 */
abstract class Aoe_LogViewer_Model_AbstractCollection extends Varien_Data_Collection {

	/**
	 * @var bool
	 */
	protected $_dataLoaded = false;

	/**
	 * Load the commands from config
	 *
	 * @param bool $printQuery
	 * @param bool $logQuery
	 * @return Varien_Data_Collection|void
	 */
	public function loadData($printQuery = false, $logQuery = false) {

		if ($this->_dataLoaded) {
			return $this;
		}

		$xmlConfiguration = Mage::getConfig()->getNode($this->getXmlPath()); /* @var $rulesConfiguration Mage_Core_Model_Config_Element */
		foreach ($xmlConfiguration->children() as $id => $node) { /* @var $node Mage_Core_Model_Config_Element */

			if ($node->disabled) {
				continue;
			}

			if (empty($node->model)) {
				Mage::throwException(sprintf('No model defined for node "%s"'), $id);
			}

			$item = Mage::getModel($node->model); /* @var $item Varien_Object */

			if (!$item) {
				Mage::throwException(sprintf('Error while creating model "%s"', $node->model));
			}
			if (!$item instanceof $this->_itemObjectClass) {
				Mage::throwException(sprintf('Model "%s" is not an instance of "%s".', $node->model, $this->_itemObjectClass));
			}

			$item->setId($id);
			foreach ($node as $field => $value) {
				$item->setDataUsingMethod($field, $value);
			}

			$this->preProcessItem($item);

			if ($this->checkItem($item)) {
				$this->addItem($item);
			}
		}
		uasort($this->_items, array($this, 'sortItems'));
		$this->_dataLoaded = true;
		return $this;
	}


	/**
	 * Callback to sort collection items according to ->setOrder
	 *
	 * @param Varien_Object $a
	 * @param Varien_Object $b
	 * @return int
	 */
	public function sortItems(Varien_Object $a, Varien_Object $b) {
		foreach ($this->_orders as $field => $direction) {
			$_a = $a->getData($field);
			$_b = $b->getData($field);
			$res = strnatcmp($_a, $_b);
			if ($res != 0) {
				if ($direction == Varien_Data_Collection::SORT_ORDER_DESC) {
					$res *= -1;
				}
				return $res;
			}
		}
		return 0;
	}

	/**
	 * Prevent this item from being added to the collection
	 * by return false.
	 *
	 * @param Varien_Object $item
	 * @return bool
	 */
	public function checkItem(Varien_Object $item) {
		return true;
	}

	/**
	 * Overwrite this method to do any pre-processing
	 *
	 * @param Varien_Object $item
	 */
	public function preProcessItem(Varien_Object $item) {
	}

	/**
	 * Get xml path for loading items from xml config
	 *
	 * @return string
	 */
	abstract public function getXmlPath();

}