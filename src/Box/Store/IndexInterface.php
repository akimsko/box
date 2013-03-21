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
 * StoreIndexInterface
 *
 * @author Bo Thinggaard <bo@unpossiblesystems.dk>
 */
interface StoreIndexInterface {
	/**
	 * Find a single id from query.
	 *
	 * @param Query $query
	 *
	 * @return integer|null
	 * 
	 * @throws StoreException
	 */
	public function find(Query $query);
	
	/**
	 * Find ids from query.
	 *
	 * @param Query $query
	 *
	 * @return integer[]
	 * 
	 * @throws StoreException
	 */
	public function findAll(Query $query);
	
	/**
	 * Index a data object.
	 *
	 * @param DataObjectInterface $dataObject
	 *
	 * @throws StoreException
	 */
	public function index(DataObjectInterface $dataObject);
	
	/**
	 * Index a data object collection.
	 *
	 * @param DataObjectCollection $dataObjects
	 *
	 * @throws StoreException
	 */
	public function indexAll(DataObjectCollection $dataObjects);
	
	/**
	 * Remove an index.
	 *
	 * @param DataObjectInterface $dataObject
	 *
	 * @throws StoreException
	 */
	public function remove(DataObjectInterface $dataObject);
	
	/**
	 * Remove indexes from collection.
	 *
	 * @param DataObjectCollection $dataObjects
	 *
	 * @throws StoreException
	 */
	public function removeAll(DataObjectCollection $dataObjects);
	
	/**
	 * Count entries for query.
	 *
	 * @param Query $query
	 *
	 * @return integer
	 * 
	 * @throws StoreException
	 */
	public function count(Query $query);
}
