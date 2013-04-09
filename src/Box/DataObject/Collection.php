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
	
	/** @var DataObjectInterface Type this collection may contain. */
	private $_type;
	
	/**
	 * Constructor.
	 * 
	 * @param DataObjectInterface   $type        Type of data objects this collection may contain.
	 * @param DataObjectInterface[] $dataObjects
	 */
	public function __construct(DataObjectInterface $type, array $dataObjects = array()) {
		$this->_type = $type;
		$this->addAll($dataObjects);
	}
	
	/**
	 * Get the type of data objects this collection contains.
	 * 
	 * @return DataObjectInterface
	 */
	public function getType() {
		return $this->_type;
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
		if (!$dataObject instanceof $this->_type) {
			throw new Exception("Collection can only contain data objects of type {$this->_type}.");
		}
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
