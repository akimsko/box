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
class QueryAggregateOperation implements QueryInterfaceOperation {
	/**
	 * @param QueryBase
	 *
	 * @return TokenOperationAndSub
	 *
	 * @throws QueryException
	 */
	public function andSub(QueryBase $sub) {
		$token = new TokenOperationAndSub();

		try {
			$token->sub = $sub->getToken();
		} catch (QueryException $ex) {
			throw new QueryException('Do not inject an empty sub query.', 0, $ex);
		}

		return $token;
	}

	/**
	 * @param QueryBase $sub
	 *
	 * @return TokenOperationOrSub
	 *
	 * @throws QueryException
	 */
	public function orSub(QueryBase $sub) {
		$token = new TokenOperationOrSub();

		try {
			$token->sub = $sub->getToken();
		} catch (QueryException $ex) {
			throw new QueryException('Do not inject an empty sub query.');
		}

		return $token;
	}

	/**
	 * @return TokenOperationAnd
	 */
	public function and_() {
		$token = new TokenOperationAnd();

		return $token;
	}

	/**
	 * @return TokenOperationOr
	 */
	public function or_() {
		$token = new TokenOperationOr();

		return $token;
	}
}
