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
 * StoreDataInterface
 *
 * @author Bo Thinggaard <bo@unpossiblesystems.dk>
 */
interface StoreDataInterface {
	/**
	 * Get a data package from id.
	 * 
	 * @param integer $id
	 * 
	 * @return array
	 * 
	 * @throws StoreException
	 */
	public function get($id);
	
	/**
	 * Get data packages from ids.
	 * 
	 * @param integer[] $ids
	 * 
	 * @return array[]
	 * 
	 * @throws StoreException
	 */
	public function getAll(array $ids);
	
	/**
	 * Persist a data object.
	 *
	 * @param DataObjectInterface $dataObject
	 *
	 * @throws StoreException
	 */
	public function persist(DataObjectInterface $dataObject);
	
	/**
	 * Persist a data object collection.
	 *
	 * @param DataObjectCollection $dataObjects
	 *
	 * @throws StoreException
	 */
	public function persistAll(DataObjectCollection $dataObjects);
	
	/**
	 * Delete a data object from store.
	 * 
	 * @param DataObjectInterface $dataObject
	 * 
	 * @throws StoreException
	 */
	public function delete(DataObjectInterface $dataObject);
	
	/**
	 * Delete a collection of data objects from store.
	 * 
	 * @param DataObjectCollection $dataObjects
	 * 
	 * @throws StoreException
	 */
	public function deleteAll(DataObjectCollection $dataObjects);
}
