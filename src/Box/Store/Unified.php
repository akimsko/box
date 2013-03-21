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
 * StoreUnified
 *
 * @author Bo Thinggaard <bo@unpossiblesystems.dk>
 */
class StoreUnified implements StoreInterface {
	
	/** @var StoreIndexInterface The indexing store. */
	private $_index;
	
	/** @var StoreDataInterface The data store. */
	private $_data;
	
	/**
	 * Constructor.
	 * 
	 * @param StoreIndexInterface $index
	 * @param StoreDataInterface $data
	 */
	public function __construct(StoreIndexInterface $index, StoreDataInterface $data) {
		$this->_index = $index;
		$this->_data = $data;
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
		return $this->_index->count($query);
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
		return ($id = $this->_index->find($query))
			? $query->getToken()->instance->fromData($this->_data->get($id), false)
			: null;
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
		$dataObjects = new DataObjectCollection();
		foreach ($this->_data->getAll($this->_index->findAll($query)) as $data) {
			$dataObjects->add($query->getToken()->instance->fromData($data, true));
		}
		return $dataObjects;
	}

	/**
	 * Persist a single data object.
	 * 
	 * @param DataObjectInterface $dataObject
	 * 
	 * @throws StoreException
	 */
	public function persist(DataObjectInterface $dataObject) {
		$this->_data->persist($dataObject);
		$this->_index->index($dataObject);
	}

	/**
	 * Persist a collection of data objects.
	 * 
	 * @param DataObjectCollection $dataObjects
	 * 
	 * @throws StoreException
	 */
	public function persistAll(DataObjectCollection $dataObjects) {
		$this->_data->persistAll($dataObjects);
		$this->_index->indexAll($dataObjects);
	}

	/**
	 * Delete a data object from store.
	 * 
	 * @param DataObjectInterface $dataObject
	 * 
	 * @throws StoreException
	 */
	public function delete(DataObjectInterface $dataObject) {
		$this->_index->remove($dataObject);
		$this->_data->delete($dataObject);
	}

	/**
	 * Delete a collection of data objects from store.
	 * 
	 * @param DataObjectCollection $dataObjects
	 * 
	 * @throws StoreException
	 */
	public function deleteAll(DataObjectCollection $dataObjects) {
		$this->_index->removeAll($dataObjects);
		$this->_data->deleteAll($dataObjects);
	}
}