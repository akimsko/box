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
 * TokenNativeInterface
 *
 * @author Bo Thinggaard
 */
interface TokenNativeInterface {
	
	/**
	 * Get the native translation of contains token.
	 * 
	 * @param TokenConditionContains $token
	 * @param TokenBase|null         $previous
	 * 
	 * @return string The translated token.
	 */
	public function contains(TokenConditionContains $token, TokenBase $previous = null);
	
	/**
	 * Get the native translation of endsWidth token.
	 * 
	 * @param TokenConditionEndsWith $token
	 * @param TokenBase|null         $previous
	 * 
	 * @return string The translated token.
	 */
	public function endsWidth(TokenConditionEndsWith $token, TokenBase $previous = null);

	/**
	 * Get the native translation of equals token.
	 * 
	 * @param TokenConditionEquals $token
	 * @param TokenBase|null       $previous
	 * 
	 * @return string The translated token.
	 */
	public function equals(TokenConditionEquals $token, TokenBase $previous = null);
	
	/**
	 * Get the native translation of greaterThan token.
	 * 
	 * @param TokenConditionGreaterThan $token
	 * @param TokenBase|null            $previous
	 * 
	 * @return string The translated token.
	 */
	public function greaterThan(TokenConditionGreaterThan $token, TokenBase $previous = null);
	
	/**
	 * Get the native translation of GreaterThanOrEquals token.
	 * 
	 * @param TokenConditionGreaterThanOrEquals $token
	 * @param TokenBase|null                    $previous
	 * 
	 * @return string The translated token.
	 */
	public function greaterThanOrEquals(TokenConditionGreaterThanOrEquals $token, TokenBase $previous = null);
	
	/**
	 * Get the native translation of In token.
	 * 
	 * @param TokenConditionIn $token
	 * @param TokenBase|null   $previous
	 * 
	 * @return string The translated token.
	 */
	public function in(TokenConditionIn $token, TokenBase $previous = null);
	
	/**
	 * Get the native translation of LessThan token.
	 * 
	 * @param TokenConditionLessThan $token
	 * @param TokenBase|null         $previous
	 * 
	 * @return string The translated token.
	 */
	public function lessThan(TokenConditionLessThan $token, TokenBase $previous = null);
	
	/**
	 * Get the native translation of LessThanOrEquals token.
	 * 
	 * @param TokenConditionLessThanOrEquals $token
	 * @param TokenBase|null                 $previous
	 * 
	 * @return string The translated token.
	 */
	public function lessThanOrEquals(TokenConditionLessThanOrEquals $token, TokenBase $previous = null);
	
	/**
	 * Get the native translation of NotEquals token.
	 * 
	 * @param TokenConditionNotEquals $token
	 * @param TokenBase|null          $previous
	 * 
	 * @return string The translated token.
	 */
	public function notEquals(TokenConditionNotEquals $token, TokenBase $previous = null);
	
	/**
	 * Get the native translation of NotIn token.
	 * 
	 * @param TokenConditionNotIn $token
	 * @param TokenBase|null      $previous
	 * 
	 * @return string The translated token.
	 */
	public function notIn(TokenConditionNotIn $token, TokenBase $previous = null);
	
	/**
	 * Get the native translation of StartsWith token.
	 * 
	 * @param TokenConditionStartsWith $token
	 * @param TokenBase|null           $previous
	 * 
	 * @return string The translated token.
	 */
	public function startsWith(TokenConditionStartsWith $token, TokenBase $previous = null);
	
	/**
	 * Get the native translation of And token.
	 * 
	 * @param TokenOperationAnd $token
	 * @param TokenBase|null    $previous
	 * 
	 * @return string The translated token.
	 */
	public function andOperator(TokenOperationAnd $token, TokenBase $previous = null);
	
	/**
	 * Get the native translation of AndSub token.
	 * 
	 * @param TokenOperationAndSub $token
	 * @param TokenBase|null       $previous
	 * 
	 * @return string The translated token.
	 */
	public function andSubOperator(TokenOperationAndSub $token, TokenBase $previous = null);
	
	/**
	 * Get the native translation of Or token.
	 * 
	 * @param TokenOperationOr $token
	 * @param TokenBase|null   $previous
	 * 
	 * @return string The translated token.
	 */
	public function orOperator(TokenOperationOr $token, TokenBase $previous = null);
	
	/**
	 * Get the native translation of OrSub token.
	 * 
	 * @param TokenOperationOrSub $token
	 * @param TokenBase|null      $previous
	 * 
	 * @return string The translated token.
	 */
	public function orSubOperator(TokenOperationOrSub $token, TokenBase $previous = null);
	
	/**
	 * Get the native translation of Limit token.
	 * 
	 * @param TokenLimit     $token
	 * @param TokenBase|null $previous
	 * 
	 * @return string The translated token.
	 */
	public function limit(TokenLimit $token, TokenBase $previous = null);
	
	/**
	 * Get the native translation of Offset token.
	 * 
	 * @param TokenOffset    $token
	 * @param TokenBase|null $previous
	 * 
	 * @return string The translated token.
	 */
	public function offset(TokenOffset $token, TokenBase $previous = null);
	
	/**
	 * Get the native translation of OrderBy token.
	 * 
	 * @param TokenOrderBy    $token
	 * @param TokenBase|null $previous
	 * 
	 * @return string The translated token.
	 */
	public function orderBy(TokenOrderBy $token, TokenBase $previous = null);
	
	/**
	 * Get the native translation of Root token.
	 * 
	 * @param TokenRoot      $token
	 * @param TokenBase|null $previous
	 * 
	 * @return string The translated token.
	 */
	public function root(TokenRoot $token, TokenBase $previous = null);
}