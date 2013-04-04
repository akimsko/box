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
interface StoreDataInterface extends StoreBaseInterface {
	/**
	 * Get a data package from id.
	 * 
	 * @param integer $id
	 * 
	 * @return array
	 * 
	 * @throws StoreException
	 */
	public function getById($id);
	
	/**
	 * Get data packages from ids.
	 * 
	 * @param integer[] $ids
	 * 
	 * @return array[]
	 * 
	 * @throws StoreException
	 */
	public function getAllByIds(array $ids);
}
