<?
class Activation{
	public static function getLicense($pc, $key){
		if(!Database::isActivated($pc, $key)){
			// Если компьютер ранее не был активирован этим ключом, выдаём ключ, списываем кол-во активаций
			$data = Database::activateByKey($pc, $key);
		} else {
			// Если компьютер уже был активирован этим ключом, активации не списываем
			$data = Database::getKey($key);
		}

		if($data !== false){
			return Activation::generateLicenseFile($pc, $data['expires']);
		}

		return false;
	}

	public static function generateLicenseFile($sid, $expires){
		$file  = "; DevelNext License file\n";
		$file .= "; DON'T EDIT !!!\n\n";
		$file .= "[Key]\n";
		$file .= "SID = ". $sid ."\n";
		$file .= "Expires = ". $expires ."\n";
		$file .= "Signature = ". self::getSignature($sid . $expires);

		return $file;
	}

	private static function getSignature($raw){
		return hash('sha256', $raw . SECRET_KEY);
	}
}