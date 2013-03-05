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
 * StoreStatic
 *
 * @author Bo Thinggaard <bo@unpossiblesystems.dk>
 */
class StoreStatic implements StoreInterface {
	/** @var Data[] The data store. */
	private static $_dataStore = array();
	
	/**
	 * Get the next unused store index.
	 * 
	 * @return integer The next index.
	 */
	private static function _getNextIndex() {
		return max(array_keys(self::$_dataStore)) + 1;
	}
	
	/**
	 * Count stored records for query.
	 * 
	 * @param Query $query
	 * 
	 * @return integer
	 * 
	 * @throws StoreException
	 */
	public function count(Query $query) {
		
	}

	/**
	 * Delete a data object from store.
	 * 
	 * @param DataObjectInterface $dataObject
	 * 
	 * @throws StoreException
	 */
	public function delete(DataObjectInterface $dataObject) {
		unset(self::$_dataStore[$dataObject->getId()]);
	}

	/**
	 * Delete a collection of data objects from store.
	 * 
	 * @param DataObjectCollection $dataObjects
	 * 
	 * @throws StoreException
	 */
	public function deleteAll(DataObjectCollection $dataObjects) {
		foreach ($dataObjects as $dataObject) {
			$this->delete($dataObject);
		}
	}

	/**
	 * Get a single data object from query.
	 * 
	 * @param Query $query
	 * 
	 * @return DataObjectInterface|null
	 * 
	 * @throws StoreException
	 */
	public function get(Query $query) {
		
	}

	/**
	 * Get a collection of data objects from query.
	 * 
	 * @param Query $query
	 * 
	 * @return DataObjectCollection
	 * 
	 * @throws StoreException
	 */
	public function getAll(Query $query) {
		
	}

	/**
	 * Persist a single data object.
	 * 
	 * @param DataObjectInterface $dataObject
	 * 
	 * @throws StoreException
	 */
	public function persist(DataObjectInterface $dataObject) {
		if (!$dataObject->getId()) {
			$dataObject->setId(self::_getNextIndex());
		}
		self::$_dataStore[$dataObject->getId()] = $dataObject->toData();
	}

	/**
	 * Persist a collection of data objects.
	 * 
	 * @param DataObjectCollection $dataObjects
	 * 
	 * @throws StoreException
	 */
	public function persistAll(DataObjectCollection $dataObjects) {
		foreach ($dataObjects as $dataObject) {
			$this->persist($dataObject);
		}
	}
}