<?php
class ModelHome extends Model {
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
		'order'	=> 'name',
		'sort'	=> 'DESC'
	);

	private $sort = array('ASC', 'DESC');

	public function getComments($data = array()) {
		// SQL-injection security
		$sql = "SELECT 
					* 
				FROM 
					`" . DB_PREF . "guestbook`";

		if ( isset($data['order']) && in_array($data['order'], $this->available_orders) ) {
			$sql .= " ORDER BY " . $data['order'];
		} else {
			$sql .= " ORDER BY " . $this->defaults['order'];
		}

		if ( isset($data['sort']) && in_array($data['sort'], $this->available_sorts) ) {
			$sql .= " " . $data['sort'];
		} else {
			$sql .= " " . $this->defaults['sort'];
		}

		if ( isset($data['limit']) && $data['limit'] > 0 ) {
			if ( !isset($data['start']) || $data['start'] < 0) {
				$data['start'] = 0;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getTotalComments() {
		$sql = "SELECT 
					* 
				FROM 
					`" . DB_PREF . "guestbook`";

		$query = $this->db->query($sql);

		return $query->num_rows;
	}

	public function addComment($data) {
		// SQL-injection security
		$sql = "INSERT INTO 
					`" . DB_PREF . "guestbook` 
				SET 
					`name` = '" . $this->db->escape($data['name']) . "', 
					`email` = '" . $this->db->escape($data['email']) . "', 
					`text` = '" . $this->db->escape($data['text']) . "', 
					`url` = '" . $this->db->escape($data['url']) . "', 
					`date` = NOW(), 
					`ip` = '" . $this->db->escape($_SERVER['REMOTE_ADDR']) . "', 
					`user_agent` = '" . $this->db->escape($_SERVER['HTTP_USER_AGENT']) . "'";

		$this->db->query($sql);
	}
}
?>