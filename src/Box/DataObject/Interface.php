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
	 * Populate this instance or create a new populated instance from data.
	 * 
	 * @param array   $data Data in key => value form.
	 * @param boolean $new  Create a new instance.
	 * 
	 * @return static
	 */
	public function fromData(array $data, $new = true);
}