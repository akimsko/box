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
 * A root token. This should be the first element in a token chain returned from a Query.
 *
 * @author Jens Riisom Schultz <jens@unpossiblesystems.dk>
 */
class TokenRoot extends TokenBase {
	/** @var DataObjectInterface An instance of the class the token chain will query. */
	public $instance;
}
