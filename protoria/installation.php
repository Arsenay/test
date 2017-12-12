<?php
// Config
require_once('config.php');

// Connect
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS `".DB_NAME."`;";
if (!mysqli_query($conn, $sql)) {
	echo "Error creating database: " . mysqli_error($conn);
}
mysqli_close($conn);

// System files
require_once('system/includer.php');

// Create database object
$db = new DB(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$sql = "CREATE TABLE IF NOT EXISTS `" . DB_PREF . "guestbook` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` varchar(128) NOT NULL,
			`email` varchar(255) NOT NULL,
			`text` text NOT NULL,
			`url` text NOT NULL,
			`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			`ip` varchar(15) NOT NULL,
			`user_agent` varchar(255) NOT NULL,
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;";

$db->query($sql);

echo 'database was create successfully';

// if you need demo data, set 1 below for example: if (1) {
if (0) {
	$sql = "TRUNCATE `" . DB_PREF . "guestbook`;";

	$db->query($sql);

	$sql = "INSERT INTO `" . DB_PREF . "guestbook` (`id`, `name`, `email`, `text`, `url`, `date`, `ip`, `user_agent`) VALUES
		(1, 'Nazar', 'nazar@gmail.com', 'If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.', 'http://itstar.loc/', '2017-05-09 15:34:00', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
		(2, 'Eduard', 'edictralala@gmail.com', 'dgfhgjkmn gfhgj, fhgj,fghfdhmj hgjgfkl', 'http://php.net/manual/ru/reserved.variables.server.php', '2017-05-16 09:29:00', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
		(3, 'Oleg', 'kuzmenko.oleg@gmail.com', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', 'https://www.youtube.com/watch?v=LuH916Is87A', '2017-05-03 08:25:00', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
		(4, 'Tanya', 'tanya@gmail.com', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.', 'https://rabota.ua/company1174561/vacancy6725781', '2017-05-27 21:33:40', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
		(5, 'Sergey', 'nikolayenko@gmail.com', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', 'http://www.smarty.net/docsv2/ru/', '2017-05-27 22:06:14', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
		(6, 'Valya', 'nikiforova@gmail.com', 'It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 'http://www.smarty.net/docsv2/ru/', '2017-05-27 22:06:37', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
		(7, 'Alisa', 'lipka-alisa@gmail.com', 'If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.', 'http://www.smarty.net/docsv2/ru/', '2017-05-27 22:08:15', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
		(8, 'Nikolay', 'duda_nikolay@mail.com', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.', 'http://php.net/manual/ru/function.mb-strlen.php', '2017-05-27 22:10:35', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
		(9, 'Sveta', 'karpova.svaeta@ukr.net', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum', '', '2017-05-27 22:11:45', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
		(10, 'Yarik', 'volya.yaric@gmale.com', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', '', '2017-05-27 22:12:32', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
		(11, 'Irina', 'roznina.irina@gmail.com', 'It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 'http://php.net/manual/ru/reserved.variables.server.php', '2017-05-27 22:14:07', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
		(12, 'Elvira', 'sanik_elvirchik@ukr.net', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.', '', '2017-05-27 23:02:40', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
		(13, 'Lida', 'opanasenko@ukr.net', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '2017-05-28 00:47:12', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
		(14, 'Radik', 'tutuprivet@gmail.com', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.', '', '2017-05-28 00:49:19', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36');";

	$db->query($sql);

	echo '<br>demo data was successfully added to database';
}
?>