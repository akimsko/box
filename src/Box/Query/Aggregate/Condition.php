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
	 * Set the condition that the found objects should have a string property which starts with $value.
	 *
	 * @param string $property The property you want to set a condition on.
	 * @param string $value    The string you want that property to start with.
	 *
	 * @return TokenConditionStartsWith
	 */
	public function startsWith($property, $value) {
		$token           = new TokenConditionStartsWith();
		$token->property = $property;
		$token->value    = $value;

		return $token;
	}

	/**
	 * @param string                       $property The property you want to set a condition on.
	 * @param string|float|boolean|integer $value    The string you want that property to start with.
	 *
	 * @return TokenConditionEquals
	 */
	public function equals($property, $value) {
		$token           = new TokenConditionEquals();
		$token->property = $property;
		$token->value    = $value;

		return $token;
	}
}