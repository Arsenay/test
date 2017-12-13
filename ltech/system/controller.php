<?php
class Controller {
	protected $models = array();
	protected $data = array();

	protected function model($name, $action, $params=array()) {
		if ( !isset($this->models[$name]) ) {
			$model_path = ROOT_DIR . '/app/model/' . $name . '.php';
			if (file_exists($model_path)) {
				require_once $model_path;
				$model = ucfirst($name).'Model';
				$this->models[$name] = new $model;
			}
		}

		if (method_exists($this->models[$name], $action)) {
			return $this->models[$name]->{$action}($params);
		}
	}

	protected function render($name) {
		$template = ROOT_DIR . '/app/view/' . $name . '.php';
		if (file_exists($template)) {
			extract($this->data);

			ob_start();

			require($template);

			$output = ob_get_contents();

			ob_end_clean();

			echo $output;
		} else {
			trigger_error('Error: Could not load template ' . $template . '!');
			exit();
		}
	}
}