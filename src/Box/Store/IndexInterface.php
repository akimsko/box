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
class StoreIndexInterface {
	/**
	 * Find a single id from query.
	 * 
	 * @return integer|null
	 * 
	 * @throws StoreException
	 */
	public function find(Query $query);
	
	/**
	 * Find ids from query.
	 * 
	 * @return integer[]
	 * 
	 * @throws StoreException
	 */
	public function findAll(Query $query);
	
	/**
	 * Index a data object.
	 * 
	 * @throws StoreException
	 */
	public function index(DataObjectInterface $dataObject);
	
	/**
	 * Index a data object collection.
	 * 
	 * @throws StoreException
	 */
	public function indexAll(DataObjectCollection $dataObjects);
	
	/**
	 * Count entries for query.
	 * 
	 * @return integer
	 * 
	 * @throws StoreException
	 */
	public function count(Query $query);
}
