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
	 * @param integer             $id
	 * @param DataObjectInterface $type
	 * 
	 * @return DataObjectInterface|null
	 * 
	 * @throws StoreException
	 */
	public function getById($id, DataObjectInterface $type);
	
	/**
	 * Get data packages from ids.
	 * 
	 * @param integer[]           $ids
	 * @param DataObjectInterface $type
	 * 
	 * @return DataObjectCollection
	 * 
	 * @throws StoreException
	 */
	public function getAllByIds(array $ids, DataObjectInterface $type);
}
