<?php
require_once 'Box/Autoloader.php';

new Box\Autoloader();

class lol implements Box\DataObjectInterface {
	private $_id;
	private $_stuff;
	private $_more;
	private $_moar;
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
	public function getMore() {
		return $this->_more;
	}

	public function setMore($more) {
		$this->_more = $more;
		return $this;
	}

	public function getMoar() {
		return $this->_moar;
	}

	public function setMoar($moar) {
		$this->_moar = $moar;
		return $this;
	}

	public function toData() {
		$data = new Box\Data();
		return $data
			->put('id', $this->_id)
			->put('stuff', $this->_stuff)
			->put('more', $this->_more)
			->put('moar', $this->_moar)
			->put('lol', $this->_lol)
		;
	}
	
	public function fromData(array &$data, $new = true) {
		$instance = $new ? new self() : $this;

		if (isset($data['id'])) $instance->setId($data['id']);

		return $instance
			->setStuff($data['stuff'])
			->setMore($data['more'])
			->setMoar($data['moar'])
			->setLol($data['lol'])
		;
	}
}

$datas = array(
	array('lol' => false, 'stuff' => 'apple', 'more' => 'a', 'moar' => 'aaa'),
	array('lol' => false, 'stuff' => 'orange', 'more' => 'f', 'moar' => 'aaa'),
	array('lol' => true, 'stuff' => 'buttplug', 'more' => 'c', 'moar' => 'aaa'),
	array('lol' => true, 'stuff' => 'boobs', 'more' => 'g', 'moar' => 'aaa'),
	array('lol' => true, 'stuff' => 'penii', 'more' => 'b', 'moar' => 'bbb'),
	array('lol' => true, 'stuff' => 'butt sex', 'more' => 'j', 'moar' => 'bbb'),
	array('lol' => true, 'stuff' => 'huge hairy butt', 'more' => 'd', 'moar' => 'bbb'),
	array('lol' => false, 'stuff' => 'Spoon and a fork', 'more' => 'i', 'moar' => 'bbb'),
	array('lol' => false, 'stuff' => 'Fork and a knife', 'more' => 'h', 'moar' => 'ccc'),
	array('lol' => true, 'stuff' => 'Realdoll(tm)', 'more' => 'e', 'moar' => 'ccc'),
);

$protolol = new lol();
$fixture = new Box\DataObjectCollection(get_class($protolol));
foreach ($datas as $data) {
	$fixture->add($protolol->fromData($data));
}

$store = new Box\StoreStatic();
$store->persistAll($fixture);

//var_dump($store->getAll(\Box\Query::create(new lol())->equals('lol', false)->and_()->contains('stuff', 'fork')->andSub(\Box\QuerySubCondition::create()->contains('stuff', 'knife'))));
var_dump($store->getAll(\Box\Query::create(new lol())->contains('lol', true)->orderBy('more')->limit(2)));