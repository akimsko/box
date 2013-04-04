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
interface StoreInterface extends StoreBaseInterface {
	/**
	 * Get a single data object from query.
	 * 
	 * @param QueryBase $query
	 * 
	 * @return DataObjectInterface|null
	 * 
	 * @throws StoreException
	 */
	public function get(QueryBase $query);
	
	/**
	 * Get a collection of data objects from query.
	 * 
	 * @param QueryBase $query
	 * 
	 * @return DataObjectCollection
	 * 
	 * @throws StoreException
	 */
	public function getAll(QueryBase $query);
	
	/**
	 * Count stored records for query.
	 * 
	 * @param QueryBase $query
	 * 
	 * @return integer
	 * 
	 * @throws StoreException
	 */
	public function count(QueryBase $query);
}