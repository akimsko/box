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
		'integer' => 'integer',
		'string'  => 'string',
		'double'  => 'double',
		'boolean' => 'boolean',
		'NULL'    => 'NULL'
	);
	
	/**
	 * Constructor.
	 * 
	 * @param array $properties Initial properties in key => value form.
	 */
	public function __construct(array $properties = null) {
		if ($properties) {
			$this->putAll($properties);
		}
	}
	
	/**
	 * Get a copy of properties as array.
	 * 
	 * @return array
	 */
	public function toArrayCopy() {
		return $this->_properties;
	}
	
	
	/**
	 * Set a property by name.
	 * 
	 * @param string $name
	 * @param string|float|boolean|integer|string[]|float[]|boolean[]|integer[]|null $value
	 * 
	 * @throws \InvalidArgumentException
	 * 
	 * @return Data
	 */
	public function put($name, $value) {
		$this->_set($name, $value);
		return $this;
	}
	
	/**
	 * Set properties by array of key => values.
	 * 
	 * @param array $properties Properties in key => value form.
	 */
	public function putAll(array $properties) {
		foreach ($properties as $key => $value) {
			$this->offsetSet($key, $value);
		}
	}
	
	/**
	 * Remove (unset) a property.
	 * 
	 * @param string $name
	 * 
	 * @return Data
	 */
	public function remove($name) {
		unset($this->_properties[$name]);
		return $this;
	}
	
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
		
		if (!isset(self::$_types[$type])) {
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
		return isset(self::$_types[gettype($value)]);
	}
	
	/**
	 * Set a property.
	 * 
	 * @param string                                                                 &$name
	 * @param string|float|boolean|integer|string[]|float[]|boolean[]|integer[]|null &$value
	 * 
	 * @throws \InvalidArgumentException
	 */
	private function _set(&$name, &$value) {
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
	 * Check if property is set.
	 * 
	 * @param string $name
	 * 
	 * @return boolean Is set.
	 */
	public function __isset($name) {
		return isset($this->_properties[$name]);
	}
	
	/**
	 * Unset property.
	 * 
	 * @param string $name
	 */
	public function __unset($name) {
		unset($this->_properties[$name]);
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
