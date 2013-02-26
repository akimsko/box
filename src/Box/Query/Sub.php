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
 * A sub query. Or a part of a query. Or something like that.
 *
 * @author Jens Riisom Schultz <jers@fynskemedier.dk>
 */
class QuerySub extends QueryAbstractCondition {
	/**
	 * Set the condition that the found objects should have a string property which starts with $value.
	 *
	 * @param string $property The property you want to set a condition on.
	 * @param string $value    The string you want that property to start with.
	 *
	 * @return QueryCondition
	 */
	public function startsWith($property, $value) {
		return new QueryCondition();
	}

	/**
	 * @param string                       $property The property you want to set a condition on.
	 * @param string|float|boolean|integer $value    The string you want that property to start with.
	 *
	 * @return QueryCondition
	 */
	public function equals($property, $value) {
		return new QueryCondition();
	}
}
