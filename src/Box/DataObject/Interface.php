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
 * DataObjectInterface
 *
 * @author Bo Thinggaard <bo@unpossiblesystems.dk>
 */
interface DataObjectInterface {
	
	/**
	 * Set the id.
	 * 
	 * @param integer $id|null
	 */
	public function setId($id);
	
	/**
	 * Get the id
	 * 
	 * @return integer|null
	 */
	public function getId();
	
	/**
	 * Turn this instance into a storable data package.
	 * 
	 * @return Data
	 */
	public function toData();
	
	/**
	 * Populate a new instance from data.
	 * 
	 * @param array &$data Data in key => value form.
	 * 
	 * @return static
	 */
	public static function fromData(array &$data);
}