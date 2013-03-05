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
 * Data
 *
 * @author Bo Thinggaard <bo@unpossiblesystems.dk>
 */
class Data implements \ArrayAccess {
	
	/** @var array Property store. */
	private $_properties = array();
	
	/** @var array Valid types. */
	private static $_types = array(
		'integer',
		'string',
		'double',
		'boolean',
		'NULL'
	);
	
	/**
	 * Validate array.
	 * 
	 * @param string[]|float[]|boolean[]|integer[] $entries
	 * 
	 * @return boolean Is valid.
	 */
	private static function _isArrayValid(array &$entries) {
		if (!$entries) {
			return true;
		}
		
		$type = gettype($entries[0]);
		
		if (!in_array($type, self::$_types)) {
			return false;
		}
		
		foreach ($entries as &$entry) {
			if (gettype($entry) != $type) {
				return false;
			}
		}

		return true;
	}
	
	/**
	 * Validate value.
	 * 
	 * @param string|float|boolean|integer|string[]|float[]|boolean[]|integer[]|null $value
	 * 
	 * @return boolean Is valid.
	 */
	private static function _isValid(&$value) {
		if (is_array($value)) {
			return self::_isArrayValid($value);
		}
		
		return in_array(gettype($value), self::$_types);
		
	}
	
	/**
	 * Set a property.
	 * 
	 * @param string $name
	 * @param string|float|boolean|integer|string[]|float[]|boolean[]|integer[]|null $value
	 * 
	 * @throws \InvalidArgumentException
	 */
	private function _set($name, $value) {
		if ($name === null) {
			throw new \InvalidArgumentException('Property name may not be null.');
		}
		
		if (!self::_isValid($value)) {
			throw new \InvalidArgumentException(gettype($value) . ' is not a valid type for value.');
		}

		$this->_properties[$name] = $value;
	}

	/**
	 * Set a property by array access.
	 * 
	 * @param string $offset
	 * @param string|float|boolean|integer|string[]|float[]|boolean[]|integer[]|null $value
	 * 
	 * @throws \InvalidArgumentException
	 */
	public function offsetSet($offset, $value) {
		$this->_set($offset, $value);
	}

	/**
	 * Check if property exists.
	 * 
	 * @param string $offset
	 * 
	 * @return boolean Exists.
	 */
	public function offsetExists($offset) {
		return isset($this->_properties[$offset]);
	}

	/**
	 * Unset property by array access.
	 * 
	 * @param string $offset
	 */
	public function offsetUnset($offset) {
		unset($this->_properties[$offset]);
	}

	/**
	 * Get property by array access.
	 * 
	 * @param string $offset
	 * 
	 * @return string|float|boolean|integer|string[]|float[]|boolean[]|integer[]|null
	 */
	public function offsetGet($offset) {
		return isset($this->_properties[$offset]) ? $this->_properties[$offset] : null;
	}
	
	/**
	 * Get property by magic.
	 * 
	 * @param string $name
	 * 
	 * @return string|float|boolean|integer|string[]|float[]|boolean[]|integer[]|null
	 */
	public function __get($name) {
		return isset($this->_properties[$name]) ? $this->_properties[$name] : null;
	}
	
	/**
	 * Set a property by magic.
	 * 
	 * @param string $name
	 * @param string|float|boolean|integer|string[]|float[]|boolean[]|integer[]|null $value
	 * 
	 * @throws \InvalidArgumentException
	 */
	public function __set($name, $value) {
		$this->_set($name, $value);
	}
}
