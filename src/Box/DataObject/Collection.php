<?php

/*
 * This file is part of the Box project.
 * @link https://github.com/akimsko/box
 * 
 * @copyright Copyright 2013 Bo Thinggaard & Jens Riisom Schultz
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 */
namespace \Box;
/**
 * DataObjectCollection
 *
 * @author Bo Thinggaard <bo@unpossiblesystems.dk>
 */
class DataObjectCollection implements \IteratorAggregate {
	private $_dataObjects = array();
	
	/**
	 * Constructor.
	 * 
	 * @param DataObjectCollection $dataObjects Copy collection.
	 */
	public function __construct(DataObjectCollection $dataObjects = null) {
		if ($dataObjects) {
			$this->_dataObjects = $dataObjects->toArray();
		}
	}
	
	/**
	 * Get a copy as array.
	 * 
	 * @return DataObjectInterface[]
	 */
	public function toArray() {
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
}
