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
 * A simple static memory store.
 * 
 * This is meant for testing and prototyping only!
 *
 * @author Bo Thinggaard <bo@unpossiblesystems.dk>
 */
class StoreStatic implements StoreInterface {
	/** @var Data[] The data store. */
	private static $_dataStore = array();
	
	/** @var TokenNativeStoreStatic The native token translator. */
	private static $_translator;
	
	/**
	 * Get the native token translator.
	 * 
	 * @return TokenNativeStoreStatic
	 */
	private static function _getTranslator() {
		return self::$_translator ? self::$_translator : self::$_translator = new TokenNativeStoreStatic();
	}


	/**
	 * Get the next unused store index.
	 * 
	 * @return integer The next index.
	 */
	private static function _getNextIndex() {
		if (!self::$_dataStore) {
			return 1;
		}
		return max(array_keys(self::$_dataStore)) + 1;
	}
	
	public function dump() {
		var_dump(self::$_dataStore);
	}
	
	/**
	 * Count stored records for query.
	 * 
	 * @param QueryBase $query
	 * 
	 * @return integer
	 */
	public function count(QueryBase $query) {
		return count($this->_createResultSet($query));
	}

	/**
	 * Delete a data object from store.
	 * 
	 * @param DataObjectInterface $dataObject
	 */
	public function delete(DataObjectInterface $dataObject) {
		unset(self::$_dataStore[$dataObject->getId()]);
	}

	/**
	 * Delete a collection of data objects from store.
	 * 
	 * @param DataObjectCollection $dataObjects
	 */
	public function deleteAll(DataObjectCollection $dataObjects) {
		foreach ($dataObjects as $dataObject) {
			$this->delete($dataObject);
		}
	}

	/**
	 * Get a single data object from query.
	 * 
	 * @param QueryBase $query
	 * 
	 * @return DataObjectInterface|null
	 */
	public function get(QueryBase $query) {
		$items = $this->_createResultSet($query);
		if ($item = array_shift($items)) {
			$item = $item->toArrayCopy();
			$item = $query->getToken()->instance->fromData($item, false);
		}
		return $item;
	}
	
	/**
	 * Get a collection of data objects from query.
	 * 
	 * @param QueryBase $query
	 * 
	 * @return DataObjectCollection
	 */
	public function getAll(QueryBase $query) {
		$datas = new DataObjectCollection();
		foreach ($this->_createResultSet($query) as $item) {
			$item = $item->toArrayCopy();
			$datas->add($query->getToken()->instance->fromData($item));
		}
		return $datas;
	}
	
	/**
	 * 
	 * @param Query $query
	 * 
	 * @return Data[]
	 */
	private function _createResultSet(QueryBase $query) {
		$token = $query->getToken();
		
		$expression = $token->buildNative(self::_getTranslator()) . ';';
		
		$result = array_filter(self::$_dataStore, function($i) use ($expression) {
			return eval($expression);
		});
		
		return $result === null ? array() : $result;
	}

	/**
	 * Persist a single data object.
	 * 
	 * @param DataObjectInterface $dataObject
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
	 */
	public function persistAll(DataObjectCollection $dataObjects) {
		foreach ($dataObjects as $dataObject) {
			$this->persist($dataObject);
		}
	}
}