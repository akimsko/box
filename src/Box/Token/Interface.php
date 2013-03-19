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
interface TokenInterface {
	/**
	 * Build a native query from tokens.
	 * 
	 * @param TokenNativeInterface $tokenTranslator
	 * 
	 * @return string The native query.
	 */
	public function buildNative(TokenNativeInterface $tokenTranslator);
}