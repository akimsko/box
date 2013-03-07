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
	 * @param QuerySubCondition
	 *
	 * @return TokenOperationAndSub
	 */
	public function andSub(QuerySubCondition $sub) {
		$token = new TokenOperationAndSub();
		$token->sub = $sub->getToken();

		return $token;
	}

	/**
	 * @param QuerySubCondition $sub
	 *
	 * @return TokenOperationOrSub
	 */
	public function orSub(QuerySubCondition $sub) {
		$token = new TokenOperationOrSub();
		$token->sub = $sub->getToken();

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
