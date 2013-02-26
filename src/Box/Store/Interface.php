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
 * StoreInterface
 *
 * @author Bo Thinggaard
 */
interface StoreInterface {
	/**
	 * Get a single data object from query.
	 * 
	 * @param Query $query
	 * 
	 * @return DataObjectInterface|null
	 */
	public function get(Query $query);
	
	/**
	 * Get a collection of data objects from query.
	 * 
	 * @param Query $query
	 * 
	 * @return DataObjectCollection
	 */
	public function getAll(Query $query);
	
	/**
	 * Persist a single data object.
	 * 
	 * @param DataObjectInterface $dataObject
	 */
	public function persist(DataObjectInterface $dataObject);
}