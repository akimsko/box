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
abstract class TokenBase implements TokenInterface {
	/** @var TokenBase The token that comes after this one. */
	public $nextToken;
	
	/**
	 * Build a native query from tokens.
	 * 
	 * @param TokenNativeInterface $tokenTranslator
	 * 
	 * @return string The native query.
	 */
	public function buildNative(TokenNativeInterface $tokenTranslator) {
		$string = '';
		$previousToken = null;
		$token = $this;
		
		do {
			$string .= $token->_getNative($tokenTranslator, $previousToken);
			$previousToken = $token;
		} while ($token = $token->nextToken);

		return $string;
	}
	
	/**
	 * Get the native translation of token.
	 * 
	 * @param TokenNativeInterface $tokenTranslator
	 * @param TokenBase|null       $previous
	 * 
	 * @return string The translated token.
	 */
	abstract protected function _getNative(TokenNativeInterface $tokenTranslator, TokenBase $previous = null);
}
