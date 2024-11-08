<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('to_array')) {
	/**
	 * @param string $json
	 * @return array
	 */
	function to_array(string $json) :array {
		try {
			return json_decode($json, true, 512, JSON_THROW_ON_ERROR);
		}
		catch (JsonException $exception) {
			die($exception->getMessage());
		}
	}
}

if (!function_exists('to_json')) {
	/**
	 * @param array $array
	 * @return string
	 */
	function to_json(array $array) :string {
		try {
			return json_encode($array, JSON_THROW_ON_ERROR);
		}
		catch (JsonException $exception) {
			die($exception->getMessage());
		}
	}
}

if (!function_exists('is_post')) {
	/**
	 * @return bool
	 */
	function is_post() :bool {
		return $_SERVER['REQUEST_METHOD'] === 'POST';
	}
}

if (!function_exists('is_get')) {
	/**
	 * @return bool
	 */
	function is_get() :bool {
		return $_SERVER['REQUEST_METHOD'] === 'GET';
	}
}

if (!function_exists('authenticate_token')) {
	/**
	 * @param string $token
	 * @return bool
	 */
	function authenticate_token(string $token) :bool {
		return $token === '06b2873490cb654b11c9a569a3b9bfd0';
	}
}
