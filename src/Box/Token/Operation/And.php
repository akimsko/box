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
 * An operation token.
 *
 * @author Jens Riisom Schultz <jens@unpossiblesystems.dk>
 */
class TokenOperationAnd extends TokenOperation {
	
	/**
	 * Get the native translation of token.
	 * 
	 * @param TokenNativeInterface $tokenTranslator
	 * @param TokenBase|null       $previous
	 * 
	 * @return string The translated token.
	 */
	protected function _getNative(TokenNativeInterface $tokenTranslator, TokenBase $previous = null) {
		return $tokenTranslator->andOperator($this, $previous);
	}
}
