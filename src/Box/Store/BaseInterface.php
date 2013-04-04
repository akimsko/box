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
 * StoreBaseInterface
 *
 * @author Bo Thinggaard <bo@unpossiblesystems.dk>
 */
interface StoreBaseInterface {
	/**
	 * Persist a single data object.
	 * 
	 * @param DataObjectInterface $dataObject
	 * 
	 * @throws StoreException
	 */
	public function persist(DataObjectInterface $dataObject);
	
	/**
	 * Persist a collection of data objects.
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
	 * @return integer Number of deleted entries.
	 * 
	 * @throws StoreException
	 */
	public function delete(DataObjectInterface $dataObject);
	
	/**
	 * Delete a collection of data objects from store.
	 * 
	 * @param DataObjectCollection $dataObjects
	 * 
	 * @return integer Number of deleted entries.
	 * 
	 * @throws StoreException
	 */
	public function deleteAll(DataObjectCollection $dataObjects);
	
	/**
	 * Remove all records of the given type.
	 * 
	 * @param DataObjectInterface $type
	 * 
	 * @throws StoreException
	 */
	public function truncate(DataObjectInterface $type);
}