<?
include 'config.php';

if (!isset($_SERVER['PHP_AUTH_USER']) || !($_SERVER['PHP_AUTH_USER'] == AUTH_USER and $_SERVER['PHP_AUTH_PW'] == AUTH_PASS)) {
    header('WWW-Authenticate: Basic realm="Auth required"');
    header('HTTP/1.0 401 Unauthorized');
    die('Access denied');
}

function toMessage($mid, $hash = NULL){
	header('Location: ?action=message&message='. $mid . '#' . $hash);
	die;
}

if(isset($_GET['action'])){
	switch ($_GET['action']){
		case 'message':
			$messages = [
				'keyAdded' => 'Новый ключ добавлен!',
				'keyDeleted' => 'Ключ удалён',
				'keyEdited' => 'Ключ изменён',
			];

			if(isset($messages[$_GET['message']])){
				?><p style='padding:5px 10px; background: rgba(100, 100, 200, 0.2); border-radius: 5px; border: 1px dotted gray;' onclick='this.style.display = "none"'>
					<?=$messages[$_GET['message']]?>
				</p><?
			}
		break;

		case 'addKey':
			if(isset($_POST['key']) and isset($_POST['expires']) and isset($_POST['num'])){
				Database::addKey($_POST['key'], $_POST['expires'], $_POST['num']);
				toMessage('keyAdded', 'key' . $_POST['id']);
			}
		break;

		case 'editKey':
			if(isset($_POST['id']) and isset($_POST['expires']) and isset($_POST['num'])){
				Database::editKey($_POST['id'], $_POST['expires'], $_POST['num']);
				toMessage('keyEdited', 'key' . $_POST['id']);
			}
		break;

		case 'deleteKey':
			if(isset($_POST['id'])){
				Database::deleteKey($_POST['id']);
				toMessage('keyDeleted');
			}
		break;
	}
}
$keys = Database::getKeys();
include "template.html";
?>