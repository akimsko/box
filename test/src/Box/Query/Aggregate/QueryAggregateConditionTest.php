<?php
namespace Box;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2013-03-08 at 15:09:11.
 */
class QueryAggregateConditionTest extends \PHPUnit_Framework_TestCase {
	/**
	 * @var QueryAggregateCondition
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->object = new QueryAggregateCondition();
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
	}

	/**
	 * @covers Box\QueryAggregateCondition::contains
	 */
	public function testContains() {
		$token = $this->object->contains('property', 'value', false);
		$this->assertTrue($token instanceof TokenConditionContains);
		$this->assertEquals('property', $token->property);
		$this->assertEquals('value', $token->value);
		$this->assertEquals(false, $token->caseSensitive);

		$token = $this->object->contains('property2', 42, true);
		$this->assertTrue($token instanceof TokenConditionContains);
		$this->assertEquals('property2', $token->property);
		$this->assertEquals(42, $token->value);
		$this->assertEquals(true, $token->caseSensitive);
	}

	/**
	 * @covers Box\QueryAggregateCondition::endsWith
	 */
	public function testEndsWith() {
		$token = $this->object->endsWith('property', 'value', false);
		$this->assertTrue($token instanceof TokenConditionEndsWith);
		$this->assertEquals('property', $token->property);
		$this->assertEquals('value', $token->value);
		$this->assertEquals(false, $token->caseSensitive);

		$token = $this->object->endsWith('property2', 'value2', true);
		$this->assertTrue($token instanceof TokenConditionEndsWith);
		$this->assertEquals('property2', $token->property);
		$this->assertEquals('value2', $token->value);
		$this->assertEquals(true, $token->caseSensitive);
	}

	/**
	 * @covers Box\QueryAggregateCondition::startsWith
	 */
	public function testStartsWith() {
		$token = $this->object->startsWith('property', 'value', false);
		$this->assertTrue($token instanceof TokenConditionStartsWith);
		$this->assertEquals('property', $token->property);
		$this->assertEquals('value', $token->value);
		$this->assertEquals(false, $token->caseSensitive);

		$token = $this->object->startsWith('property2', 'value2', true);
		$this->assertTrue($token instanceof TokenConditionStartsWith);
		$this->assertEquals('property2', $token->property);
		$this->assertEquals('value2', $token->value);
		$this->assertEquals(true, $token->caseSensitive);
	}

	/**
	 * @covers Box\QueryAggregateCondition::equals
	 */
	public function testEquals() {
		$token = $this->object->equals('property', 'value');
		$this->assertTrue($token instanceof TokenConditionEquals);
		$this->assertEquals('property', $token->property);
		$this->assertEquals('value', $token->value);

		$token = $this->object->equals('property2', 42);
		$this->assertTrue($token instanceof TokenConditionEquals);
		$this->assertEquals('property2', $token->property);
		$this->assertEquals(42, $token->value);
	}

	/**
	 * @covers Box\QueryAggregateCondition::notEquals
	 */
	public function testNotEquals() {
		$token = $this->object->notEquals('property', 'value');
		$this->assertTrue($token instanceof TokenConditionNotEquals);
		$this->assertEquals('property', $token->property);
		$this->assertEquals('value', $token->value);

		$token = $this->object->notEquals('property2', 42);
		$this->assertTrue($token instanceof TokenConditionNotEquals);
		$this->assertEquals('property2', $token->property);
		$this->assertEquals(42, $token->value);
	}

	/**
	 * @covers Box\QueryAggregateCondition::greaterThan
	 */
	public function testGreaterThan() {
		$token = $this->object->greaterThan('property', 42, false);
		$this->assertTrue($token instanceof TokenConditionGreaterThan);
		$this->assertEquals('property', $token->property);
		$this->assertEquals(42, $token->value);

		$token = $this->object->greaterThan('property2', 42.42);
		$this->assertTrue($token instanceof TokenConditionGreaterThan);
		$this->assertEquals('property2', $token->property);
		$this->assertEquals(42.42, $token->value);
	}

	/**
	 * @covers Box\QueryAggregateCondition::greaterThanOrEquals
	 */
	public function testGreaterThanOrEquals() {
		$token = $this->object->greaterThanOrEquals('property', 42, false);
		$this->assertTrue($token instanceof TokenConditionGreaterThanOrEquals);
		$this->assertEquals('property', $token->property);
		$this->assertEquals(42, $token->value);

		$token = $this->object->greaterThanOrEquals('property2', 42.42);
		$this->assertTrue($token instanceof TokenConditionGreaterThanOrEquals);
		$this->assertEquals('property2', $token->property);
		$this->assertEquals(42.42, $token->value);
	}

	/**
	 * @covers Box\QueryAggregateCondition::lessThan
	 */
	public function testLessThan() {
		$token = $this->object->lessThan('property', 42, false);
		$this->assertTrue($token instanceof TokenConditionLessThan);
		$this->assertEquals('property', $token->property);
		$this->assertEquals(42, $token->value);

		$token = $this->object->lessThan('property2', 42.42);
		$this->assertTrue($token instanceof TokenConditionLessThan);
		$this->assertEquals('property2', $token->property);
		$this->assertEquals(42.42, $token->value);
	}

	/**
	 * @covers Box\QueryAggregateCondition::lessThanOrEquals
	 */
	public function testLessThanOrEquals() {
		$token = $this->object->lessThanOrEquals('property', 42, false);
		$this->assertTrue($token instanceof TokenConditionLessThanOrEquals);
		$this->assertEquals('property', $token->property);
		$this->assertEquals(42, $token->value);

		$token = $this->object->lessThanOrEquals('property2', 42.42);
		$this->assertTrue($token instanceof TokenConditionLessThanOrEquals);
		$this->assertEquals('property2', $token->property);
		$this->assertEquals(42.42, $token->value);
	}

	/**
	 * @covers Box\QueryAggregateCondition::in
	 */
	public function testIn() {
		$token = $this->object->in('property', array(42));
		$this->assertTrue($token instanceof TokenConditionIn);
		$this->assertEquals('property', $token->property);
		$this->assertEquals(array(42), $token->value);

		$token = $this->object->in('property', array(42, 'horse', 11.16));
		$this->assertTrue($token instanceof TokenConditionIn);
		$this->assertEquals('property', $token->property);
		$this->assertEquals(array(42, 'horse', 11.16), $token->value);
	}

	/**
	 * @covers Box\QueryAggregateCondition::notIn
	 */
	public function testNotIn() {
		$token = $this->object->notIn('property', array(42));
		$this->assertTrue($token instanceof TokenConditionNotIn);
		$this->assertEquals('property', $token->property);
		$this->assertEquals(array(42), $token->value);

		$token = $this->object->notIn('property', array(42, 'horse', 11.16));
		$this->assertTrue($token instanceof TokenConditionNotIn);
		$this->assertEquals('property', $token->property);
		$this->assertEquals(array(42, 'horse', 11.16), $token->value);
	}
}
