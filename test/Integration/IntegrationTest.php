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
 * Integration tests
 *
 * @author Bo Thinggaard
 */
class IntegrationTest extends \PHPUnit_Framework_TestCase {
	
	/** @var StoreInterface[] */
	protected $_stores;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->_stores = array(
			new StoreStatic()
		);
		
		$this->_dataSetSimple = array(
			new TestSimpleDataObject(null, 'test1'),
			new TestSimpleDataObject(2, 'test2'),
			new TestSimpleDataObject(3, 'test3'),
			new TestSimpleDataObject(4, 'test4'),
		);
	}
	
	public function queryProvider() {
		$dataSetSimple = array(
			new TestSimpleDataObject(null, 'test1'),
			new TestSimpleDataObject(2, 'test2'),
			new TestSimpleDataObject(3, 'test3'),
			new TestSimpleDataObject(4, 'test4'),
		);
		
		$dataSetTypes = array(
			new TestTypesDataObject(null, 1, 'test1', 1.1, true, array(1,2,3), array('test1','test2','test3'), array(1.1,1.2,1.3), array(true, false)),
			new TestTypesDataObject(2, 2, 'test2', 1.2, true, array(2,3,4), array('test2','test3','test4'), array(1.2,1.3,1.4), array(true, false, true)),
			new TestTypesDataObject(3, 3, 'test3', 1.3, true, array(3,4,5), array('test3','test4','test5'), array(1.3,1.4,1.5), array(true, false, true, false)),
			new TestTypesDataObject(4, 4, 'test4', 1.4, true, array(4,5,6), array('test4','test5','test6'), array(1.4,1.5,1.6), array(true, false, true, false, true)),
		);
		
		$simpleSet = self::_getBaseQuerySet($dataSetSimple);
		$simpleSet[] = array($dataSetSimple, Query::create($dataSetSimple[0])->equals('id', 1)->or_()->equals('id', 2)->or_()->equals('text', 'test4')->orderBy('id'), array(1, 2, 4), true);
		$simpleSet[] = array($dataSetSimple, Query::create($dataSetSimple[0])->equals('id', 1)->and_()->equals('text', 'test1'), array(1), true);
		$simpleSet[] = array($dataSetSimple, Query::create($dataSetSimple[0])->equals('id', 1)->andSub(QuerySubCondition::create()->equals('text', 'test1')), array(1), true);
		$simpleSet[] = array($dataSetSimple, Query::create($dataSetSimple[0])->startsWith('text', 'test')->orderBy('id'), array(1, 2, 3, 4), true);
		$simpleSet[] = array($dataSetSimple, Query::create($dataSetSimple[0])->endsWith('text', '3'), array(3), true);
		$simpleSet[] = array($dataSetSimple, Query::create($dataSetSimple[0])->contains('text', 'est')->orderBy('id'), array(1, 2, 3, 4), true);

		$typesSet = self::_getBaseQuerySet($dataSetTypes);
		$typesSet[] = array($dataSetTypes, Query::create($dataSetTypes[0])->startsWith('string', 'tes')->andSub(QuerySubCondition::create()->endsWith('string', 't3')->or_()->endsWith('string', 't4'))->orderBy('id'), array(3, 4), true);
		
		return array_merge($simpleSet, $typesSet);
	}
	
	private static function _getBaseQuerySet(array $dataSet) {
		return array(
			array($dataSet, Query::create($dataSet[0]), array(1,2,3,4), false),
			array($dataSet, Query::create($dataSet[0])->orderBy('id'), array(1,2,3,4), true),
			array($dataSet, Query::create($dataSet[0])->orderBy('id', QueryLimitOrOrderBy::DESC), array(4,3,2,1), true),
			array($dataSet, Query::create($dataSet[0])->orderBy('id')->limit(2), array(1,2), true),
			array($dataSet, Query::create($dataSet[0])->orderBy('id')->limit(2)->offset(2), array(3,4), true),
			array($dataSet, Query::create($dataSet[0])->equals('id', 1), array(1), false),
			array($dataSet, Query::create($dataSet[0])->equals('id', 1)->orSub(QuerySubCondition::create()->equals('id', 2))->orderBy('id'), array(1, 2), true),
			array($dataSet, Query::create($dataSet[0])->equals('id', 1)->or_()->equals('id', 2)->orderBy('id'), array(1, 2), true),
			array($dataSet, Query::create($dataSet[0])->in('id', array(2,4))->orderBy('id'), array(2, 4), true),
			array($dataSet, Query::create($dataSet[0])->notIn('id', array(2,4))->orderBy('id'), array(1, 3), true),
		);
	}
	
	/**
	 * @dataProvider queryProvider
	 */
	public function testQueriesAndResults(array $dataSet, QueryBase $query, array $resultIds, $checkOrder) {
		foreach ($this->_stores as $store) {
			$store->truncate($dataSet[0]);
			$this->assertSame(0, $store->count(Query::create($dataSet[0])));
			
			$store->persistAll(new DataObjectCollection($dataSet[0], $dataSet));
			
			$results = $store->getAll($query);
			$this->assertCount(count($resultIds), $results);
			
			$classVars = array_keys((get_class_vars(get_class($dataSet[0]))));
			
			for ($i = 0; $i < count($results); $i++) {
				if ($checkOrder) {
					$this->assertSame($results->get($i)->getId(), $resultIds[$i]);
				} else {
					$this->assertContains($results->get($i)->getId(), $resultIds);
				}

				$result = $results->get($i);
				$data = $dataSet[$result->getId() - 1];
				foreach ($classVars as $name) {
					$this->assertSame($result->$name, $data->$name);
				}
			}
		}
	}
}

class TestSimpleDataObject implements DataObjectInterface {
	public $id;
	public $text;
	
	public function __construct($id = null, $text = null) {
		$this->setId($id);
		$this->text = $text;
	}

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
		return $this;
	}
		
	public function toData() {
		return new Data(array(
			'id'    => $this->getId(),
			'text'  => $this->text,
		));
	}

	public static function fromData(array &$data) {
		return new self($data['id'], $data['text']);
	}
}

class TestTypesDataObject implements DataObjectInterface {
	public $id;
	public $int, $string, $float, $bool;
	public $intA, $stringA, $floatA, $boolA;
	
	public function __construct($id = null, $int = 1, $string = 'test', $float = 1.1, $bool = true, $intA = array(1,2,3), $stringA = array('test1','test2','test3'), $floatA = array(1.1,1.2,1.3), $boolA = array(true,false,true)) {
		$this->setId($id);
		$this->int     = $int;
		$this->string  = $string;
		$this->float   = $float;
		$this->bool    = $bool;
		$this->intA    = $intA;
		$this->stringA = $stringA;
		$this->floatA  = $floatA;
		$this->boolA   = $boolA;
	}

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
		return $this;
	}
		
	public function toData() {
		return new Data(array(
			'id'      => $this->getId(),
			'int'     => $this->int,
			'string'  => $this->string,
			'float'   => $this->float,
			'bool'    => $this->bool,
			'intA'    => $this->intA,
			'stringA' => $this->stringA,
			'floatA'  => $this->floatA,
			'boolA'   => $this->boolA,
		));
	}

	public static function fromData(array &$data) {
		return new self(
			$data['id'],
			$data['int'],
			$data['string'],
			$data['float'],
			$data['bool'],
			$data['intA'],
			$data['stringA'],
			$data['floatA'],
			$data['boolA']
		);
	}
}
