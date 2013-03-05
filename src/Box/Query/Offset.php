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
class QueryOffset extends QueryBase {
	/**
	 * Offset the result set, effectively discarding the first $offset objects.
	 *
	 * @param integer $offset
	 *
	 * @return null
	 */
	public function offset($offset) {
		$this->_token = new TokenOffset();
		$this->_token->offset;

		return null;
	}
}