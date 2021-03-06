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
interface StoreIndexInterface extends StoreBaseInterface {
	/**
	 * Find a single id from query.
	 *
	 * @param Query $query
	 *
	 * @return integer|null
	 * 
	 * @throws StoreException
	 */
	public function getId(Query $query);
	
	/**
	 * Find ids from query.
	 *
	 * @param Query $query
	 *
	 * @return integer[]
	 * 
	 * @throws StoreException
	 */
	public function getAllIds(Query $query);

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
