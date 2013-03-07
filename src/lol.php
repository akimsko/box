<?php
require_once 'Box/Autoloader.php';

new Box\Autoloader();

class lol implements Box\DataObjectInterface {
	private $_id;
	private $_stuff;
	private $_lol;
	
	public function getId() {
		return $this->_id;
	}

	public function setId($id) {
		$this->_id = $id;
		return $this;
	}
	
	public function getStuff() {
		return $this->_stuff;
	}

	public function setStuff($stuff) {
		$this->_stuff = $stuff;
		return $this;
	}

	public function getLol() {
		return $this->_lol;
	}

	public function setLol($lol) {
		$this->_lol = $lol;
		return $this;
	}

	public function toData() {
		$data = new Box\Data();
		return $data
			->put('id', $this->_id)
			->put('stuff', $this->_stuff)
			->put('lol', $this->_lol)
		;
	}
	
	public function fromData(array &$data, $new = true) {
		$instance = $new ? new self() : $this;
		return $instance
			->setId(isset($data['id']) ? $data['id'] : null)
			->setStuff($data['stuff'])
			->setLol($data['lol'])
		;
	}
}

$datas = array(
	array('lol' => false, 'stuff' => 'apple'),
	array('lol' => false, 'stuff' => 'orange'),
	array('lol' => true, 'stuff' => 'buttplug'),
	array('lol' => true, 'stuff' => 'boobs'),
	array('lol' => true, 'stuff' => 'penii'),
	array('lol' => true, 'stuff' => 'butt sex'),
	array('lol' => true, 'stuff' => 'huge hairy butt'),
	array('lol' => false, 'stuff' => 'Spoon and a fork'),
	array('lol' => false, 'stuff' => 'Fork and a knife'),
	array('lol' => true, 'stuff' => 'Realdoll(tm)'),
);

$protolol = new lol();
$fixture = new Box\DataObjectCollection();
foreach ($datas as $data) {
	$fixture->add($protolol->fromData($data));
}

$store = new Box\StoreStatic();
$store->persistAll($fixture);

var_dump($store->getAll(\Box\Query::create(new lol())->equals('lol', false)->and_()->contains('stuff', 'fork')->andSub(\Box\QuerySubCondition::create()->contains('stuff', 'knife'))));




