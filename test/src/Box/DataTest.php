<?php
namespace Box;
/*
 * This file is part of the Box project.
 * @link https://github.com/akimsko/box
 * 
 * @copyright Copyright 2013 Bo Thinggaard & Jens Riisom Schultz
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 */

/**
 * DataTest
 *
 * @author Bo Thinggaard
 */
class DataTest extends \PHPUnit_Framework_TestCase {
	
	public function testConstruct() {
		$data = new Data(array('test' => 1));
		$this->assertEquals($data->test, 1);
	}
	
	public function testToArrayCopy() {
		$data = new Data(array('test' => 1));
		$copy = $data->toArrayCopy();
		$this->assertEquals($copy['test'], 1);
		$copy['test'] = 2;
		$this->assertEquals($copy['test'], 2);
		$this->assertEquals($data['test'], 1);
	}
	
	public function testRemove() {
		$data = new Data(array('test' => 1));
		$data->remove('test');
		$this->assertFalse(array_key_exists('test', $data));
	}
	
	public function testOffsetUnset() {
		$data = new Data(array('test' => 1));
		unset($data['test']);
		$this->assertFalse(isset($data['test']) || isset($data->test));
	}
	
	public function testUnset() {
		$data = new Data(array('test' => 1));
		unset($data->test);
		$this->assertFalse(isset($data['test']) || isset($data->test));
	}
	
	public function testTypeInteger() {
		$data = new Data();
		
		$data->put('testPut', 1);
		$this->assertEquals(1, $data->testPut);
		$this->assertEquals(1, $data['testPut']);
	}
	
	public function testTypeString() {
		$data = new Data();
		
		$data->put('test', 'stuff');
		$this->assertEquals('stuff', $data->test);
		$this->assertEquals('stuff', $data['test']);
	}
	
	public function testTypeBoolean() {
		$data = new Data();
		
		$data->put('test', true);
		$this->assertEquals(true, $data->test);
		$this->assertEquals(true, $data['test']);
	}
	
	public function testTypeFloat() {
		$data = new Data();
		
		$data->put('test', 1.1);
		$this->assertEquals(1.1, $data->test);
		$this->assertEquals(1.1, $data['test']);
	}
	
	public function testPropSet() {
		$data = new Data();
		
		$data->test = 1337;
		$this->assertEquals(1337, $data->test);
		$this->assertEquals(1337, $data['test']);
	}
	
	public function testArraySet() {
		$data = new Data();
		
		$data['test'] = 1337;
		$this->assertEquals(1337, $data->test);
		$this->assertEquals(1337, $data['test']);
	}
	
	/**
     * @expectedException InvalidArgumentException
     */
	public function testArgumentInvalidType() {
		$data = new Data();
		$data->put('test', new \stdClass());
	}
	
	/**
     * @expectedException InvalidArgumentException
     */
	public function testArgumentInvalidArrayType() {
		$data = new Data();
		$data->put('test', array(new \stdClass()));
	}
	
	/**
     * @expectedException InvalidArgumentException
     */
	public function testArgumentInvalidArrayTypeMistmatch() {
		$data = new Data();
		$data->put('test', array(1, '2', 3));
	}
	
	/**
     * @expectedException InvalidArgumentException
     */
	public function testArgumentInvalidNull() {
		$data = new Data();
		$data->put(null, 1);
	}
	
	public function testTypesIntegerArray() {
		$data = new Data();
		
		$array = array(1, 2, 3);
		$data->put('test', $array);
		
		foreach ($data->test as $key => $val) {
			$this->assertEquals($array[$key], $val);
		}
		
		foreach ($data['test'] as $key => $val) {
			$this->assertEquals($array[$key], $val);
		}
	}
	
	public function testTypesStringArray() {
		$data = new Data();
		
		$array = array('one', 'two', 'three');
		$data->put('test', $array);
		
		foreach ($data->test as $key => $val) {
			$this->assertEquals($array[$key], $val);
		}
		
		foreach ($data['test'] as $key => $val) {
			$this->assertEquals($array[$key], $val);
		}
	}
	
	public function testTypesBooleanArray() {
		$data = new Data();
		
		$array = array(true, false, true);
		$data->put('test', $array);
		
		foreach ($data->test as $key => $val) {
			$this->assertEquals($array[$key], $val);
		}
		
		foreach ($data['test'] as $key => $val) {
			$this->assertEquals($array[$key], $val);
		}
	}
	
	public function testTypesFloatArray() {
		$data = new Data();
		
		$array = array(1.1, 1.2, 1.3);
		$data->put('test', $array);
		
		foreach ($data->test as $key => $val) {
			$this->assertEquals($array[$key], $val);
		}
		
		foreach ($data['test'] as $key => $val) {
			$this->assertEquals($array[$key], $val);
		}
	}
	
	public function testTypesEmptyArray() {
		$data = new Data();
		$data->put('test', array());
		$this->assertTrue(is_array($data->test));
	}
}
