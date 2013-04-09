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
 * StoreDataMysql
 *
 * @author Bo Thinggaard
 */
class StoreDataMysql implements StoreDataInterface {
	
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
	 * Delete a data object from store.
	 * 
	 * @param DataObjectInterface $dataObject
	 * 
	 * @return integer Number of deleted entries.
	 * 
	 * @throws StoreException
	 */
	public function delete(DataObjectInterface $dataObject) {
		$table = TokenNativeMysql::getTableName($dataObject);
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
		$table = TokenNativeMysql::getTableName($dataObjects->getType());
		$in    = implode(',', $dataObjects->getIds());
		
		$statement = $this->_pdo->prepare("DELETE FROM `{$table}` WHERE `id` IN ({$in})");
		
		if (!$statement->execute()) {
			throw new StoreException('Data store returned an error: ' . implode(', ', $statement->errorInfo()));
		}
		
		return $statement->rowCount();
	}

	/**
	 * Get data packages from ids, maintaining order.
	 * 
	 * @param integer[]           $ids
	 * @param DataObjectInterface $type
	 * 
	 * @return DataObjectCollection
	 * 
	 * @throws StoreException
	 */
	public function getAllByIds(array $ids, DataObjectInterface $type) {
		$table = TokenNativeMysql::getTableName($type);
		$in    = implode(',', $ids);
		
		$statement = $this->_pdo->prepare("SELECT * FROM `{$table}` WHERE `id` IN ({$in})");
		
		if (!$statement->execute()) {
			throw new StoreException('Data store returned an error: ' . implode(', ', $statement->errorInfo()));
		}
		
		$rows = array();
		while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
			$rows[$row['id']] = json_decode($row['data'], true);
		}
		
		$collection = new DataObjectCollection($type);
		foreach ($ids as $id) {
			if (isset($row[$id])) {
				$item = $type::fromData($row[$id]);
				$item->setId($id);
				$collection->add($item);
			}
		}
		
		return $collection;
	}

	/**
	 * Get a data package from id.
	 * 
	 * @param integer             $id
	 * @param DataObjectInterface $type
	 * 
	 * @return DataObjectInterface|null
	 * 
	 * @throws StoreException
	 */
	public function getById($id, DataObjectInterface $type) {
		$table = TokenNativeMysql::getTableName($type);
		
		$statement = $this->_pdo->prepare("DELETE FROM `{$table}` WHERE `id` = :id");
		
		if (!$statement->execute(array('id' => $id))) {
			throw new StoreException('Data store returned an error: ' . implode(', ', $statement->errorInfo()));
		}
		
		$result = null;
		if ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
			$data = json_decode($row['data'], true);
			$result = $type::fromData($data);
			$result->setId($row['id']);
		}
		
		return $result;
	}

	/**
	 * Persist a collection of data objects.
	 * 
	 * @param DataObjectCollection $dataObjects
	 * 
	 * @throws StoreException
	 */
	public function persist(DataObjectInterface $dataObject) {
		$table = TokenNativeMysql::getTableName($dataObject);
		
		if ($dataObject->getId()) {
			$statement = $this->_pdo->prepare("REPLACE INTO `{$table}` SET `id` = :id, `data` = :data");
			if (!$statement->execute(array('id' => $id, 'data' => json_encode($dataObject->toData())))) {
				throw new StoreException('Data store returned an error: ' . implode(', ', $statement->errorInfo()));
			}
		} else {
			$statement = $this->_pdo->prepare("INSERT INTO `{$table}` SET `data` = :data");
			if (!$statement->execute(array('data' => json_encode($dataObject->toData())))) {
				throw new StoreException('Data store returned an error: ' . implode(', ', $statement->errorInfo()));
			}
			$dataObject->setId($this->_pdo->lastInsertId());
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
	public function persistAll(DataObjectCollection $dataObjects) {
		foreach ($dataObjects as $dataObject) {
			$this->persist($dataObject);
		}
	}

	/**
	 * Remove all records of the given type.
	 * 
	 * @param DataObjectInterface $type
	 * 
	 * @throws StoreException
	 */
	public function truncate(DataObjectInterface $type) {
		$table = TokenNativeMysql::getTableName($type);
		$statement = $this->_pdo->prepare("TRUNCATE TABLE `{$table}`");
		if (!$statement->execute()) {
			throw new StoreException('Data store returned an error: ' . implode(', ', $statement->errorInfo()));
		}
	}
}
