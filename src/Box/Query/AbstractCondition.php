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
 * QueryAbstract.
 *
 * @author Jens Riisom Schultz <jers@fynskemedier.dk>
 */
class QueryAbstractCondition extends QueryLimitCondition {
	/**
	 * Limit and/or offset your result set.
	 *
	 * @param integer $offset  An offset into the result set.
	 * @param integer $maximum The maximum number of objects to get.
	 *
	 * @return QueryLimitCondition
	 */
	public function limit($offset, $maximum) {
		return new QueryLimitCondition();
	}
}
