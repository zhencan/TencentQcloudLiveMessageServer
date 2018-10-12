<?php

namespace App\Log;

trait DealLog
{
	public static function info($string)
	{
		$file_name = __DIR__ . '/../../../Logs/lakes-' . date('Y-m-d') . '.log';
		$file = fopen($file_name, "a");
		if (is_array($string)) {
			if (count($string)) {
				fwrite($file, 'INFO（' . date('Y-m-d H-i-s') . '）:' . json_encode($string) . "\n");
			} else {
				fwrite($file, 'INFO（' . date('Y-m-d H-i-s') . '）:' . 'array（）' . "\n");
			}
		} else {
			if ($string == '') {
				fwrite($file, 'INFO（' . date('Y-m-d H-i-s') . '）:' .  '空字符串' . "\n");
			} else {
				fwrite($file, 'INFO（' . date('Y-m-d H-i-s') . '）:' .  $string . "\n");
			}
		}
		fclose($file);
	}

	public static function error($string)
	{
		$file_name = __DIR__ . '/../../../Logs/lakes-' . date('Y-m-d') . '.log';
		$file = fopen($file_name, "a");
		if (is_array($string)) {
			if (count($string)) {
				fwrite($file, 'ERROR（' . date('Y-m-d H-i-s') . '）:' . json_encode($string) . "\n");
			} else {
				fwrite($file, 'ERROR（' . date('Y-m-d H-i-s') . '）:' . 'array（）' . "\n");
			}
		} else {
			if ($string == '') {
				fwrite($file, 'ERROR（' . date('Y-m-d H-i-s') . '）:' .  '空字符串' . "\n");
			} else {
				fwrite($file, 'ERROR（' . date('Y-m-d H-i-s') . '）:' .  $string . "\n");
			}
		}
		fclose($file);
	}
}