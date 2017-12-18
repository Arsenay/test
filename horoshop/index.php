<?php
error_reporting(E_ALL);

interface DatabaseConnectionInterface
{

	/**
	 * Подключение к СУБД
	 *
	 * @param string $host         Адрес хоста
	 * @param string $login        Логин
	 * @param string $password     Пароль
	 * @param string $databaseName Имя базы данных
	 *
	 * @return void
	 */
	public function connect($host, $login, $password, $databaseName);

	/**
	 * Получение объекта подключения к СУБД
	 *
	 * @returns \PDO
	 * @throws \RuntimeException При отсутствии подключения к БД
	 */
	public function getConnection();
}

class DB implements DatabaseConnectionInterface
{
	private $pdo;

	public function connect($host, $login, $password, $databaseName){
		$dsn = "mysql:host=$host;dbname=$databaseName";
		try {
			$this->pdo = new PDO($dsn, $login, $password);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			exit($e->getMessage());
		}
	}

	public function getConnection(){
		return $this->pdo;
	}

	public function query($sql, $params=array()){
		$result = array();

		if ($sql) {
			if ($params) {
				// Подготовленный запрос
				$stmt = $this->pdo->prepare($sql);
				$stmt->execute($params);
				$result = $stmt;
			} else {
				// Обычный запрос
				$result = $this->pdo->query($sql, PDO::FETCH_ASSOC);
			}
		}

		if ($result) {
			return $result->fetchAll();
		} else {
			return array();
		}
	}
}

// Несколько запросов
$db = new DB;
$db->connect('localhost', 'php-junior', 'php-junior', 'php-junior');
$pages = $db->query('SELECT title, id FROM pages WHERE active=1 ORDER BY sortorder ASC');
foreach ($pages as $page) {
	echo "<p>".$page['title']."</p>";
	$params = array(':page'=>$page['id']);
	$page_goods = $db->query('SELECT * FROM goods WHERE page=:page ORDER BY sortorder ASC', $params);
	if ($page_goods) {
		echo "<ul>";
		foreach ($page_goods as $good) {
			echo "<li>".$good['title']."</li>";
		}
		echo "</ul>";
	}
}

// Один запрос
$all = $db->query('
		SELECT 
			g.*, p.title AS page 
		FROM 
			goods g
		LEFT JOIN 
			pages p ON (g.page=p.id) 
		WHERE 
			p.active=1 
		ORDER BY 
			p.sortorder ASC, 
			g.sortorder ASC
	');

if ($all) {
	$current_page = '';
	foreach ($all as $key => $good) {
		if ($good['page'] != $current_page) {
			if ( $key != 0 ) { echo "</ul>"; }
			$current_page = $good['page'];
			echo "<p>".$good['page']."</p>";
			echo "<ul>";
		}
		echo "<li>".$good['title']."</li>";
	}
	echo "</ul>";
}

class Num{
	public function calc($min, $max, $count = 4){
		$arr = range($min, $max, floor(($max-$min)/($count-1)));
		return implode($arr, ' ') . "\n";
	}
}

echo "<hr>";
$n = new Num;
echo "<pre>";
echo $n->calc(7, 45);
echo "</pre>";