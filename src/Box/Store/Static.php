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
	/** @var (Data[])[] The data store. */
	private static $_dataStore = array();
	
	/**
	 * Get the native token translator.
	 * 
	 * @return TokenNativeStoreStatic
	 */
	private static function _getTranslator() {
		static $translator;
		return $translator ? $translator : $translator = new TokenNativeStoreStatic();
	}


	/**
	 * Get the next unused store index.
	 * 
	 * @param string $namespace
	 * 
	 * @return integer The next index.
	 */
	private static function _getNextIndex($namespace) {
		if (!self::_getStore($namespace)) {
			return 1;
		}
		return max(array_keys(self::_getStore($namespace))) + 1;
	}
	
	/**
	 * Get the namespaced store.
	 * 
	 * @param string $namespace
	 *
	 * @return Data[]
	 */
	private static function &_getStore($namespace) {
		if (!isset(self::$_dataStore[$namespace])) {
			self::$_dataStore[$namespace] = array();
		}
		return self::$_dataStore[$namespace];
	}
	
	/**
	 * Count stored records for query.
	 * 
	 * @param QueryBase $query
	 * 
	 * @return integer
	 * 
	 * @throws StoreException
	 */
	public function count(QueryBase $query) {
		return count($this->_createResultSet($query));
	}

	/**
	 * Delete a data object from store.
	 * 
	 * @param DataObjectInterface $dataObject
	 * 
	 * @return integer Number of deleted entries.
	 * 
	 * @throws StoreException
	 */
	public function delete(DataObjectInterface $dataObject) {
		$store = &self::_getStore(get_class($dataObject));
		if (!array_key_exists($dataObject->getId(), $store)) {
			return 0;
		}
		unset($store[$dataObject->getId()]);
		return 1;
	}

	/**
	 * Delete a collection of data objects from store.
	 * 
	 * @param DataObjectCollection $dataObjects
	 * 
	 * @return integer Number of deleted entries.
	 * 
	 * @throws StoreException
	 */
	public function deleteAll(DataObjectCollection $dataObjects) {
		$count = 0;
		foreach ($dataObjects as $dataObject) {
			$count += $this->delete($dataObject);
		}
		return $count;
	}

	/**
	 * Inflate a data object from row.
	 * 
	 * @param array               $row
	 * @param DataObjectInterface $type
	 * 
	 * @return DataObjectInterface
	 * 
	 * @throws StoreException
	 */
	private function _inflate($row, DataObjectInterface $type) {
		if (!isset($row['id'])) {
			throw new StoreException('No id column could be found for ' . get_class($type) . '.');
		}
		
		$item = $type::fromData($row);
		$item->setId($row['id']);
		
		return $item;
	}
	
	/**
	 * Get a single data object from query.
	 * 
	 * @param QueryBase $query
	 * 
	 * @return DataObjectInterface|null
	 * 
	 * @throws StoreException
	 */
	public function get(QueryBase $query) {
		$results = $this->_createResultSet($query);
		$results = self::_applyOrderAndLimit($query->getToken(), $results);
		return ($result = array_shift($results)) ? $this->_inflate($result->toArrayCopy(), $query->getToken()->instance) : null;
	}
	
	/**
	 * Get a collection of data objects from query.
	 * 
	 * @param QueryBase $query
	 * 
	 * @return DataObjectCollection
	 * 
	 * @throws StoreException
	 */
	public function getAll(QueryBase $query) {
		$datas   = new DataObjectCollection($query->getToken()->instance);
		$results = $this->_createResultSet($query);
		
		foreach (self::_applyOrderAndLimit($query->getToken(), $results) as $result) {
			$datas->add($this->_inflate($result->toArrayCopy(), $query->getToken()->instance));
		}
		return $datas;
	}
	
	/**
	 * Create a result set.
	 *
	 * @param QueryBase $query
	 * 
	 * @return Data[]
	 * 
	 * @throws StoreException
	 */
	private function _createResultSet(QueryBase $query) {
		try {
			$token = $query->getToken();
		} catch (QueryException $qe) {
			throw new StoreException('Couldnt get token.', 0, $qe);
		}
		$expression = $token->buildNative(self::_getTranslator()) . ';';
		$result = array_filter(self::_getStore(get_class($token->instance)), function($i) use ($expression) {
			return eval($expression);
		});
		
		return $result === null ? array() : array_values($result);
	}

	/**
	 * Persist a single data object.
	 * 
	 * @param DataObjectInterface $dataObject
	 */
	public function persist(DataObjectInterface $dataObject) {
		$namespace = get_class($dataObject);
		
		if (!$dataObject->getId()) {
			$dataObject->setId(self::_getNextIndex($namespace));
		}

		$store = &self::_getStore($namespace);
		$data = $dataObject->toData();
		$data['id'] = $dataObject->getId();
		$store[$dataObject->getId()] = $data;
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
	
	/**
	 * Remove all records of the given type.
	 * 
	 * @param DataObjectInterface $type
	 */
	public function truncate(DataObjectInterface $type) {
		$namespace = get_class($type);
		unset(self::$_dataStore[$namespace]);
	}
	
	/**
	 * Retrofit orderBy and limit.
	 * 
	 * @param TokenRoot $token  The root token.
	 * @param array     $result The result to apply order and limit to.
	 * 
	 * @return type The ordered and limited array.
	 */
	private static function _applyOrderAndLimit(TokenRoot $token, array &$result) {
		$limit       = null;
		$offset      = null;
		$sortFields  = array();
		
		do {
			switch (true) {
				case $token instanceof TokenOrderBy:
					$sortFields[] = array(
						'name'      => $token->property,
						'direction' => ($token->direction == QueryLimitOrOrderBy::ASC) ? SORT_ASC : SORT_DESC
					);
					break;
				case $token instanceof TokenLimit:
					$limit = $token->limit;
					break;
				case $token instanceof TokenOffset:
					$offset = $token->offset;
					break;
			}
		} while ($token = $token->nextToken);
		
		if ($sortFields) {
			$result = self::_multiSort($result, $sortFields);
		}
		
		if ($offset !== null) {
			$result = array_slice($result, $offset, $limit);
		} else if ($limit !== null) {
			$result = array_slice($result, 0, $limit);
		}
		
		return $result;
	}
	
	/**
	 * Sort an array by multiple fields.
	 * 
	 * Apologies for this. Php's array_multisort is really awkward.
	 * This will do for now. Maybe someone can cook up something better? :)
	 * 
	 * @param array $array  The array to sort.
	 * @param array $fields The fields to sort by (array of array('name' => 'fieldName1', 'direction' => SORT_ASC|SORT_DESC))
	 * 
	 * @return array The sorted array.
	 */
	private static function _multiSort(array &$array, array $fields) {
		$sortColumns   = array();
		$sortArguments = array();
		$i = 0;
		foreach ($array as &$entry) {
			foreach ($fields as &$field) {
				if (!isset($sortColumns[$field['name']])) {
					$sortColumns[$field['name']] = array();
					$sortArguments[] = &$sortColumns[$field['name']];
					$sortArguments[] = $field['direction'];
				}
				$sortColumns[$field['name']][$i . '_'] = $entry[$field['name']];
			}
			$i++;
		}

		$sortedResult = array();
		
		if ($sortArguments) {
			call_user_func_array('array_multisort', $sortArguments);
			foreach (array_keys(array_shift($sortColumns)) as $sortedKey) {
				$sortedResult[] = $array[(int)$sortedKey];
			}
		}
		
		return $sortedResult;
	}
}