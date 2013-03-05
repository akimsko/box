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
 * Query
 *
 * @author Jens Riisom Schultz <jens@unpossiblesystems.dk>
 */
class Query extends QueryLimitOrOrderBy implements QueryInterfaceCondition {
	private $_aggregate;

	private $_rootToken;

	/**
	 * Use ::create if you can find it. Otherwise this.
	 *
	 * @param DataObjectInterface $instance An instance of the class you want to get instances of, eventually.
	 */
	final public function __construct(DataObjectInterface $instance = null) {
		$this->_aggregate = new QueryAggregateCondition();

		$this->_rootToken = new TokenRoot();
		$this->_rootToken->instance = $instance;
	}

	/**
	 * Set the condition that the found objects should have a string property which starts with $value.
	 *
	 * @param string $property The property you want to set a condition on.
	 * @param string $value    The string you want that property to start with.
	 *
	 * @return QueryOperation
	 */
	public function startsWith($property, $value) {
		$this->_token = $this->_aggregate->startsWith($property, $value);

		return $this->_child = new QueryOperation();
	}

	/**
	 * @param string                       $property The property you want to set a condition on.
	 * @param string|float|boolean|integer $value    The string you want that property to start with.
	 *
	 * @return QueryOperation
	 */
	public function equals($property, $value) {
		$this->_token = $this->_aggregate->equals($property, $value);

		return $this->_child = new QueryOperation();
	}

	public function getToken() {
		$this->_rootToken->nextToken = $this->_getToken();

		return $this->_rootToken;
	}
}
