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
interface QueryInterfaceCondition {
	/**
	 * Set the condition that a string property must contain the given substring.
	 *
	 * @param string  $property       The property you want to set a condition on.
	 * @param string  $value          The string you want that property to contain.
	 * @param boolean $caseSensitive
	 */
	public function contains($property, $value, $caseSensitive = false);

	/**
	 * Set the condition that a string property must end with the given substring.
	 *
	 * @param string  $property      The property you want to set a condition on.
	 * @param string  $value         The string you want that property to end with.
	 * @param boolean $caseSensitive
	 */
	public function endsWith($property, $value, $caseSensitive = false);

	/**
	 * Set the condition that a string property must start with the given substring.
	 *
	 * @param string  $property      The property you want to set a condition on.
	 * @param string  $value         The string you want that property to start with.
	 * @param boolean $caseSensitive
	 * 
	 */
	public function startsWith($property, $value, $caseSensitive = false);

	/**
	 * Set the condition that a property must have a given value.
	 *
	 * @param string                                                                 $property The property you want to set a condition on.
	 * @param string|float|boolean|integer|string[]|float[]|boolean[]|integer[]|null $value    The value the property should have to satisfy the condition.
	 */
	public function equals($property, $value);

	/**
	 * Set the condition that a property must not have a given value.
	 *
	 * @param string                                                                 $property The property you want to set a condition on.
	 * @param string|float|boolean|integer|string[]|float[]|boolean[]|integer[]|null $value    The value the property should not have to satisfy the condition.
	 */
	public function notEquals($property, $value);

	/**
	 * Set the condition that a numerical property must be greater than a given value.
	 *
	 * @param string        $property The property you want to set a condition on.
	 * @param float|integer $value    The value the property should be greater than to satisfy the condition.
	 */
	public function greaterThan($property, $value);

	/**
	 * Set the condition that a numerical property must be greater than or equal to a given value.
	 *
	 * @param string        $property The property you want to set a condition on.
	 * @param float|integer $value    The value the property should be greater than or equal to to satisfy the condition.
	 */
	public function greaterThanOrEquals($property, $value);

	/**
	 * Set the condition that a numerical property must be greater than a given value.
	 *
	 * @param string        $property The property you want to set a condition on.
	 * @param float|integer $value    The value the property should be less than to satisfy the condition.
	 */
	public function lessThan($property, $value);

	/**
	 * Set the condition that a numerical property must be greater than or equal to a given value.
	 *
	 * @param string        $property The property you want to set a condition on.
	 * @param float|integer $value    The value the property should be less than or equal to to satisfy the condition.
	 */
	public function lessThanOrEquals($property, $value);

	/**
	 * Set the condition that a property must be equal to any value in a given set.
	 *
	 * @param string                               $property The property you want to set a condition on.
	 * @param string[]|float[]|boolean[]|integer[] $values    The values the property should be equal to any of to satisfy the condition.
	 */
	public function in($property, array $values);

	/**
	 * Set the condition that a property must not be equal to any value in a given set.
	 *
	 * @param string                               $property The property you want to set a condition on.
	 * @param string[]|float[]|boolean[]|integer[] $value    The values the property should not be equal to any of to satisfy the condition.
	 */
	public function notIn($property, array $values);
}
