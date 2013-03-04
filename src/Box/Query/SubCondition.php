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
 * Query
 *
 * @author Jens Riisom Schultz <jens@unpossiblesystems.dk>
 */
class QuerySubCondition implements QueryInterfaceCondition {
	private $_aggregate;

	/**
	 * hello
	 */
	final public function __construct() {
		$this->_aggregate = new QueryAggregateCondition();
	}

	/**
	 * Set the condition that the found objects should have a string property which starts with $value.
	 *
	 * @param string $property The property you want to set a condition on.
	 * @param string $value    The string you want that property to start with.
	 *
	 * @return QuerySubOperation
	 */
	public function startsWith($property, $value) {
		$this->_aggregate->startsWith($property, $value);
		return new QuerySubOperation();
	}

	/**
	 * @param string                       $property The property you want to set a condition on.
	 * @param string|float|boolean|integer $value    The string you want that property to start with.
	 *
	 * @return QuerySubOperation
	 */
	public function equals($property, $value) {
		$this->_aggregate->equals($property, $value);
		return new QuerySubOperation();
	}
}
