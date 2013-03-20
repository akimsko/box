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
class IntegrationTest extends \PHPUnit_Framework_TestCase implements DataObjectInterface {
	
	/**
	 * Provides stores to test.
	 */
	public function store() {
		return array(
			array(new StoreStatic())
		);
	}
	
	/**
	 * @dataProvider store
	 */
	public function testPesistUpdateDeleteSingle(StoreInterface $store) {
		$dataObject = new self();
		$store->persist($dataObject);

		$this->assertSame(1, $dataObject->dataObjectId);
		$this->assertNull($dataObject->dataObjectName);
		$this->assertSame(1, $store->count(Query::create($dataObject)));
		
		$dataObjectClone = $store->get(Query::create($dataObject)->equals('data_object_id', $dataObject->getId()));

		$this->assertTrue($dataObjectClone instanceof self);
		$this->assertNotSame($dataObjectClone, $dataObject);
		$this->assertSame($dataObjectClone->dataObjectId, $dataObject->dataObjectId);
		$this->assertSame($dataObjectClone->dataObjectName, $dataObject->dataObjectName);
		
		$dataObject->dataObjectName = 'changed';
		$store->persist($dataObject);
		
		$this->assertSame(1, $store->count(Query::create($dataObject)));
		
		$dataObjectClone = $store->get(Query::create($dataObject)->equals('data_object_id', $dataObject->getId()));
		$this->assertSame('changed', $dataObjectClone->dataObjectName);
		
		$store->delete($dataObject);
		$this->assertSame(0, $store->count(Query::create($dataObject)));
		
		$dataObject->dataObjectId = 42;
		$store->persist($dataObject);
		
		$dataObjectClone = $store->get(Query::create($dataObject)->equals('data_object_id', $dataObject->getId()));
		$this->assertSame(42, $dataObjectClone->dataObjectId);
		$this->assertSame('changed', $dataObjectClone->dataObjectName);
		
		$store->delete($dataObject);
		$this->assertSame(0, $store->count(Query::create($dataObject)));
	}
	
	/**
	 * @dataProvider store
	 */
	public function testPesistUpdateDeleteCollection(StoreInterface $store) {
		$dataObjectArray = array(
			new self(),
			new self(),
			new self(),
		);
		
		$dataObjects = new DataObjectCollection($dataObjectArray);
		
		$this->assertCount(count($dataObjectArray), $dataObjects);

		$store->persistAll($dataObjects);
		
		for ($i = 0; $i < count($dataObjects); $i++) {
			$this->assertSame($i+1, $dataObjects->get($i)->dataObjectId);
		}

		$this->assertSame($dataObjects->count(), $store->count(Query::create($this)));
		
		$dataObjectsClone = $store->getAll(Query::create($this));
		$this->assertNotSame($dataObjectsClone, $dataObjects);
		$this->assertSame(count($dataObjects), count($dataObjectsClone));
		
		for ($i = 0; $i < count($dataObjects); $i++) {
			$this->assertTrue($dataObjectsClone->get($i) instanceof self);
			$this->assertNotSame($dataObjectsClone->get($i), $dataObjects->get($i));
			$this->assertSame($dataObjectsClone->get($i)->dataObjectId, $dataObjects->get($i)->dataObjectId);
		}

		for ($i = 0; $i < count($dataObjects); $i++) {
			$dataObjects->get($i)->dataObjectName = "changed_$i";
		}
		$store->persistAll($dataObjects);
		$dataObjectsClone = $store->getAll(Query::create($this));
		$this->assertSame(count($dataObjects), count($dataObjectsClone));
		
		for ($i = 0; $i < count($dataObjectsClone); $i++) {
			$dataObjectsClone->get($i)->dataObjectName = "changed_$i";
		}
		
		$dataObjectsClone = $store->getAll(Query::create($this)->orderBy('data_object_id', QueryLimitOrOrderBy::DESC)->limit(2));
		$this->assertCount(2, $dataObjectsClone);
		for ($i = 0; $i < 2; $i++) {
			$this->assertSame($dataObjectsClone->get($i)->dataObjectId, $dataObjects->get(count($dataObjects) - 1 - $i)->dataObjectId);
		}
		
		$store->deleteAll($dataObjects);
		$this->assertEquals(0, $store->count(Query::create($this)));
	}
	
	public $dataObjectId, $dataObjectName;

	public function getId() {
		return $this->dataObjectId;
	}

	public function setId($id) {
		$this->dataObjectId = $id;
		return $this;
	}

	public function toData() {
		return new Data(array('data_object_id' => $this->dataObjectId, 'data_object_name' => $this->dataObjectName));
	}

	public static function fromData(array &$data) {
		$do = new self();
		$do->dataObjectId   = $data['data_object_id'];
		$do->dataObjectName = $data['data_object_name'];
		return $do;
	}
	
}
