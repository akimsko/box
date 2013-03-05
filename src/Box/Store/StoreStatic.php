<?php

/*
 * This file is part of the box project.
 * 
 * Copyright Unpossible Systems I/S
 */
namespace Box;
/**
 * StoreStatic
 *
 * @author Bo Thinggaard <bo@unpossiblesystems.dk>
 */
class StoreStatic implements StoreInterface {
	private static $_dataStore = array();
	
	public function count(Query $query) {
		
	}

	public function delete(DataObjectInterface $dataObject) {
		
	}

	public function deleteAll(DataObjectCollection $dataObjects) {
		
	}

	public function get(Query $query) {
		
	}

	public function getAll(Query $query) {
		
	}

	public function persist(DataObjectInterface $dataObject) {
		
	}

	public function persistAll(DataObjectCollection $dataObjects) {
	}
}