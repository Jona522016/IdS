<?php
/*
	Main Framework System 1.0
	Hash 1.0
*/
class Hash{
	public static function getHash($algoritmo, $data, $key){
		$hash = hash_init($algoritmo, HASH_HMAC, $key);
		hash_update($hash, $data);
		return hash_final($hash);
	}
}

?>