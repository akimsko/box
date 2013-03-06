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
class QueryLimitOrOrderBy extends QueryBase {
	const ASC = 'ASC';

	const DESC = 'DESC';

	/**
	 * Limit the result set.
	 *
	 * @param integer $limit The maximum number of objects you want.
	 *
	 * @return QueryOffset
	 */
	public function limit($limit) {
		$this->_token        = new TokenLimit();
		$this->_token->limit = $limit;

		return $this->_child = new QueryOffset();
	}

	/**
	 * Order the result set.
	 *
	 * @param string $property  The property to order by.
	 * @param string $direction The direction to order. Use the class constants ::ASC and ::DESC.
	 *
	 * @return QueryLimitOrOrderBy
	 */
	public function orderBy($property, $direction = self::ASC) {
		$this->_token            = new TokenOrderBy();
		$this->_token->direction = $direction;
		$this->_token->property  = $property;

		return $this->_child = new QueryLimitOrOrderBy();
	}
}
