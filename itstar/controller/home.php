<?php
class ControllerHome extends Controller {
	private $error = array();

	private $available_orders = array(
		'name',
		'email',
		'date'
	);

	private $available_sorts = array(
		'ASC',
		'DESC'
	);

	private $defaults = array(
		'order'	=> 'date',
		'sort'	=> 'DESC',
		'limit'	=> LIMIT
	);

	public function index() {
		// Captcha
		if ( isset($_GET['captcha']) && $_GET['captcha'] == 'generate' ) {
			$captcha = new Captcha();
			$_SESSION['captcha'] = $captcha->getCode();
			$captcha->showImage();
			return false;
		}

		// Load model
		$this->loader->load('model', 'home');

		// Set title
		$this->data['title'] = 'Guest book';

		// Add new comment if data is valid or show errors
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' && $this->validate() ) {
			$this->model_home->addComment($_POST);

			$_SESSION['success'] = 'Data recorded successfully!';

			$this->redirect('index.php');
		} else {
			$this->data['form'] = $_POST;

			// Remove HTML/PHP tags (XSS security)
			if ( isset($this->data['form']['name']) ) {
				$this->data['form']['name'] = strip_tags($this->data['form']['name']);
			}

			if ( isset($this->data['form']['email']) ) {
				$this->data['form']['email'] = strip_tags($this->data['form']['email']);
			}

			if ( isset($this->data['form']['url']) ) {
				$this->data['form']['url'] = strip_tags($this->data['form']['url']);
			}

			if ( isset($this->data['form']['text']) ) {
				$this->data['form']['text'] = strip_tags($this->data['form']['text']);
			}

			// Set errors alert
			if ( isset($this->error['name']) ) {
				$this->data['error']['name'] = $this->error['name'];
			}

			if ( isset($this->error['email']) ) {
				$this->data['error']['email'] = $this->error['email'];
			}

			if ( isset($this->error['text']) ) {
				$this->data['error']['text'] = $this->error['text'];
			}

			if ( isset($this->error['captcha']) ) {
				$this->data['error']['captcha'] = $this->error['captcha'];
			}
		}

		// Set success alert
		if ( isset($_SESSION['success']) && $_SESSION['success'] ) {
			$this->data['success'] = $_SESSION['success'];
			unset($_SESSION['success']);
		}
		
		// Create url for pagination and order/sort hrefs
		$url = '';
		
		if ( isset($_GET['order']) && in_array($_GET['order'], $this->available_orders) && $_GET['order'] != $this->defaults['order'] ) {
			$order = $_GET['order'];

			$url .= '&order=' . $order;
		} else {
			$order = $this->defaults['order'];
		}

		if ( isset($_GET['sort']) && in_array($_GET['sort'], $this->available_sorts) && $_GET['sort'] != $this->defaults['sort'] ) {
			$sort = $_GET['sort'];

			$url .= '&sort=' . $sort;
		} else {
			$sort = $this->defaults['sort'];
		}

		if ( isset($_GET['limit']) && (int)$_GET['limit'] > 0 && $_GET['limit'] != $this->defaults['limit'] ) {
			$limit = (int)$_GET['limit'];

			$url .= '&limit=' . $limit;
		} else {
			$limit = $this->defaults['limit'];
		}

		if ( isset($_GET['page']) && (int)$_GET['page'] > 0 ) {
			$page = (int)$_GET['page'];
		} else {
			$page = 1;
		}

		// Make filter data
		$data = array(
			'order'	=> $order,
			'sort'	=> $sort,
			'start'	=> ($page - 1) * $limit,
			'limit'	=> $limit
		);

		// Get total comments
		$total = $this->model_home->getTotalComments();

		// Get some comments
		$results = $this->model_home->getComments($data);

		$this->data['comments'] = array();

		foreach ($results as $key => $comment) {
			$this->data['comments'][$key] = $comment;
			$this->data['comments'][$key]['date'] = date('H:i d.m.y', strtotime($comment['date']));
		}

		// Pagination
		$pagination = new Pagination();
		$pagination->total = $total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = 'index.php?page={page}' . $url;
		$this->data['pagination'] = $pagination->getHtml();

		// Create sort hrefs
		foreach ($this->available_orders as $name) {
			if ( $order == $name ) {
				$active = true;
				$current_sort = ($sort == 'DESC') ? 'ASC' : 'DESC';
			} else {
				$active = false;
				$current_sort = $this->defaults['sort'];
			}

			$symbol = (($sort == 'DESC') ? '&darr;' : '&uarr;');

			$href = 'index.php';

			if ( $page > 1 ) {
				$href .= '&page=' . $page;
			}

			if ( $name != $this->defaults['order'] ) {
				$href .= '&order=' . $name;
			}

			if ( $current_sort != $this->defaults['sort'] ) {
				$href .= '&sort=' . $current_sort;
			}

			$href = str_replace('index.php&', 'index.php?', $href);

			$this->data['sorts'][$name] = array(
				'href'	=> $href,
				'active'=> $active,
				'symbol'=> $symbol
			);
		}

		// Template
		$this->view = 'home';

		$this->render();
	}

	private function validate() {
		// XSS security

		// Validate name
		$name = $_POST['name'] = isset($_POST['name']) ? strip_tags($_POST['name']) : '';
		if ( !$name || mb_strlen($name) < 3 || mb_strlen($name) > 128 ) {
			$this->error['name'] = '-- name entered incorrectly need 2-128 symbols --';
		}

		// Validate email
		$email = $_POST['email'] = isset($_POST['email']) ? $_POST['email'] : '';
		if ( !$email || mb_strlen($email) > 96 || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $email) ) {
			$this->error['email'] = '-- email entered incorrectly --';
		}

		// Validate url
		$url = $_POST['url'] = isset($_POST['url']) ? strip_tags($_POST['url']) : '';

		// Validate text
		$text = $_POST['text'] = isset($_POST['text']) ? strip_tags($_POST['text']) : '';
		if ( !$text || mb_strlen($text) < 10 || mb_strlen($text) > 10000 ) {
			$this->error['text'] = '-- text entered incorrectly need 10-10000 symbols --';
		}
		
		// Validate captcha
		$session_captcha = isset($_SESSION['captcha']) ? $_SESSION['captcha'] : '';
		$request_captcha = isset($_POST['captcha']) ? $_POST['captcha'] : '';
		if ( !$session_captcha || !$request_captcha || $session_captcha != $request_captcha ) {
			$this->error['captcha'] = '-- captcha entered incorrectly --';
		}

		/*
		// Validate phone
		$phone = $_POST['phone'] = isset($_POST['phone']) ? $_POST['phone'] : '';
		if ( !$phone || mb_strlen($phone) > 20 || !preg_match('/^[\d|\-|\+|\s|\(|\)]{3,20}$/i', $phone) ) {
			$this->error['phone'] = '-- phone entered incorrectly --';
		}
		*/

		return (!$this->error) ? true : false;
	}
}
?>