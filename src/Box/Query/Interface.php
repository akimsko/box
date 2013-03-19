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
 * QueryInterface
 *
 * @author Bo Thinggaard <bo@unpossiblesystems.dk>
 */
interface QueryInterface {
	/**
	 * Get the token representing the root of the query this query part belongs to, if any.
	 *
	 * @return TokenRoot|null
	 * 
	 * @throws QueryException
	 */
	public function getToken();
}