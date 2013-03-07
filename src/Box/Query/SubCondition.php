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
class QuerySubCondition extends QueryBase implements QueryInterfaceCondition {
	/** @var QueryAggregateCondition */
	private $_aggregate;

	/**
	 * hello - use ::create
	 */
	final private function __construct() {
		$this->_aggregate = new QueryAggregateCondition();
		$this->_root = $this;
	}

	/**
	 * Create a new sub query.
	 *
	 * @return QuerySubCondition
	 */
	public static function create() {
		return new self();
	}

	/**
	 * Get the first token in the chain this sub query condition translates to.
	 *
	 * @return TokenRoot;
	 */
	public function getToken() {
		return $this->_getToken();
	}

	/**
	 * Set the condition that a string property must contain the given substring.
	 *
	 * @param string  $property      The property you want to set a condition on.
	 * @param string  $value         The string you want that property to contain.
	 * @param boolean $caseSensitive
	 *
	 * @return QueryOperation
	 */
	public function contains($property, $value, $caseSensitive = false) {
		$this->_token = $this->_aggregate->contains($property, $value, $caseSensitive);

		$this->_child = new QueryOperation();
		$this->_child->_root = $this->_root;
		return $this->_child;
	}

	/**
	 * Set the condition that a string property must end with the given substring.
	 *
	 * @param string  $property      The property you want to set a condition on.
	 * @param string  $value         The string you want that property to end with.
	 * @param boolean $caseSensitive
	 *
	 * @return QueryOperation
	 */
	public function endsWith($property, $value, $caseSensitive = false) {
		$this->_token = $this->_aggregate->endsWith($property, $value, $caseSensitive);

		$this->_child = new QueryOperation();
		$this->_child->_root = $this->_root;
		return $this->_child;
	}

	/**
	 * Set the condition that a string property must start with the given substring.
	 *
	 * @param string  $property      The property you want to set a condition on.
	 * @param string  $value         The string you want that property to start with.
	 * @param boolean $caseSensitive
	 *
	 * @return QueryOperation
	 */
	public function startsWith($property, $value, $caseSensitive = false) {
		$this->_token = $this->_aggregate->startsWith($property, $value, $caseSensitive);

		$this->_child = new QueryOperation();
		$this->_child->_root = $this->_root;
		return $this->_child;
	}

	/**
	 * Set the condition that a property must have a given value.
	 *
	 * @param string                                                                 $property The property you want to set a condition on.
	 * @param string|float|boolean|integer|string[]|float[]|boolean[]|integer[]|null $value    The value the property should have to satisfy the condition.
	 *
	 * @return QueryOperation
	 */
	public function equals($property, $value) {
		$this->_token = $this->_aggregate->equals($property, $value);

		$this->_child = new QueryOperation();
		$this->_child->_root = $this->_root;
		return $this->_child;
	}

	/**
	 * Set the condition that a property must not have a given value.
	 *
	 * @param string                                                                 $property The property you want to set a condition on.
	 * @param string|float|boolean|integer|string[]|float[]|boolean[]|integer[]|null $value    The value the property should not have to satisfy the condition.
	 *
	 * @return QueryOperation
	 */
	public function notEquals($property, $value) {
		$this->_token = $this->_aggregate->notEquals($property, $value);

		$this->_child = new QueryOperation();
		$this->_child->_root = $this->_root;
		return $this->_child;
	}

	/**
	 * Set the condition that a numerical property must be greater than a given value.
	 *
	 * @param string        $property The property you want to set a condition on.
	 * @param float|integer $value    The value the property should be greater than to satisfy the condition.
	 *
	 * @return QueryOperation
	 */
	public function greaterThan($property, $value) {
		$this->_token = $this->_aggregate->greaterThan($property, $value);

		$this->_child = new QueryOperation();
		$this->_child->_root = $this->_root;
		return $this->_child;
	}

	/**
	 * Set the condition that a numerical property must be greater than or equal to a given value.
	 *
	 * @param string        $property The property you want to set a condition on.
	 * @param float|integer $value    The value the property should be greater than or equal to to satisfy the condition.
	 *
	 * @return QueryOperation
	 */
	public function greaterThanOrEquals($property, $value) {
		$this->_token = $this->_aggregate->greaterThanOrEquals($property, $value);

		$this->_child = new QueryOperation();
		$this->_child->_root = $this->_root;
		return $this->_child;
	}

	/**
	 * Set the condition that a numerical property must be greater than a given value.
	 *
	 * @param string        $property The property you want to set a condition on.
	 * @param float|integer $value    The value the property should be less than to satisfy the condition.
	 *
	 * @return QueryOperation
	 */
	public function lessThan($property, $value) {
		$this->_token = $this->_aggregate->lessThan($property, $value);

		$this->_child = new QueryOperation();
		$this->_child->_root = $this->_root;
		return $this->_child;
	}

	/**
	 * Set the condition that a numerical property must be greater than or equal to a given value.
	 *
	 * @param string        $property The property you want to set a condition on.
	 * @param float|integer $value    The value the property should be less than or equal to to satisfy the condition.
	 *
	 * @return QueryOperation
	 */
	public function lessThanOrEquals($property, $value) {
		$this->_token = $this->_aggregate->lessThanOrEquals($property, $value);

		$this->_child = new QueryOperation();
		$this->_child->_root = $this->_root;
		return $this->_child;
	}

	/**
	 * Set the condition that a property must be equal to any value in a given set.
	 *
	 * @param string                               $property The property you want to set a condition on.
	 * @param string[]|float[]|boolean[]|integer[] $value    The values the property should be equal to any of to satisfy the condition.
	 *
	 * @return QueryOperation
	 */
	public function in($property, $value) {
		$this->_token = $this->_aggregate->in($property, $value);

		$this->_child = new QueryOperation();
		$this->_child->_root = $this->_root;
		return $this->_child;
	}

	/**
	 * Set the condition that a property must not be equal to any value in a given set.
	 *
	 * @param string                               $property The property you want to set a condition on.
	 * @param string[]|float[]|boolean[]|integer[] $value    The values the property should not be equal to any of to satisfy the condition.
	 *
	 * @return QueryOperation
	 */
	public function notIn($property, $value) {
		$this->_token = $this->_aggregate->notIn($property, $value);

		$this->_child = new QueryOperation();
		$this->_child->_root = $this->_root;
		return $this->_child;
	}
}
