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
class QuerySubOperation extends QueryBase implements QueryInterfaceOperation {
	private $_aggregate;

	/**
	 * Use ::create if you can find it. Otherwise this.
	 */
	final public function __construct() {
		$this->_aggregate = new QueryAggregateOperation();
	}

	/**
	 * @param QuerySubCondition Optional.
	 *
	 * @return QuerySubOperation
	 */
	public function andSub(QuerySubCondition $sub = null) {
		$this->_token = $this->_aggregate->andSub($sub);

		return $this->_child = new QuerySubOperation();
	}

	/**
	 * @param QuerySubCondition Optional.
	 *
	 * @return QuerySubOperation
	 */
	public function orSub(QuerySubCondition $sub = null) {
		$this->_token = $this->_aggregate->orSub($sub);

		return $this->_child = new QuerySubOperation();
	}

	/**
	 * @param QuerySubCondition Optional.
	 *
	 * @return QuerySubCondition
	 */
	public function and_() {
		$this->_token = $this->_aggregate->and_();

		return $this->_child = new QuerySubCondition();
	}

	/**
	 * @param QuerySubCondition Optional.
	 *
	 * @return QuerySubCondition
	 */
	public function or_() {
		$this->_token = $this->_aggregate->or_();

		return $this->_child = new QuerySubCondition();
	}
}
