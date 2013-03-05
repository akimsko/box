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
class TokenOrderBy extends TokenBase {
	/** @var string The direction to order by. 'asc' or 'desc' */
	public $direction;

	/** @var string The name of the property to order by. */
	public $property;
}
