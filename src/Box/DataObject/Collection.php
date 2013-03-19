<?php

/*
 * This file is part of the Box project.
 * @link https://github.com/akimsko/box
 * 
 * @copyright Copyright 2013 Bo Thinggaard & Jens Riisom Schultz
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 */
namespace Box;
/**
 * DataObjectCollection
 *
 * @author Bo Thinggaard <bo@unpossiblesystems.dk>
 */
class DataObjectCollection implements \IteratorAggregate, \Countable {
	/** @var DataObjectInterface[] */
	private $_dataObjects = array();
	
	/**
	 * Constructor.
	 * 
	 * @param DataObjectInterface[] $dataObjects
	 */
	public function __construct(array $dataObjects = array()) {
		$this->addAll($dataObjects);
	}
	
	/**
	 * Get ids in this collection. Null ids will be left out.
	 * 
	 * @return integer[]
	 */
	public function getIds() {
		$function = function ($i) {
			return $i->getId();
		};
		return array_map($function, array_filter($this->_dataObjects, function($h) {
			return is_integer($h->getId());
		}));
	}
	
	/**
	 * Add a data object.
	 * 
	 * @param DataObjectInterface $dataObject
	 * 
	 * @return DataObjectCollection
	 */
	public function add(DataObjectInterface $dataObject) {
		$this->_dataObjects[] = $dataObject;
		return $this;
	}
	
	/**
	 * Add an array of data objects.
	 * 
	 * @param DataObjectInterface[] $dataObjects
	 * 
	 * @return DataObjectCollection
	 */
	public function addAll(array $dataObjects) {
		foreach ($dataObjects as $dataObject) {
			$this->add($dataObject);
		}
		return $this;
	}
	
	/**
	 * Get a data object.
	 * 
	 * @param integer $index
	 * 
	 * @return DataObjectInterface|null
	 */
	public function get($index) {
		return isset($this->_dataObjects[$index]) ? $this->_dataObjects[$index] : null;
	}
	
	/**
	 * Get all data objects.
	 * 
	 * @return DataObjectInterface[]
	 */
	public function getAll() {
		return $this->_dataObjects;
	}
	
	/**
	 * Get an iterator.
	 * 
	 * @return \ArrayIterator
	 */
	public function getIterator() {
		return new \ArrayIterator($this->_dataObjects);
	}

	/**
	 * Count data objects.
	 * 
	 * @return integer
	 */
	public function count() {
		return count($this->_dataObjects);
	}
}
