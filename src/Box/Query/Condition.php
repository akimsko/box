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
 * QueryCondition.
 *
 * @author Jens Riisom Schultz <jers@fynskemedier.dk>
 */
class QueryCondition extends QueryAbstractCondition {
	/**
	 * @param QuerySub $query Optional.
	 *
	 * @return QuerySub
	 */
	public function and_(QuerySub $query = null) {
		return new QuerySub();
	}

	/**
	 * @param QuerySub $query Optional.
	 *
	 * @return QuerySub
	 */
	public function or_(QuerySub $query = null) {
		return new QuerySub();
	}
}
