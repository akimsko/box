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
class QueryLimitOrOrderBy {
	const ASC = 'asc';
	const DESC = 'desc';

	public function limit($limit) {
		return new QueryOffset();
	}

	public function orderBy($property, $direction = self::ASC) {
		return new QueryLimitOrOrderBy();
	}
}
