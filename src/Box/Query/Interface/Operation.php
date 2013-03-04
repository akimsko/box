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
interface QueryInterfaceOperation {
	/**
	 * @param QuerySubCondition Optional.
	 */
	public function andSub(QuerySubCondition $sub = null);

	/**
	 * @param QuerySubCondition Optional.
	 */
	public function orSub(QuerySubCondition $sub = null);

	/**
	 */
	public function and_();

	/**
	 */
	public function or_();
}