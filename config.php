<?
define('AUTH_USER', 'admin');	// Авторизационные данные
define('AUTH_PASS', 'pass');
define('SECRET_KEY', '5#2s$D%$9dfs$WGb_tw5@Te$dNo@Gf&!'); // Секретный ключ

define('MYSQL_SERVER', 'localhost'); // Хост
define('MYSQL_USER', 'login'); // Логин
define('MYSQL_PASS', 'pass'); // Пароль		
define('MYSQL_DB', 'database'); // Имя базы

define('DS', DIRECTORY_SEPARATOR);
define('DIR', __DIR__ . DS);
include 'autoload.php';
Database::connect();
