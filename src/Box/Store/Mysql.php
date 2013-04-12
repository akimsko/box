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
 * StoreMysql
 *
 * @author Bo Thinggaard
 */
class StoreMysql implements StoreInterface {
	
	/** @var \PDO Database connection. */
	private $_pdo;
	
	/**
	 * Constructor.
	 * 
	 * @param \PDO $pdo Database connection.
	 */
	public function __construct(\PDO $pdo) {
		$this->_pdo = $pdo;
	}
	
	/**
	 * Get the native token translator.
	 * 
	 * @return TokenNativeStoreStatic
	 */
	private static function _getTranslator() {
		static $translator;
		return $translator ? $translator : $translator = new TokenNativeMysql();
	}
	
	/**
	 * Fetch from query.
	 *
	 * @param QueryBase $query
	 * 
	 * @return \PDOStatement
	 * 
	 * @throws StoreException
	 */
	private function _fetch(QueryBase $query) {
		try {
			$token = $query->getToken();
		} catch (QueryException $qe) {
			throw new StoreException('Couldnt get token.', 0, $qe);
		}

		$statement = $this->_pdo->prepare($token->buildNative(self::_getTranslator()));
		
		if (!$statement->execute()) {
			throw new StoreException('Data store returned an error: ' . implode(', ', $statement->errorInfo()));
		}

		return $statement;
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
			throw new StoreException('No id column could be found for ' . TokenNativeMysql::getTableName($type) . '.');
		}
		
		foreach ($row as $field => $value) {
			if (is_string($value) && substr($value, 0, 1) == '[' && substr($value, strlen($value) - 1, 1) == ']') {
				$row[$field] = json_decode($value, true);
			}
		}
		
		$item = $type::fromData($row);
		$item->setId($row['id']);
		
		return $item;
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
		return $this->_fetch($query)->rowCount();
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
		if (!$row = $this->_fetch($query)->fetch(\PDO::FETCH_ASSOC)) {
			return null;
		}
		return $this->_inflate($row, $query->getToken()->instance);
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
		$statement  = $this->_fetch($query);
		$type       = $query->getToken()->instance;
		$collection = new DataObjectCollection($type);
		
		while($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
			$collection->add($this->_inflate($row, $type));
		}
		
		return $collection;
	}

	/**
	 * Persist a single data object.
	 * 
	 * @param DataObjectInterface $dataObject
	 * 
	 * @throws StoreException
	 */
	public function persist(DataObjectInterface $dataObject) {
		$table = TokenNativeMysql::getTableName($dataObject);
		
		$set    = array();
		$values = array();
		
		foreach ($dataObject->toData() as $field => $value) {
			$set[]    = "`$field` = ?";
			$values[] = is_array($value) ? json_encode($value) : $value;
		}
		$set = implode(', ', $set);
		
		if ($id = $dataObject->getId()) {
			$values[]  = $id;
			$statement = $this->_pdo->prepare("REPLACE INTO `{$table}` SET {$set}, `id` = ?");
			
			if (!$statement->execute($values)) {
				throw new StoreException('Data store returned an error: ' . implode(', ', $statement->errorInfo()));
			}
		} else {
			$statement = $this->_pdo->prepare("INSERT INTO `{$table}` SET {$set}");
			
			if (!$statement->execute($values)) {
				throw new StoreException('Data store returned an error: ' . implode(', ', $statement->errorInfo()));
			}
			$dataObject->setId($this->_pdo->lastInsertId());
		}
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
		$table     = TokenNativeMysql::getTableName($dataObject);
		$statement = $this->_pdo->prepare("DELETE FROM `{$table}` WHERE `id` = :id");
		
		if (!$statement->execute(array('id' => $dataObject->getId()))) {
			throw new StoreException('Data store returned an error: ' . implode(', ', $statement->errorInfo()));
		}
		
		return $statement->rowCount();
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
		if (!count($dataObjects)) {
			return 0;
		}
		
		$table     = TokenNativeMysql::getTableName($dataObjects->getType());
		$in        = implode(',', $dataObjects->getIds());
		$statement = $this->_pdo->prepare("DELETE FROM `{$table}` WHERE `id` IN ({$in})");
		
		if (!$statement->execute()) {
			throw new StoreException('Data store returned an error: ' . implode(', ', $statement->errorInfo()));
		}
		
		return $statement->rowCount();
	}
	
	/**
	 * Remove all records of the given type.
	 * 
	 * @param DataObjectInterface $type
	 * 
	 * @throws StoreException
	 */
	public function truncate(DataObjectInterface $type) {
		$table     = TokenNativeMysql::getTableName($type);
		$statement = $this->_pdo->prepare("TRUNCATE TABLE `{$table}`");
		if (!$statement->execute()) {
			throw new StoreException('Data store returned an error: ' . implode(', ', $statement->errorInfo()));
		}
	}
}
