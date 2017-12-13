<?php
class MarkerModel extends Model {
	private $collection;

	public function __construct(){
		$client = new MongoDB\Client;
		$ltech_db = $client->ltech_db;
		$this->collection = $ltech_db->cities;
	}

	public function add($arr){
		$this->collection->insertOne($arr);
	}

	public function get(){
		$markers = [];
		foreach ($this->collection->find() as $marker) {
			$markers[] = array(
				'name'	=> $marker->name,
				'lat'	=> $marker->lat,
				'lng'	=> $marker->lng,
			);
		}
		return $markers;
	}

	public function remove(){
		$this->collection->insertOne();
	}
}