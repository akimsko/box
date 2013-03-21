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
class QueryAggregateCondition implements QueryInterfaceCondition {
	/**
	 * Set the condition that a string property must contain the given substring.
	 *
	 * @param string  $property      The property you want to set a condition on.
	 * @param string  $value         The string you want that property to contain.
	 * @param boolean $caseSensitive
	 *
	 * @return TokenConditionContains
	 */
	public function contains($property, $value, $caseSensitive = false) {
		$token = new TokenConditionContains();
		$token->property = $property;
		$token->value = $value;
		$token->caseSensitive = $caseSensitive;

		return $token;
	}

	/**
	 * Set the condition that a string property must end with the given substring.
	 *
	 * @param string  $property      The property you want to set a condition on.
	 * @param string  $value         The string you want that property to end with.
	 * @param boolean $caseSensitive
	 *
	 * @return TokenConditionEndsWith
	 */
	public function endsWith($property, $value, $caseSensitive = false) {
		$token = new TokenConditionEndsWith();
		$token->property = $property;
		$token->value = $value;
		$token->caseSensitive = $caseSensitive;

		return $token;
	}

	/**
	 * Set the condition that a string property must start with the given substring.
	 *
	 * @param string  $property      The property you want to set a condition on.
	 * @param string  $value         The string you want that property to start with.
	 * @param boolean $caseSensitive
	 *
	 * @return TokenConditionStartsWith
	 */
	public function startsWith($property, $value, $caseSensitive = false) {
		$token = new TokenConditionStartsWith();
		$token->property = $property;
		$token->value = $value;
		$token->caseSensitive = $caseSensitive;

		return $token;
	}

	/**
	 * Set the condition that a property must have a given value.
	 *
	 * @param string                                                                 $property The property you want to set a condition on.
	 * @param string|float|boolean|integer|string[]|float[]|boolean[]|integer[]|null $value    The value the property should have to satisfy the condition.
	 *
	 * @return TokenConditionEquals
	 */
	public function equals($property, $value) {
		$token = new TokenConditionEquals();
		$token->property = $property;
		$token->value = $value;

		return $token;
	}

	/**
	 * Set the condition that a property must not have a given value.
	 *
	 * @param string                                                                 $property The property you want to set a condition on.
	 * @param string|float|boolean|integer|string[]|float[]|boolean[]|integer[]|null $value    The value the property should not have to satisfy the condition.
	 *
	 * @return TokenConditionNotEquals
	 */
	public function notEquals($property, $value) {
		$token = new TokenConditionNotEquals();
		$token->property = $property;
		$token->value = $value;

		return $token;
	}

	/**
	 * Set the condition that a numerical property must be greater than a given value.
	 *
	 * @param string        $property The property you want to set a condition on.
	 * @param float|integer $value    The value the property should be greater than to satisfy the condition.
	 *
	 * @return TokenConditionGreaterThan
	 */
	public function greaterThan($property, $value) {
		$token = new TokenConditionGreaterThan();
		$token->property = $property;
		$token->value = $value;

		return $token;
	}

	/**
	 * Set the condition that a numerical property must be greater than or equal to a given value.
	 *
	 * @param string        $property The property you want to set a condition on.
	 * @param float|integer $value    The value the property should be greater than or equal to to satisfy the condition.
	 *
	 * @return TokenConditionGreaterThanOrEquals
	 */
	public function greaterThanOrEquals($property, $value) {
		$token = new TokenConditionGreaterThanOrEquals();
		$token->property = $property;
		$token->value = $value;

		return $token;
	}

	/**
	 * Set the condition that a numerical property must be greater than a given value.
	 *
	 * @param string        $property The property you want to set a condition on.
	 * @param float|integer $value    The value the property should be less than to satisfy the condition.
	 *
	 * @return TokenConditionLessThan
	 */
	public function lessThan($property, $value) {
		$token = new TokenConditionLessThan();
		$token->property = $property;
		$token->value = $value;

		return $token;
	}

	/**
	 * Set the condition that a numerical property must be greater than or equal to a given value.
	 *
	 * @param string        $property The property you want to set a condition on.
	 * @param float|integer $value    The value the property should be less than or equal to to satisfy the condition.
	 *
	 * @return TokenConditionLessThanOrEquals
	 */
	public function lessThanOrEquals($property, $value) {
		$token = new TokenConditionLessThanOrEquals();
		$token->property = $property;
		$token->value = $value;

		return $token;
	}

	/**
	 * Set the condition that a property must be equal to any value in a given set.
	 *
	 * @param string                               $property The property you want to set a condition on.
	 * @param string[]|float[]|boolean[]|integer[] $values    The values the property should be equal to any of to satisfy the condition.
	 *
	 * @return TokenConditionIn
	 */
	public function in($property, array $values) {
		$token = new TokenConditionIn();
		$token->property = $property;
		$token->value = $values;

		return $token;
	}

	/**
	 * Set the condition that a property must not be equal to any value in a given set.
	 *
	 * @param string                               $property The property you want to set a condition on.
	 * @param string[]|float[]|boolean[]|integer[] $values    The values the property should not be equal to any of to satisfy the condition.
	 *
	 * @return TokenConditionNotIn
	 */
	public function notIn($property, array $values) {
		$token = new TokenConditionNotIn();
		$token->property = $property;
		$token->value = $values;

		return $token;
	}
}