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
 * DataObjectInterface
 *
 * @author Bo Thinggaard <bo@unpossiblesystems.dk>
 */
interface DataObjectInterface {
	
	/**
	 * Set the id.
	 * 
	 * @param integer $id
	 */
	public function setId($id);
	
	/**
	 * Get the id
	 * 
	 * @return integer
	 */
	public function getId();
	
	/**
	 * Turn this instance into a storable data package.
	 * 
	 * @return Data
	 */
	public function toData();
	
	/**
	 * Create a new instance from data package.
	 * 
	 * @param Data $data
	 * 
	 * @return static
	 */
	public static function fromData(Data $data);
}