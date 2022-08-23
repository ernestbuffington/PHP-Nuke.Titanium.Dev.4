<?php
class Lookup {
	public static function isBadIP($ip, $key, $strict) {
		$ch = curl_init();
		curl_setopt_array($ch, [
			CURLOPT_URL => "http://v2.api.iphub.info/ip/{$ip}",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HTTPHEADER => ["X-Key: {$key}"]
		]);
		try {
			$block = json_decode(curl_exec($ch))->block;
		} catch (Exception $e) {
			throw $e;
		}
		if ($block) {
			if ($strict) {
				return true;
			} elseif (!$strict && $block === 1) {
				return true;
			}
		}
		return false;
	}
}