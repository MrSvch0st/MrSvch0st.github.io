<?
class Database{
	private static $db;
	public static function connect(){
		$dsn = 'mysql:dbname=' . MYSQL_DB . ';charset=utf8;host=' . MYSQL_SERVER;
		self::$db = new PDO($dsn, MYSQL_USER, MYSQL_PASS);
	}

	public static function addKey($key, $expires, $num){
		$sth = self::$db->Prepare('INSERT INTO `keys` (`key`, `expires`, `num`) VALUES (:key, :expires, :num)');
        $sth->bindParam(':key', $key);
        $sth->bindParam(':expires', $expires);
        $sth->bindParam(':num', $num);
        $sth->execute();
	}
	
	public static function deleteKey($id){
		$sth = self::$db->Prepare('DELETE FROM `keys` WHERE `id` = :id');
        $sth->bindParam(':id', $id);
        $sth->execute();
	}

	public static function editKey($id, $expires, $num){
		$sth = self::$db->Prepare('UPDATE `keys` SET `expires` = :expires, `num` = :num WHERE `id` = :id');
        $sth->bindParam(':expires', $expires);
        $sth->bindParam(':num', $num);
        $sth->bindParam(':id', $id);
        $sth->execute();
	}

	public static function getKey($key){
		$sth = self::$db->Prepare('SELECT * FROM `keys` WHERE `key` = :key');
		$sth->bindParam(':key', $key);
        $sth->execute();
        $res = $sth->fetchAll(PDO::FETCH_ASSOC);
        return isset($res[0])?$res[0]:false;
	}

	public static function getKeys(){
		$sth = self::$db->Prepare('SELECT * FROM `keys`');
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function isActivated($pc, $key){
		$sth = self::$db->prepare('SELECT * FROM `activations` WHERE `pc` = :pc AND `key` = (SELECT `id` FROM `keys` WHERE `key` = :key)');
		$sth->bindParam(':pc', $pc);
		$sth->bindParam(':key', $key);
        $sth->execute();
        return sizeof($sth->fetchAll(PDO::FETCH_ASSOC)) > 0;
	}

	public static function saveActivation($pc, $key){
		$sth = self::$db->prepare('INSERT INTO `activations` (`pc`, `key`) VALUES (:pc, (SELECT `id` FROM `keys` WHERE `key` = :key))');
		$sth->bindParam(':pc', $pc);
		$sth->bindParam(':key', $key);
        $sth->execute();
	}
	
	public static function activateByKey($pc, $key){
		$sth = self::$db->Prepare('SELECT * FROM `keys` WHERE `key` = :key and `num` > 0');
		$sth->bindParam(':key', $key);
        $sth->execute();
        $res = $sth->fetchAll(PDO::FETCH_ASSOC);

        if(isset($res[0]) and $res[0]['num'] > 0){
        	$res[0]['num']--;
        	$sth = self::$db->Prepare('UPDATE `keys` SET `num` = :num WHERE `key` = :key');
			$sth->bindParam(':key', $key);
        	$sth->bindParam(':num', $res[0]['num']);
        	$sth->execute();

        	self::saveActivation($pc, $key);
        	return $res[0];
        }

		return false;
	}
}