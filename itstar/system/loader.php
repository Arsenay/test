<?php
class Loader {
	protected $builder;

	public function __construct($builder) {
		$this->builder = $builder;
	}

	public function __get($key) {
		return $this->builder->get($key);
	}

	public function __set($key, $value) {
		$this->builder->set($key, $value);
	}

	public function load($entity = '', $name = '') {
		$file = $entity . '/' . $name . '.php';

		$class = ucfirst($entity) . ucfirst($name);
		
		if ( file_exists($file) ) {
			require_once($entity . '/' . $name . '.php');

			$this->builder->set('model_' . $name, new $class($this->builder));
		} else {
			trigger_error('Error: Could not load file "' . $file . '"!');
			exit();
		}
	}
}
?>