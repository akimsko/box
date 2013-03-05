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
 * Base class for Tokens.
 *
 * @author Jens Riisom Schultz <jens@unpossiblesystems.dk>
 */
class TokenBase {
	/** @var TokenBase The token that comes after this one. */
	public $nextToken;
}
