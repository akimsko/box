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
class QueryAggregateOperation implements QueryInterfaceOperation {
	/**
	 * @param QuerySubCondition Optional.
	 *
	 * @return TokenLolMaybe
	 */
	public function andSub(QuerySubCondition $sub = null) {
		return null;
	}

	/**
	 * @param QuerySubCondition Optional.
	 *
	 * @return TokenLolMaybe
	 */
	public function orSub(QuerySubCondition $sub = null) {
		return null;
	}

	/**
	 * @param QuerySubCondition Optional.
	 *
	 * @return TokenLolMaybe
	 */
	public function and_() {
		return null;
	}

	/**
	 * @param QuerySubCondition Optional.
	 *
	 * @return TokenLolMaybe
	 */
	public function or_() {
		return null;
	}
}
