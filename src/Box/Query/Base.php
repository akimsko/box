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
 * A base class for query elements.
 *
 * @author Jens Riisom Schultz <jens@unpossiblesystems.dk>
 */
abstract class QueryBase implements QueryInterface {
	/** @var QueryBase The child query element of this query element. */
	protected $_child;

	/** @var TokenBase The token for this query element. */
	protected $_token;

	/** @var Query|QuerySubCondition The root of this query. */
	protected $_root;

	/**
	 * Get the token this query element translates to.
	 *
	 * @return TokenBase
	 */
	protected function _getToken() {
		if ($this->_child instanceof QueryBase) {
			$this->_token->nextToken = $this->_child->_getToken();
		}

		return $this->_token;
	}

	/**
	 * Get the token representing the root of the query this query part belongs to, if any.
	 *
	 * @return TokenRoot
	 * 
	 * @throws QueryException
	 */
	public function getToken() {
		if ($this->_root instanceof QueryBase && ($token = $this->_root->getToken()) !== null) {
			return $token;
		} else {
			throw new QueryException("Internal Box framework error: Token root has not been set.");
		}
	}
}
