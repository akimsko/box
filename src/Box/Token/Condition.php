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
 * A condition token.
 *
 * @author Jens Riisom Schultz <jens@unpossiblesystems.dk>
 */
class TokenCondition extends TokenBase {
	/** @var string|float|boolean|integer|string[]|float[]|boolean[]|integer[] The value the property value is compared with. */
	public $value;

	/** @var string The name of the property the condition applies to. */
	public $property;
}
