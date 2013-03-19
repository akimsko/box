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
 * StoreInterface
 *
 * @author Bo Thinggaard <bo@unpossiblesystems.dk>
 */
interface StoreInterface {
	/**
	 * Get a single data object from query.
	 * 
	 * @param QueryInterface $query
	 * 
	 * @return DataObjectInterface|null
	 * 
	 * @throws StoreException
	 */
	public function get(QueryInterface $query);
	
	/**
	 * Get a collection of data objects from query.
	 * 
	 * @param QueryInterface $query
	 * 
	 * @return DataObjectCollection
	 * 
	 * @throws StoreException
	 */
	public function getAll(QueryInterface $query);
	
	/**
	 * Persist a single data object.
	 * 
	 * @param DataObjectInterface $dataObject
	 */
	public function persist(DataObjectInterface $dataObject);
	
	/**
	 * Persist a collection of data objects.
	 * 
	 * @param DataObjectCollection $dataObjects
	 */
	public function persistAll(DataObjectCollection $dataObjects);
	
	/**
	 * Delete a data object from store.
	 * 
	 * @param DataObjectInterface $dataObject
	 */
	public function delete(DataObjectInterface $dataObject);
	
	/**
	 * Delete a collection of data objects from store.
	 * 
	 * @param DataObjectCollection $dataObjects
	 */
	public function deleteAll(DataObjectCollection $dataObjects);
	
	/**
	 * Count stored records for query.
	 * 
	 * @param QueryInterface $query
	 * 
	 * @return integer
	 * 
	 * @throws StoreException
	 */
	public function count(QueryInterface $query);
}