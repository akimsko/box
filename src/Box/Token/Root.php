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

	/**
	 * Internal helper method for __toString;
	 *
	 * @param TokenBase $token
	 *
	 * @return string
	 */
	private static function _toStringHelper(TokenBase $token) {
		$string = '';
		$previousToken = null;

		do {
			switch (true) {
				case $token instanceof TokenRoot:
					$string .= 'FETCH ' . get_class($token->instance);
					if ($token->nextToken instanceof TokenCondition) {
						$string .= "\nHAVING\n";
					}
					break;
				case $token instanceof TokenLimit:
					$string .= "\nLIMIT {$token->limit}";
					break;
				case $token instanceof TokenOffset:
					$string .= "\nOFFSET {$token->offset}";
					break;
				case $token instanceof TokenOrderBy:
					if (!($previousToken instanceof TokenOrderBy)) {
						$string .= "\nORDER BY {$token->property} {$token->direction}";
					} else {
						$string .= ", {$token->property} {$token->direction}";
					}
					break;
				case $token instanceof TokenConditionStartsWith:
					$value = str_replace('"', '\\"', $token->value);
					$string .= "\t{$token->property} THAT STARTS WITH \"$value\"";
					break;
				case $token instanceof TokenConditionEndsWith:
					$value = str_replace('"', '\\"', $token->value);
					$string .= "\t{$token->property} THAT ENDS WITH \"$value\"";
					break;
				case $token instanceof TokenConditionContains:
					$value = str_replace('"', '\\"', $token->value);
					$string .= "\t{$token->property} THAT CONTAINS \"$value\"";
					break;
				case $token instanceof TokenConditionEquals:
					if (is_string($token->value)) {
						$value = '"' . str_replace('"', '\\"', $token->value) . '"';
					} else if (is_bool($token->value)) {
						$value = $token->value ? 'true' : 'false';
					} else if (is_array($token->value)) {
						$value = '[' . implode(',', $token->value) . ']';
					} else {
						$value = $token->value;
					}
					$string .= "\t{$token->property} = $value";
					break;
				case $token instanceof TokenConditionNotEquals:
					if (is_string($token->value)) {
						$value = '"' . str_replace('"', '\\"', $token->value) . '"';
					} else if (is_bool($token->value)) {
						$value = $token->value ? 'true' : 'false';
					} else if (is_array($token->value)) {
						$value = '[' . implode(',', $token->value) . ']';
					} else {
						$value = $token->value;
					}
					$string .= "\t{$token->property} != $value";
					break;
				case $token instanceof TokenConditionGreaterThan:
					$string .= "\t{$token->property} > {$token->value}";
					break;
				case $token instanceof TokenConditionGreaterThanOrEquals:
					$string .= "\t{$token->property} >= {$token->value}";
					break;
				case $token instanceof TokenConditionLessThan:
					$string .= "\t{$token->property} < {$token->value}";
					break;
				case $token instanceof TokenConditionLessThanOrEquals:
					$string .= "\t{$token->property} <= {$token->value}";
					break;
				case $token instanceof TokenConditionIn:
					$string .= "\t{$token->property} IN [" . implode(',', $token->value) . ']';
					break;
				case $token instanceof TokenConditionNotIn:
					$string .= "\t{$token->property} NOT IN [" . implode(',', $token->value) . ']';
					break;
				case $token instanceof TokenOperationAnd:
					$string .= "\n\tAND\n";
					break;
				case $token instanceof TokenOperationOr:
					$string .= "\n\tOR\n";
					break;
				case $token instanceof TokenOperationOrSub:
					$string .= "\n\tOR (\n" . preg_replace('/\t([^\t])/', "\t\t\\1", self::_toStringHelper($token->sub)) . "\t)";
					break;
				case $token instanceof TokenOperationAndSub:
					$string .= "\n\tAND (\n" . preg_replace('/\t([^\t])/', "\t\t\\1", self::_toStringHelper($token->sub)) . "\t)";
					break;
				default:
					$string = 'Unknown token type, ' . get_class($token) . ", encountered!\n";
					return $string;
			}
			$previousToken = $token;
		} while ($token = $token->nextToken);

		return $string . "\n";
	}

	/**
	 * An example implementation of a translator to a native query language.
	 * This one generates a pseudo query language.
	 *
	 * @return string
	 *
	 * @throws \RuntimeException If an unknown class is encountered in the token chain.
	 */
	public function __toString() {
		return self::_toStringHelper($this);
	}
}
