<?php
namespace Box;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2013-03-08 at 15:09:06.
 *
 * @runInSeparateProcess
 */
class AutoloaderTest extends \PHPUnit_Framework_TestCase {
	/**
	 * @var Autoloader
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->object = new Autoloader;
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
	}

	/**
	 * @covers Box\Autoloader::autoload
	 */
	public function testAutoload() {
		$this->assertNull($this->object->autoload('lolface'));
	}

	/**
	 * @covers Box\Autoloader::unregister
	 */
	public function testUnregister() {
		$precount = count(spl_autoload_functions());

		$this->object->unregister();

		$this->assertEquals(--$precount, count(spl_autoload_functions()));
	}
}
