<?php
class Pagination {
	public $data = array();
	public $total = 0;
	public $page = 1;
	public $limit = 20;
	public $num_links = 5;
	public $url = '';
	public $text_first = '|<';
	public $text_last = '>|';
	public $text_next = '>';
	public $text_prev = '<';
	public $num_pages = 0;

	public function getHtml() {
		$total = $this->total;
		
		if ($this->page < 1) {
			$page = 1;
		} else {
			$page = $this->page;
		}

		if (!(int)$this->limit) {
			$limit = 10;
		} else {
			$limit = $this->limit;
		}
		
		$num_links = $this->num_links;
		$num_pages = ceil($total / $limit);
		$this->num_pages = $num_pages;

		$links = array();

		if ( $page > 1 ) {
			$links['first'] = array(
				'name'	=> $this->text_first,
				'title'	=> 'Page 1',
				'class'	=> 'first_page_href',
				'href'	=> $this->createUrl()
			);

			$links['prev'] = array(
				'name'	=> $this->text_prev,
				'title'	=> 'Page ' . ($page - 1),
				'class'	=> 'prev_page_href',
				'href'	=> $this->createUrl($page - 1)
			);
		} else if ( $num_pages > 1 ) {
			$links['first'] = array(
				'name'	=> $this->text_first,
				'title'	=> 'Page 1',
				'class'	=> 'disabled first_page_href',
				'href'	=> 'javascript: void(0);'
			);

			$links['prev'] = array(
				'name'	=> $this->text_prev,
				'title'	=> '',
				'class'	=> 'disabled prev_page_href',
				'href'	=> 'javascript: void(0);'
			);
		}

		if ( $num_pages > 1 ) {
			if ($num_pages <= $num_links) {
				$start = 1;
				$end = $num_pages;
			} else {
				$start = $page - floor($num_links / 2);
				$end = $page + floor($num_links / 2);
			
				if ( $start < 1 ) {
					$end += abs($start) + 1;
					$start = 1;
				}
						
				if ( $end > $num_pages ) {
					$start -= ($end - $num_pages);
					$end = $num_pages;
				}
			}

			if ( $start > 1 ) {
				/*
				$links[$i] = array(
					'name'	=> '...',
					'title'	=> 'Interval',
					'class'	=> 'disabled',
					'href'	=> 'javascript: void(0);'
				);
				*/
			}

			for ($i = $start; $i <= $end; $i++) {
				if ( $page == $i ) {
					$links[$i] = array(
						'name'	=> $i,
						'title'	=> 'Page ' . $i,
						'class'	=> 'active',
						'href'	=> 'javascript: void(0);'
					);
				} else {
					$links[$i] = array(
						'name'	=> $i,
						'title'	=> 'Page ' . $i,
						'class'	=> '',
						'href'	=> $this->createUrl($i)
					);
				}	
			}
							
			if ( $end < $num_pages ) {
				/*
				$links[$i] = array(
					'name'	=> '...',
					'title'	=> 'Interval',
					'class'	=> 'disabled',
					'href'	=> 'javascript: void(0);'
				);
				*/
			}
		}
		
		if ( $page < $num_pages ) {
			$links['next'] = array(
				'name'	=> $this->text_next,
				'title'	=> 'Page ' . ($page + 1),
				'class'	=> 'next_page_href',
				'href'	=> $this->createUrl($page + 1)
			);

			$links['last'] = array(
				'name'	=> $this->text_last,
				'title'	=> 'Page ' . $num_pages,
				'class'	=> 'last_page_href',
				'href'	=> $this->createUrl($num_pages)
			);
		} else if ( $num_pages > 1 ) {
			$links['next'] = array(
				'name'	=> $this->text_next,
				'title'	=> '',
				'class'	=> 'next_page_href',
				'href'	=> 'javascript: void(0);'
			);

			$links['last'] = array(
				'name'	=> $this->text_last,
				'title'	=> 'Page ' . $num_pages,
				'class'	=> 'last_page_href',
				'href'	=> 'javascript: void(0);'
			);
		}

		$this->data = array(
			'links' => $links,
			'start' => ($total) ? (($page - 1) * $limit) + 1 : 0,
			'end'	=> ((($page - 1) * $limit) > ($total - $limit)) ? $total : ((($page - 1) * $limit) + $limit),
			'total'	=> $total,
			'pages' => $num_pages
		);

		return $this->render();
	}

	private function createUrl($page = 1) {
		if ( $page == 1 ) {
			$url = str_replace('?page={page}', '', $this->url);
			$url = str_replace('index.php&', 'index.php?', $url);
		} else {
			$url = str_replace('{page}', $page, $this->url);
		}

		return $url;
	}

	private function render() {
		if ( file_exists('view/templates/pagination.tpl') ) {
			$smarty = new Smarty;

			$smarty->template_dir = 'view/templates';
			$smarty->compile_dir = 'view/template_c';
			$smarty->config_dir = 'view/config';
			$smarty->cache_dir = 'view/cache';

			foreach ($this->data as $name => $value) {
				$smarty->assign($name, $value);
			}
			
			return $smarty->fetch('pagination.tpl');
		} else {
			trigger_error('Error: Could not load view [view/templates/pagination.tpl]!');
			exit();
		}
	}
}
?>