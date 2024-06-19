<?
include 'config.php';

switch(isset($_GET['action'])?$_GET['action']:null){
	case 'getLicense':
		if(isset($_GET['pc']) and isset($_GET['key'])){
			$license = Activation::getLicense($_GET['pc'], $_GET['key']);
			apiAnswer(['license' => $license]);
		}

		apiError('Access denied');
	break;
}

function apiError($message, $errorCode = 403){
	return apiAnswer(['error' => $message], $errorCode);
}

function apiAnswer($data, $code = 200){
	header('Content-Type: application/json; charset=utf-8', true, $code);
	header("Cache-Control: no-store, no-cache, must-revalidate");

	die(json_encode($data));
}