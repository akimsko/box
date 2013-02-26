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
 * QueryLimitCondition.
 *
 * @author Jens Riisom Schultz <jers@fynskemedier.dk>
 */
class QueryLimitCondition extends QueryBase {
	/**
	 * @var string Constant used to indicate you want to order ascending.
	 */
	const ASC = 'ASC';

	/**
	 * @var string Constant used to indicate you want to order descending.
	 */
	const DESC = 'DESC';

	/**
	 * Set a property to order by.
	 *
	 * @param string $property  The property you want to order by.
	 * @param string $direction Should be one of the class constants ASC or DESC.
	 *
	 * @return QueryLimitCondition
	 */
	public function orderBy($property, $direction) {
		return new QueryLimitCondition();
	}
}
