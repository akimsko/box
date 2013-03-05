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
class QueryBase {
	/** @var QueryBase The child query element of this query element. */
	protected $_child;

	/** @var TokenBase The token for this query element. */
	protected $_token;

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
}
