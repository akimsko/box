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
 * StoreDataInterface
 *
 * @author Bo Thinggaard
 */
class StoreDataInterface {
	/**
	 * Get a data package from id.
	 * 
	 * @param integer $id
	 * 
	 * @return Data
	 * 
	 * @throws StoreException
	 */
	public function get($id);
	
	/**
	 * Get data packages from ids.
	 * 
	 * @param integer[] $ids
	 * 
	 * @return Data[]
	 * 
	 * @throws StoreException
	 */
	public function getAll($id);
	
	/**
	 * Persist a data object.
	 * 
	 * @throws StoreException
	 */
	public function persist(DataObjectInterface $dataObject);
	
	/**
	 * Persist a data object collection.
	 * 
	 * @throws StoreException
	 */
	public function persistAll(DataObjectCollection $dataObjects);
}
