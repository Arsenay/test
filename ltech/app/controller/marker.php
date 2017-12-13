<?php
class Marker extends Controller {
	public function index(){
		$this->data['markers'] = $this->model('marker', 'get');
		$this->data['home_link'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
		$this->render('marker');
	}

	public function add(){
		if( $this->validate() ){
			$this->model('marker', 'add', array(
				'name'	=> $_POST['name'],
				'lat'	=> $_POST['lat'],
				'lng'	=> $_POST['lng'],
			));
		} 
		header('Location: ' . 'http://'.$_SERVER['HTTP_HOST'].str_replace('&method=add', '', $_SERVER['REQUEST_URI']));
		die();
	}

	private function validate(){
		if ( !isset($_POST['name']) || !preg_match('/^[\S| ]{2,30}$/', $_POST['name']) ) {
			return false;
		}
		if ( !isset($_POST['lat']) || !preg_match('/^\d+(\.\d+)?$/', $_POST['lat']) ) {
			return false;
		}
		if ( !isset($_POST['lng']) || !preg_match('/^\d+(\.\d+)?$/', $_POST['lng']) ) {
			return false;
		}
		return true;
	}

	public function remove(){
		$this->model('marker', 'remove');
	}
}