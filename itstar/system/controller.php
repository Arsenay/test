<?php
abstract class Controller {
	protected $builder;
	protected $view;
	protected $data = array();

	public function __construct($builder) {
		$this->builder = $builder;
	}

	public function __get($key) {
		return $this->builder->get($key);
	}

	public function __set($key, $value) {
		$this->builder->set($key, $value);
	}

	protected function redirect($url, $status = 302) {
		header('Status: ' . $status);
		header('Location: ' . str_replace(array('&amp;', "\n", "\r"), array('&', '', ''), $url));
		exit();
	}

	protected function render() {
		if ( file_exists('view/templates/' . $this->view . '.tpl') ) {
			$smarty = new Smarty;

			$smarty->template_dir = 'view/templates';
			$smarty->compile_dir = 'view/template_c';
			$smarty->config_dir = 'view/config';
			$smarty->cache_dir = 'view/cache';

			foreach ($this->data as $name => $value) {
				$smarty->assign($name, $value);
			}
			
			$smarty->display($this->view . '.tpl');
		} else {
			trigger_error('Error: Could not load view [view/templates/' . $this->view . '.tpl]!');
			exit();
		}
	}
}
?>